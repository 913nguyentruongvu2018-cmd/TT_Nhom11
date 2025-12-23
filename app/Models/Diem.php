<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diem extends Model
{
    use HasFactory;
    
    protected $table = 'diem'; 
    protected $primaryKey = 'DiemID';
    public $timestamps = false;       

    protected $fillable = ['SinhVienID', 'MonHocID', 'DiemSo',];
    
    public function sinhVien() {
        return $this->belongsTo(SinhVien::class, 'SinhVienID', 'id');
    }

    public function monHoc() {
        return $this->belongsTo(MonHoc::class, 'MonHocID', 'MonHocID');
    }
}