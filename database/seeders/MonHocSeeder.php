<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonHocSeeder extends Seeder
{
    public function run(): void
    {
        $mons = [
            ['Lập trình C#', 3],
            ['Cơ sở dữ liệu', 3],
            ['Lập trình Web PHP', 4],
            ['Tiếng Anh chuyên ngành', 2],
            ['Mạng máy tính cơ bản', 3],
            ['Quản trị dự án', 3],
            ['Kỹ năng mềm', 2],
            ['Pháp luật đại cương', 2],
            ['Toán rời rạc', 3],
            ['Cấu trúc dữ liệu & GT', 4],
        ];

        foreach ($mons as $index => $m) {
            DB::table('monhoc')->insert([
                'MaMon' => 'MH' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), 
                'TenMonHoc' => $m[0], 
                'SoTinChi' => $m[1],
            ]);
        }
        echo "   + Đã tạo Môn học.\n";
    }
}