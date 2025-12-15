<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    use HasFactory;
    protected $table = 'chuyennganh';
    
    
    public $timestamps = false; 

    protected $fillable = ['MaCN', 'TenCN'];
}