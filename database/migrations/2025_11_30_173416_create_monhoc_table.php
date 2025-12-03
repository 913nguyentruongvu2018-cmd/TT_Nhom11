<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('monhoc', function (Blueprint $table) {
        $table->id('MonHocID');
        $table->string('TenMonHoc');
        $table->integer('SoTinChi')->default(1);
        
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monhoc');
    }
};
