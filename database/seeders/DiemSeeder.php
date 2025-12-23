<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiemSeeder extends Seeder
{
    public function run(): void
    {
        $listSV = DB::table('sinhvien')->pluck('id')->toArray(); 
        $listMon = DB::table('monhoc')->pluck('MonHocID')->toArray();

        if (empty($listSV) || empty($listMon)) {
            echo "⚠️  LỖI: Bạn chưa chạy Seeder cho Sinh viên hoặc Môn học!\n";
            echo "👉 Vui lòng chạy: php artisan db:seed --class=SinhVienSeeder\n";
            echo "👉 Và: php artisan db:seed --class=MonHocSeeder\n";
            return;
        }

        echo "🚀 Đang chấm điểm ngẫu nhiên cho sinh viên...\n";

        foreach ($listSV as $svID) {
            
            if (count($listMon) >= 4) {
                $randomKeys = array_rand($listMon, 4); 
                $monHocNgauNhien = [];
                foreach($randomKeys as $key) {
                    $monHocNgauNhien[] = $listMon[$key];
                }
            } else {
                $monHocNgauNhien = $listMon;
            }

            foreach ($monHocNgauNhien as $mhID) {
                
                $diemSo = rand(40, 100) / 10; 

                $exists = DB::table('diem')
                            ->where('SinhVienID', $svID)
                            ->where('MonHocID', $mhID)
                            ->exists();

                if (!$exists) {
                    DB::table('diem')->insert([
                        'SinhVienID' => $svID,
                        'MonHocID'   => $mhID,
                        'DiemSo'     => $diemSo,
                    ]);
                }
            }
        }

        echo "✅ Đã nhập xong điểm số (Không bao gồm Học kỳ)!\n";
    }
}