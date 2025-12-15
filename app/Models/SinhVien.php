<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinhvien';
    protected $primaryKey = 'MaSV'; // Lưu ý: Mã SV là khóa chính (string)
    public $incrementing = false;   // Vì MaSV là chuỗi, không phải số tự tăng
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaSV', 'HoTen', 'NguoiDungID', 'Lop']; // Cột 'Lop' lưu ID lớp

    // --- BẠN ĐANG THIẾU ĐOẠN NÀY ---
    public function lopHoc() {
        // 'Lop' là tên cột khóa ngoại trong bảng SinhVien (lúc nãy bạn khai báo trong Seeder)
        // 'LopID' là tên cột khóa chính trong bảng LopHoc
        return $this->belongsTo(LopHoc::class, 'Lop', 'LopID');
    }
}