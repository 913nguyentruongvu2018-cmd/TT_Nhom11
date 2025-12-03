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
        Schema::create('thoikhoabieu', function (Blueprint $table) {
            $table->id('TKBid');
            
            $table->unsignedBigInteger('LopID');
            $table->unsignedBigInteger('MonHocID');
            $table->unsignedBigInteger('GiangVienID');

            $table->string('ThuTrongTuan');
            $table->time('GioBatDau');
            $table->time('GioKetThuc');
            $table->string('PhongHoc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thoikhoabieu');
    }
};
