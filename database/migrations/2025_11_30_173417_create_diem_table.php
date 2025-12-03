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
        Schema::create('diem', function (Blueprint $table) {
            $table->id('DiemID'); 

            $table->unsignedBigInteger('SinhVienID');
            $table->unsignedBigInteger('MonHocID');

            $table->float('DiemSo');
            $table->string('HocKy')->nullable();

            $table->foreign('SinhVienID')->references('SinhVienID')->on('sinhvien')->onDelete('cascade');
            // $table->foreign('MonHocID')->references('MonHocID')->on('monhoc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diem');
    }
};
