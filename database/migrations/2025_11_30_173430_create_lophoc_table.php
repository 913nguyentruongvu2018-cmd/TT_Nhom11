<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lophoc', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('LopID');
            $table->string('TenLop');
            $table->string('NamHoc', 20)->default('2024-2025');

            $table->unsignedInteger('GiangVienID');
            $table->unsignedInteger('ChuyenNganhID')->nullable();

            $table->foreign('GiangVienID')->references('GiangVienID')->on('giangvien')->onDelete('cascade');
            $table->foreign('ChuyenNganhID')->references('ChuyenNganhID')->on('chuyennganh')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lophoc');
    }
};
