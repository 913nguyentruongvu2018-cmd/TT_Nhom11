<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monhoc', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('MonHocID');
            $table->string('MaMon')->unique();
            $table->string('TenMonHoc');
            $table->integer('SoTinChi')->default(1);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('monhoc');
    }
};
