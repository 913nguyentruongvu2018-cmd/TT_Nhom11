<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('nguoidung')->truncate();
        DB::table('chuyennganh')->truncate();
        DB::table('monhoc')->truncate();
        DB::table('giangvien')->truncate();
        DB::table('lophoc')->truncate();
        DB::table('sinhvien')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "🚀 ĐANG KHỞI TẠO DỮ LIỆU MẪU...\n";

        
        DB::table('nguoidung')->insert([
            'TenDangNhap' => 'admin',
            'Email'       => 'admin@ntv.edu.vn',
            'MatKhau'     => Hash::make('123456'),
            'HoTen'       => 'Quản Trị Viên',
            'VaiTro'      => 'Admin',
        ]);

        
        $this->call([
            ChuyenNganhSeeder::class,
            MonHocSeeder::class,    
            GiangVienSeeder::class, 
            LopHocSeeder::class,
            SinhVienSeeder::class,
            DiemSeeder::class,  
        ]);

        echo "✅ HOÀN TẤT! Dữ liệu đã sẵn sàng.\n";
    }
}