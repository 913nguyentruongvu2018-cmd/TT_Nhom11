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
    Schema::create('chuyennganh', function (Blueprint $table) {
        // Sửa id() thành tên này để khớp với Model
        $table->increments('ChuyenNganhID'); 
        
        $table->string('MaCN')->unique();
        
        // Sửa tên cột này để khớp với Seeder
        $table->string('TenChuyenNganh'); 
        
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuyen_nganhs');
    }
};
