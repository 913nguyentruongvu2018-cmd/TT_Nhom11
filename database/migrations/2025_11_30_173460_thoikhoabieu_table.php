<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
       Schema::create('thoikhoabieu', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('TKBid');
            $table->unsignedBigInteger('LopID');
            $table->unsignedBigInteger('MonHocID');
            $table->unsignedInteger('GiangVienID');
            $table->string('ThuTrongTuan');
            $table->time('GioBatDau');
            $table->time('GioKetThuc');
            $table->string('PhongHoc');
            
            $table->foreign('LopID')->references('LopID')->on('lophoc')->onDelete('cascade');
            $table->foreign('MonHocID')->references('MonHocID')->on('monhoc')->onDelete('cascade');
            $table->foreign('GiangVienID')->references('GiangVienID')->on('giangvien')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('thoikhoabieu');
    }
};
