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
        Schema::create('sinhvien', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('NguoiDungID')->nullable(); 

            $table->string('MaSV')->unique();
            $table->string('HoTen');
            $table->date('NgaySinh')->nullable();
            $table->string('Lop')->nullable();
            
            $table->foreign('NguoiDungID')->references('id')->on('nguoidung')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinhvien');
    }
};
