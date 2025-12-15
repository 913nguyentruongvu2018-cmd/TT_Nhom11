<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, Notifiable;
    

    protected $table = 'nguoidung'; 

  
    public $timestamps = false; 

   
    protected $fillable = [
        'TenDangNhap', 
        'Email',     
        'MatKhau', 
        'HoTen', 
        'VaiTro'
    ];

    protected $hidden = [
        'MatKhau', 'remember_token',
    ];

    
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }
}