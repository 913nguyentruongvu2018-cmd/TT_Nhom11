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
        Schema::create('lophoc', function (Blueprint $table) {
            $table->id('LopID'); 
            $table->string('TenLop');
            
            $table->unsignedBigInteger('GiangVienID'); 
            $table->integer('ChuyenNganhID')->nullable();

            // $table->foreign('GiangVienID')->references('GiangVienID')->on('giangvien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lophoc');
    }
};
