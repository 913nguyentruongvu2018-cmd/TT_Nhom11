<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuyenNganhSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ để tránh trùng lặp khi chạy lại
        DB::table('chuyennganh')->delete();

        $danhSach = [
            ['MaCN' => 'CNTT', 'TenChuyenNganh' => 'Công nghệ thông tin'],
            ['MaCN' => 'KTPM', 'TenChuyenNganh' => 'Kỹ thuật phần mềm'],
            ['MaCN' => 'HTTT', 'TenChuyenNganh' => 'Hệ thống thông tin'],
            ['MaCN' => 'KHMT', 'TenChuyenNganh' => 'Khoa học máy tính'],
            ['MaCN' => 'MMT',  'TenChuyenNganh' => 'Mạng máy tính & TT'],
            ['MaCN' => 'KTDT', 'TenChuyenNganh' => 'Kỹ thuật điện tử'],
            ['MaCN' => 'TUD',  'TenChuyenNganh' => 'Tự động hóa'],
            ['MaCN' => 'QTKD', 'TenChuyenNganh' => 'Quản trị kinh doanh'],
            ['MaCN' => 'KT',   'TenChuyenNganh' => 'Kế toán'],
            ['MaCN' => 'NNA',  'TenChuyenNganh' => 'Ngôn ngữ Anh'],
        ];

        DB::table('chuyennganh')->insert($danhSach);
    }
}