<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    
    public function hienForm() {
        return view('dangnhap'); 
    }

    
    public function xuLyDangNhap(Request $request)
    {
        
        $request->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required'
        ],[
            'TenDangNhap.required' => 'Vui lòng nhập tên đăng nhập.',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu.'
        ]);

        
        
        
        $thongTinXacThuc = [
            'TenDangNhap' => $request->TenDangNhap,
            'password' => $request->MatKhau
        ];

        
        if (Auth::attempt($thongTinXacThuc)) {
            
            
            $request->session()->regenerate();

            
            $user = Auth::user();
            
            
            if ($user->VaiTro == 'Admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->VaiTro == 'SinhVien') {
                return redirect('/sinh-vien/dashboard');
            } elseif ($user->VaiTro == 'GiangVien') {
                
                return redirect('/giang-vien/dashboard');;  
            }
            
            
            return redirect('/');
        }

        
        return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng!');
    }

    
    public function dangXuat(Request $request) {
        Auth::logout();
        
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/dang-nhap');
    }
}