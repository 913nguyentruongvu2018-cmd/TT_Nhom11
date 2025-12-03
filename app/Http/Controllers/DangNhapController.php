<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    //  form đăng nhập
    public function hienForm() {
        return view('dangnhap');
    }

    //  đăng nhập
    public function xuLyDangNhap(Request $request) {
        
        $request->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required',
        ]);

        $thongTinDangNhap = [
            'TenDangNhap' => $request->TenDangNhap,
            'password' => $request->MatKhau
        ];

        if (Auth::attempt($thongTinDangNhap)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->VaiTro == 'Admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->VaiTro == 'GiangVien') {
                return redirect('/giang-vien/dashboard');
            } else {
                return redirect('/sinh-vien/dashboard');
            }
        }

        return back()->withErrors([
            'TenDangNhap' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
        ]);
    }

    public function dangXuat(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dang-nhap');
    }
}