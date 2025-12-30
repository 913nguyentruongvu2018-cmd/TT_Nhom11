<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    use HasFactory;
    
    protected $table = 'giangvien';       
    protected $primaryKey = 'GiangVienID';
    public $timestamps = false;           

    protected $fillable = ['MaGV', 'HoTen', 'HocVi', 'ChuyenNganhID', 'NguoiDungID'];
    public function chuyenNganh() {
        return $this->belongsTo(ChuyenNganh::class, 'ChuyenNganhID', 'ChuyenNganhID');
    }
    public function lopHoc()
    {
        return $this->hasOne(LopHoc::class, 'GiangVienID', 'GiangVienID');
    }
}