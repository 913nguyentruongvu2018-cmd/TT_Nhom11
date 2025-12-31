<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinhvien';
    public $timestamps = false;

    protected $fillable = ['MaSV', 'HoTen', 'NguoiDungID', 'LopID', 'NgaySinh'];

    
    public function lopHoc() {
        
       
        return $this->belongsTo(LopHoc::class, 'LopID', 'LopID');
    }

    public function diems()
    {
        return $this->hasMany(Diem::class, 'SinhVienID', 'id');
    }
}