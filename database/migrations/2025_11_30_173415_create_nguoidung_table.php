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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();

            $table->string('TenDangNhap')->unique();
            $table->string('Email')->unique();
            $table->string('MatKhau');
            $table->string('HoTen');
            $table->enum('VaiTro', ['Admin', 'GiangVien', 'SinhVien'])->default('SinhVien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};
