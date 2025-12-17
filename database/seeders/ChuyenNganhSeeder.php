<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuyenNganhSeeder extends Seeder
{
    public function run(): void
    {
        $nganhs = [
            ['CNTT', 'Công nghệ thông tin'],
            ['KTPM', 'Kỹ thuật phần mềm'],
            ['HTTT', 'Hệ thống thông tin'],
            ['MMT',  'Mạng máy tính & TT'],
            ['KT',   'Kế toán'],
            ['QTVP', 'Quản trị văn phòng'],
            ['NNA',  'Ngôn ngữ Anh'],
        ];

        foreach ($nganhs as $n) {
            DB::table('chuyennganh')->insert([
                'MaCN' => $n[0],
                'TenChuyenNganh' => $n[1]
            ]);
        }
        echo "   + Đã tạo Chuyên ngành.\n";
    }
}