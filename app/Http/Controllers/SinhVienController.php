<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\NguoiDung;
use App\Models\LopHoc; // Import Model LopHoc
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    // 1. Xem danh sách
    public function index(Request $request)
    {
        // 1. Bắt đầu query (có nối bảng Lớp để lấy tên lớp hiển thị)
        // Lưu ý: Trong Model SinhVien phải có hàm lopHoc() nhé
        $query = SinhVien::with('lopHoc');

        // 2. LOGIC LỌC THEO LỚP (Quan trọng)
        // Nếu trên thanh địa chỉ có ?lop_id=... thì lọc theo lớp đó
        if ($request->filled('lop_id')) {
            // Lưu ý: Cột trong bảng SinhVien của bạn tên là 'Lop' hay 'LopID' thì sửa vào đây
            // Theo seeder cũ của bạn là cột 'Lop'
            $query->where('Lop', $request->lop_id);
        }

        // 3. LOGIC TÌM KIẾM TÊN/MSSV
        if ($request->filled('tu_khoa')) {
            $query->where(function ($q) use ($request) {
                $q->where('HoTen', 'LIKE', '%' . $request->tu_khoa . '%')
                    ->orWhere('MaSV', 'LIKE', '%' . $request->tu_khoa . '%');
            });
        }

        // 4. LOGIC SẮP XẾP A-Z
        if ($request->sap_xep == 'az') {
            $query->orderBy('HoTen', 'ASC'); // A -> Z
        } elseif ($request->sap_xep == 'za') {
            $query->orderBy('HoTen', 'DESC'); // Z -> A
        } else {
            $query->orderBy('MaSV', 'ASC'); // Mặc định xếp theo Mã
        }

        // 5. Lấy dữ liệu cuối cùng
        $dsSinhVien = $query->get();

        // 6. Lấy danh sách tất cả lớp để đổ vào ô chọn (Dropdown)
        $dsLop = LopHoc::all();

        return view('admin.sinhvien.index', [
            'dsSinhVien' => $dsSinhVien,
            'dsLop' => $dsLop
        ]);
    }

    // 2. Hiển thị form thêm (Lấy danh sách lớp từ DB)
    public function hienFormThem()
    {
        $dsLop = LopHoc::all();
        return view('admin.sinhvien.them', compact('dsLop'));
    }

    // 3. Xử lý lưu
    public function luuSinhVien(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            // Ràng buộc: Bắt buộc, duy nhất, và phải khớp định dạng Regex
            'MaSV' => [
                'required',
                'unique:sinhvien,MaSV',
                'regex:/^DH522\d{5}$/' // Bắt đầu bằng DH522, theo sau là 5 chữ số bất kỳ
            ],
            'HoTen' => 'required',
            'Lop' => 'required', // Bắt buộc phải chọn lớp
        ], [
            'MaSV.required' => 'Vui lòng nhập Mã sinh viên.',
            'MaSV.unique' => 'Mã sinh viên này đã tồn tại.',
            'MaSV.regex' => 'Mã SV không đúng định dạng! Phải là DH522xxxxx (VD: DH52212345).',
            'Lop.required' => 'Vui lòng xếp lớp cho sinh viên.',
        ]);

        DB::beginTransaction();
        try {
            $mssv = $request->MaSV;
            $email = $mssv . '@student.ntv.vn';

            // Tạo User
            $user = NguoiDung::create([
                'TenDangNhap' => $mssv,
                'Email' => $email,
                'MatKhau' => Hash::make('123456'),
                'HoTen' => $request->HoTen,
                'VaiTro' => 'SinhVien',
            ]);

            // Tạo SinhVien (Lưu NgaySinh và Lớp)
            SinhVien::create([
                'MaSV' => $mssv,
                'HoTen' => $request->HoTen,
                'NgaySinh' => $request->NgaySinh,
                'Lop' => $request->Lop,
                'NguoiDungID' => $user->id,
            ]);

            DB::commit();
            return redirect('/admin/sinh-vien')->with('success', "Đã thêm SV $request->HoTen thành công!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    // 4. Hiển thị form sửa
    public function hienFormSua($id)
    {
        // Đổi tên biến thành $sv cho khớp với View sua.blade.php
        $sv = SinhVien::find($id);

        if (!$sv) return redirect('/admin/sinh-vien')->with('error', 'Không tìm thấy sinh viên!');

        $dsLop = LopHoc::all(); // Lấy danh sách lớp đổ vào dropdown

        return view('admin.sinhvien.sua', compact('sv', 'dsLop'));
    }

    // 5. Xử lý cập nhật
    public function capNhat(Request $request, $id)
    {
        $sinhvien = SinhVien::find($id);

        // Validate
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'Lop' => 'required',
        ], [
            'NgaySinh.required' => 'Vui lòng chọn ngày sinh.',
        ]);

        // Cập nhật thông tin hồ sơ
        $sinhvien->update([
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh, // Cập nhật ngày sinh
            'Lop'   => $request->Lop,         // Cập nhật lớp
        ]);

        // Cập nhật tên bên bảng User cho đồng bộ
        if ($sinhvien->NguoiDungID) {
            $user = NguoiDung::find($sinhvien->NguoiDungID);
            if ($user) {
                $user->update(['HoTen' => $request->HoTen]);
            }
        }

        return redirect('/admin/sinh-vien')->with('success', 'Cập nhật thông tin thành công!');
    }

    // 6. Xóa sinh viên
    public function xoa($id)
    {
        try {
            $sinhvien = SinhVien::find($id);
            if ($sinhvien) {
                $userId = $sinhvien->NguoiDungID;
                $sinhvien->delete();
                if ($userId) NguoiDung::destroy($userId);
            }
            return redirect()->back()->with('success', 'Đã xóa sinh viên!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
