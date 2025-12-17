<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $this->call(ChuyenNganhSeeder::class);
        $listChuyenNganhIDs = DB::table('chuyennganh')->pluck('ChuyenNganhID')->toArray();

        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('nguoidung')->truncate();
        DB::table('giangvien')->truncate();
        DB::table('lophoc')->truncate();
        DB::table('sinhvien')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "--- ĐANG TẠO DỮ LIỆU MẪU ---\n";

        
        
        
        DB::table('nguoidung')->insert([
            'TenDangNhap' => 'admin',
            'Email'       => 'admin@ntv.edu.vn',
            'MatKhau'     => Hash::make('123456'),
            'HoTen'       => 'Quản Trị Viên',
            'VaiTro'      => 'Admin',
        ]);
        echo "✅ Đã tạo Admin (admin / 123456)\n";

        
        
        
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ'];
        $tenDem = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Đức', 'Thanh', 'Hữu', 'Mạnh', 'Quang'];
        $ten = ['Hùng', 'Lan', 'Tuấn', 'Hương', 'Dũng', 'Vy', 'Nam', 'Sơn', 'Tâm', 'Thảo', 'Quân'];

        $taoTen = function() use ($ho, $tenDem, $ten) {
            return $ho[array_rand($ho)] . ' ' . $tenDem[array_rand($tenDem)] . ' ' . $ten[array_rand($ten)];
        };

        
        
        
        $listGiangVienIDs = []; 
        $hocVis = ['Cử nhân', 'Thạc sĩ', 'Tiến sĩ', 'Phó Giáo sư'];

        for ($i = 1; $i <= 20; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT); 
            
            
            $gvId = DB::table('giangvien')->insertGetId([
                'MaGV'          => $maGV,
                'HoTen'         => $taoTen(), 
                'HocVi'         => $hocVis[array_rand($hocVis)],
                'ChuyenNganhID' => $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)],
                'NguoiDungID'   => null, 
            ]);

            
            $listGiangVienIDs[] = $gvId;
        }
        echo "✅ Đã tạo 20 Giảng viên (GV001 -> GV020)\n";

        
        
        
        
        
        
        shuffle($listGiangVienIDs); 

        $listLopIDs = [];
        for ($j = 1; $j <= 10; $j++) {
            $tenLop = 'DH522CN' . $j;
            
            
            $gvChuNhiem = array_shift($listGiangVienIDs);

            $lopId = DB::table('lophoc')->insertGetId([
                'TenLop'        => $tenLop,
                'NamHoc'        => '2024-2025',
                'GiangVienID'   => $gvChuNhiem, 
                'ChuyenNganhID' => $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)],
            ]);
            $listLopIDs[] = $lopId;
        }
        echo "✅ Đã tạo 10 Lớp học & Phân công 10 GV chủ nhiệm (Còn 10 GV rảnh)\n";

        
        
        
        $svCounter = 1;
        foreach ($listLopIDs as $lopID) {
            for ($k = 1; $k <= 10; $k++) {
                $maSV = 'DH522' . str_pad($svCounter, 5, '0', STR_PAD_LEFT);
                
                DB::table('sinhvien')->insert([
                    'MaSV'        => $maSV,
                    'HoTen'       => $taoTen(),
                    'Lop'         => $lopID,
                    'NguoiDungID' => null, 
                ]);
                
                $svCounter++;
            }
        }
        echo "✅ Đã tạo 100 Sinh viên phân vào các lớp.\n";
    }
}