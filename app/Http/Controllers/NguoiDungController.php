<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    public function index() {
        $dsNguoiDung = NguoiDung::all();
        return view('admin.nguoidung.index', ['dsNguoiDung' => $dsNguoiDung]);
    }

    public function hienFormThem() {
        $svChuaCoTK = SinhVien::whereNull('NguoiDungID')->get();
        
        return view('admin.nguoidung.them', ['svChuaCoTK' => $svChuaCoTK]);
    }

    public function luuNguoiDung(Request $request) {
        $request->validate([
            'TenDangNhap' => 'required|unique:nguoidung,TenDangNhap',
            'MatKhau' => 'required|min:6',
            'HoTen' => 'required',
            'VaiTro' => 'required',
            'SinhVienID'  => 'required_if:VaiTro,SinhVien'
        ], [
            'SinhVienID.required_if' => 'Vui lòng chọn hồ sơ để liên kết! Không được để trống.',
            'TenDangNhap.unique' => 'Tên đăng nhập này đã tồn tại!',
            'TenDangNhap.required' => 'Vui lòng nhập tên đăng nhập.',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu.',
            'HoTen.required' => 'Vui lòng nhập họ tên.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',            
            'VaiTro' => 'required'
        ], [
            'TenDangNhap.unique' => 'Tên đăng nhập này đã tồn tại!',
            'TenDangNhap.required' => 'Vui lòng nhập tên đăng nhập.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ]);

        $user = NguoiDung::create([
            'TenDangNhap' => $request->TenDangNhap,
            'MatKhau' => Hash::make($request->MatKhau),
            'HoTen' => $request->HoTen,
            'VaiTro' => $request->VaiTro
        ]);

        if ($request->VaiTro == 'SinhVien' && $request->SinhVienID) {
            $sinhVien = SinhVien::find($request->SinhVienID);
            
            if ($sinhVien) {
                $sinhVien->NguoiDungID = $user->id; 
                $sinhVien->save();
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
            'TenDangNhap' => 'required|unique:nguoidung,TenDangNhap,'.$id,
            'HoTen' => 'required',
            'VaiTro' => 'required'
        ]);

        $user = NguoiDung::find($id);
        
        $data = [
            'TenDangNhap' => $request->TenDangNhap,
            'HoTen' => $request->HoTen,
            'VaiTro' => $request->VaiTro,
        ];

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