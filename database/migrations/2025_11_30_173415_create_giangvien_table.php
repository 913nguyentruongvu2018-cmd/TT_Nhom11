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
        
        
        $table->integer('ChuyenNganhID'); 
        
        
        $table->integer('NguoiDungID')->nullable(); 
        
        
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
