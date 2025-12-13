<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    use HasFactory;
    protected $table = 'chuyennganh';
    
    // QUAN TRỌNG: Tắt timestamps theo yêu cầu của bạn
    public $timestamps = false; 

    protected $fillable = ['MaCN', 'TenCN'];
}