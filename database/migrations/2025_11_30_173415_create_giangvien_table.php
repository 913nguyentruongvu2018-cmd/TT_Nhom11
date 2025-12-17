<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('giangvien', function (Blueprint $table) {
        $table->increments('GiangVienID');
        $table->string('MaGV')->unique();
        $table->string('HoTen');
        $table->string('HocVi')->nullable();
        
        // --- CHANGE 1: Đổi từ string('ChuyenNganh') thành integer('ChuyenNganhID') ---
        $table->integer('ChuyenNganhID'); 
        
        // --- CHANGE 2: Cho phép NguoiDungID được phép NULL (để trống) ---
        $table->integer('NguoiDungID')->nullable(); 
        
        // $table->timestamps(); // Nếu bạn không dùng thì bỏ
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giangvien');
    }
};
