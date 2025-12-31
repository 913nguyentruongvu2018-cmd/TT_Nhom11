<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('giangvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('GiangVienID');
            $table->string('MaGV')->unique();
            $table->string('HoTen');
            $table->string('HocVi')->nullable();

            $table->unsignedInteger('ChuyenNganhID');
            $table->unsignedBigInteger('NguoiDungID')->nullable();

            $table->foreign('ChuyenNganhID')->references('ChuyenNganhID')->on('chuyennganh')->onDelete('restrict');
            $table->foreign('NguoiDungID')->references('id')->on('nguoidung')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('giangvien');
    }
};
