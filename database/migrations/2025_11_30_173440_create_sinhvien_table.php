<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('NguoiDungID')->nullable();
            $table->string('MaSV')->unique();
            $table->string('HoTen');
            $table->date('NgaySinh')->nullable();
            $table->unsignedBigInteger('LopID')->nullable();

            $table->foreign('NguoiDungID')->references('id')->on('nguoidung')->onDelete('set null');

            $table->foreign('LopID')->references('LopID')->on('lophoc')->onDelete('restrict');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sinhvien');
    }
};
