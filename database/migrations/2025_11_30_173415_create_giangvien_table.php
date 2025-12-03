<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('giangvien', function (Blueprint $table) {
            $table->id('GiangVienID');
            
            $table->string('MaGV')->unique(); 
            // ---------------------------------

            $table->string('HoTen');
            $table->string('HocVi')->nullable();
            $table->string('ChuyenNganh')->nullable();
            
            $table->unsignedBigInteger('NguoiDungID')->nullable();
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
