<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LopHocSeeder extends Seeder
{
    public function run(): void
    {
        $listCN = DB::table('chuyennganh')->pluck('ChuyenNganhID')->toArray();
        $listGV = DB::table('giangvien')->pluck('GiangVienID')->toArray();

        // Tạo 5 lớp
        for ($i = 1; $i <= 5; $i++) {
            DB::table('lophoc')->insert([
                'TenLop'        => 'DH522CN' . $i,
                'NamHoc'        => '2024-2025',
                'ChuyenNganhID' => $listCN[array_rand($listCN)],
                'GiangVienID'   => $listGV[array_rand($listGV)], // GV Chủ nhiệm
            ]);
        }
        echo "   + Đã tạo 5 Lớp học.\n";
    }
}