<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, Notifiable;
    

    protected $table = 'nguoidung'; // Khai báo tên bảng [cite: 3, 26]

    // LƯU Ý: Trong migration  có tạo cột created_at, updated_at
    // Nên bạn hãy XÓA hoặc comment dòng dưới đây để Laravel tự động quản lý thời gian
    public $timestamps = false; 

    // Các cột được phép thêm/sửa hàng loạt (Mass Assignment)
    protected $fillable = [
        'TenDangNhap', 
        'Email',      // <--- QUAN TRỌNG: Phải thêm cột Email vào đây
        'MatKhau', 
        'HoTen', 
        'VaiTro'
    ];

    protected $hidden = [
        'MatKhau', 'remember_token',
    ];

    // Bắt buộc: Khai báo cho Laravel biết cột mật khẩu tên là 'MatKhau'
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
}