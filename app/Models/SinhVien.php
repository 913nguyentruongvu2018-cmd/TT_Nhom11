<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinhvien';
    protected $primaryKey = 'MaSV'; 
    public $incrementing = false;   
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaSV', 'HoTen', 'NguoiDungID', 'Lop', 'NgaySinh'];

    
    public function lopHoc() {
        
       
        return $this->belongsTo(LopHoc::class, 'Lop', 'LopID');
    }
}