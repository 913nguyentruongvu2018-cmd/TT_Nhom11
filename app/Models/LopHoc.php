<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    
    protected $table = 'lophoc';      
    protected $primaryKey = 'LopID'; 
    public $timestamps = false;        

    protected $fillable = ['TenLop', 'GiangVienID','ChuyenNganhID'];

    public function giangVien() {
        return $this->belongsTo(GiangVien::class, 'GiangVienID', 'GiangVienID');
    }

    public function chuyenNganh() {
        return $this->belongsTo(ChuyenNganh::class, 'ChuyenNganhID', 'ChuyenNganhID');
    }
}