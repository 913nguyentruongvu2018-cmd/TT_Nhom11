<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diem', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('DiemID');
            $table->unsignedBigInteger('SinhVienID');
            $table->unsignedBigInteger('MonHocID');
            $table->float('DiemSo');

            $table->foreign('SinhVienID')->references('id')->on('sinhvien')->onDelete('cascade');
            $table->foreign('MonHocID')->references('MonHocID')->on('monhoc')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('diem');
    }
};
