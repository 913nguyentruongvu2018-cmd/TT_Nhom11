<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    // 1. Hiển thị form đăng nhập
    public function hienForm() {
        return view('dangnhap'); // Trả về view bạn vừa sửa [cite: 12]
    }

    // 2. Xử lý đăng nhập
    public function xuLyDangNhap(Request $request)
    {
        // Validate dữ liệu đầu vào (Không bắt buộc nhưng nên có)
        $request->validate([
            'Email' => 'required|email',
            'MatKhau' => 'required'
        ]);

        // Chuẩn bị thông tin xác thực
        // 'Email': Laravel sẽ tìm cột 'Email' trong database 
        // 'password': Laravel bắt buộc dùng key này để xác định giá trị cần hash so sánh (dù form gửi lên là MatKhau)
        $thongTinXacThuc = [
            'Email' => $request->Email,
            'password' => $request->MatKhau
        ];

        // Auth::attempt tự động hash password và so sánh với DB
        if (Auth::attempt($thongTinXacThuc)) {
            
            // Bảo mật: Tạo lại session ID để tránh tấn công Session Fixation
            $request->session()->regenerate();

            // Lấy thông tin người dùng hiện tại
            $user = Auth::user();
            
            // Kiểm tra vai trò để chuyển hướng [cite: 20, 24]
            if ($user->VaiTro == 'Admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->VaiTro == 'SinhVien') {
                return redirect('/sinh-vien/dashboard');
            } elseif ($user->VaiTro == 'GiangVien') {
                // Giảng viên dùng chung dashboard với Admin hoặc trang riêng tùy bạn định nghĩa
                return redirect('/admin/dashboard'); 
            }
            
            // Mặc định chuyển về trang chủ nếu không khớp vai trò
            return redirect('/');
        }

        // Nếu đăng nhập thất bại, quay lại và báo lỗi
        return back()->with('error', 'Email hoặc mật khẩu không đúng!');
    }

    // 3. Xử lý đăng xuất
    public function dangXuat(Request $request) {
        Auth::logout();
        
        // Hủy session hiện tại
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/dang-nhap');
    }
}