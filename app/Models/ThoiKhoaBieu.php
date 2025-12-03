<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoiKhoaBieu extends Model
{
    use HasFactory;
    
    protected $table = 'thoikhoabieu';
    protected $primaryKey = 'TKBid'; 
    public $timestamps = false;

    protected $fillable = [
        'LopID', 'MonHocID', 'GiangVienID', 
        'ThuTrongTuan', 'GioBatDau', 'GioKetThuc', 'PhongHoc'
    ];

    public function lopHoc() {
        return $this->belongsTo(LopHoc::class, 'LopID', 'LopID');
    }

    public function monHoc() {
        return $this->belongsTo(MonHoc::class, 'MonHocID', 'MonHocID');
    }

    public function giangVien() {
        return $this->belongsTo(GiangVien::class, 'GiangVienID', 'GiangVienID');
    }
}