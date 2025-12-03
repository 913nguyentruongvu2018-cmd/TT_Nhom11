<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DangKyController extends Controller
{
    public function hienForm()
    {
        return view('dangky');
    }

    public function xuLyDangKy(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|unique:nguoidung,TenDangNhap',
            'MatKhau' => 'required',
            'MaSV' => 'required|exists:sinhvien,MaSV' 
        ], [
            'MaSV.exists' => 'Mã sinh viên này không tồn tại trong hồ sơ nhà trường!',
            'TenDangNhap.unique' => 'Tên đăng nhập này đã có người dùng.',
            'MaSV.required'=> 'Cần nhập mã sinh viên',
            'MatKhau.required'=> 'Cần nhập mật khẩu',
            'TenDangNhap.required'=> 'Cần nhập tên sinh viên'
        ]);

        $sinhVien = SinhVien::where('MaSV', $request->MaSV)->first();

        if ($sinhVien->NguoiDungID != null) {
            return back()->withErrors(['MaSV' => 'Sinh viên này đã có tài khoản rồi!']);
        }

        // tao tai khoan moi
        $user = NguoiDung::create([
            'TenDangNhap' => $request->TenDangNhap,
            'MatKhau' => Hash::make($request->MatKhau),
            'HoTen' => $sinhVien->HoTen,
            'VaiTro' => 'SinhVien'
        ]);

        $sinhVien->NguoiDungID = $user->id;
        $sinhVien->save();

        return redirect('/dang-nhap')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}