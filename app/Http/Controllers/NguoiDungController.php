<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Models\SinhVien;
use App\Models\GiangVien; // <--- THÊM DÒNG NÀY
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    // 1. Index: Đã thêm chức năng tìm kiếm
    public function index(Request $request) {
        $query = NguoiDung::query();

        // Tìm theo từ khóa (Tên hoặc Email)
        if ($request->filled('tu_khoa')) {
            $query->where(function($q) use ($request) {
                $q->where('HoTen', 'LIKE', '%' . $request->tu_khoa . '%')
                  ->orWhere('Email', 'LIKE', '%' . $request->tu_khoa . '%');
            });
        }

        // Tìm theo vai trò
        if ($request->filled('vai_tro')) {
            $query->where('VaiTro', $request->vai_tro);
        }

        // Lấy dữ liệu mới nhất lên đầu
        $dsNguoiDung = $query->orderBy('id', 'desc')->get();
        
        return view('admin.nguoidung.index', ['dsNguoiDung' => $dsNguoiDung]);
    }

    // 2. Form Thêm: Lấy thêm danh sách Giảng viên chưa có TK
    public function hienFormThem() {
        $svChuaCoTK = SinhVien::whereNull('NguoiDungID')->get();
        
        // Lấy giảng viên chưa có tài khoản
        $gvChuaCoTK = GiangVien::whereNull('NguoiDungID')->get(); 
        
        return view('admin.nguoidung.them', [
            'svChuaCoTK' => $svChuaCoTK,
            'gvChuaCoTK' => $gvChuaCoTK // Truyền sang view
        ]);
    }

    // 3. Lưu: Đã thêm Email và Logic cho Giảng viên
    public function luuNguoiDung(Request $request) {
        $request->validate([
            'TenDangNhap' => 'required|unique:nguoidung,TenDangNhap',
            'Email'       => 'required|email|unique:nguoidung,Email', // <--- QUAN TRỌNG: Thêm check Email
            'MatKhau'     => 'required|min:6',
            'HoTen'       => 'required',
            'VaiTro'      => 'required',
            'SinhVienID'  => 'required_if:VaiTro,SinhVien',
            'GiangVienID' => 'required_if:VaiTro,GiangVien' // <--- Bắt buộc chọn GV nếu role là GV
        ], [
            'SinhVienID.required_if' => 'Vui lòng chọn hồ sơ Sinh viên để liên kết!',
            'GiangVienID.required_if' => 'Vui lòng chọn hồ sơ Giảng viên để liên kết!',
            'TenDangNhap.unique' => 'Tên đăng nhập này đã tồn tại!',
            'Email.required' => 'Vui lòng nhập Email.',
            'Email.unique' => 'Email này đã được sử dụng.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ]);

        // Tạo User
        $user = NguoiDung::create([
            'TenDangNhap' => $request->TenDangNhap,
            'Email'       => $request->Email, // <--- SỬA LỖI SQL: Thêm dòng này
            'MatKhau'     => Hash::make($request->MatKhau),
            'HoTen'       => $request->HoTen,
            'VaiTro'      => $request->VaiTro
        ]);

        // Xử lý liên kết Sinh Viên
        if ($request->VaiTro == 'SinhVien' && $request->SinhVienID) {
            $sinhVien = SinhVien::find($request->SinhVienID);
            if ($sinhVien) {
                $sinhVien->NguoiDungID = $user->id; 
                $sinhVien->save();
            }
        }
        // Xử lý liên kết Giảng Viên (MỚI)
        elseif ($request->VaiTro == 'GiangVien' && $request->GiangVienID) {
            $giangVien = GiangVien::find($request->GiangVienID);
            if ($giangVien) {
                $giangVien->NguoiDungID = $user->id; 
                $giangVien->save();
            }
        }

        return redirect('/admin/nguoi-dung')->with('success', 'Đã tạo tài khoản và liên kết thành công!');
    }

    public function hienFormSua($id) {
        $user = NguoiDung::find($id);
        return view('admin.nguoidung.sua', ['user' => $user]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            // Kiểm tra trùng tên đăng nhập (trừ chính nó ra)
            'TenDangNhap' => 'required|unique:nguoidung,TenDangNhap,'.$id,
            // Kiểm tra trùng Email (trừ chính nó ra) <-- QUAN TRỌNG
            'Email' => 'required|email|unique:nguoidung,Email,'.$id, 
            'HoTen' => 'required',
            'VaiTro' => 'required'
        ], [
            'TenDangNhap.unique' => 'Tên đăng nhập này đã có người dùng.',
            'Email.unique' => 'Email này đã có người dùng.',
            'Email.required' => 'Vui lòng nhập Email.',
            'HoTen.required' => 'Vui lòng nhập họ tên.'
        ]);

        $user = NguoiDung::find($id);
        
        $data = [
            'TenDangNhap' => $request->TenDangNhap,
            'Email'       => $request->Email, // <-- THÊM DÒNG NÀY
            'HoTen'       => $request->HoTen,
            'VaiTro'      => $request->VaiTro,
        ];

        // Nếu có nhập mật khẩu mới thì mới cập nhật, không thì giữ nguyên
        if ($request->filled('MatKhau')) {
            $data['MatKhau'] = Hash::make($request->MatKhau);
        }

        $user->update($data);

        return redirect('/admin/nguoi-dung')->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function xoa($id) {
        if (auth()->id() == $id) {
            return back()->withErrors(['msg' => 'Bạn không thể xóa chính mình!']);
        }

        NguoiDung::find($id)->delete();
        return redirect('/admin/nguoi-dung')->with('success', 'Đã xóa tài khoản.');
    }
}