<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GiangVienSeeder extends Seeder
{
    public function run(): void
    {
        
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Ngô', 'Dương'];
        $dem = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Đức', 'Thanh', 'Hữu', 'Mạnh', 'Quang', 'Thùy', 'Kim', 'Bá', 'Gia'];
        $ten = ['Hùng', 'Lan', 'Tuấn', 'Hương', 'Dũng', 'Vy', 'Nam', 'Sơn', 'Tâm', 'Thảo', 'Quân', 'Nhung', 'Trang', 'Phúc', 'Vinh'];

        
        $taoTenThat = function() use ($ho, $dem, $ten) {
            return $ho[array_rand($ho)] . ' ' . $dem[array_rand($dem)] . ' ' . $ten[array_rand($ten)];
        };

        
        $listCN = DB::table('chuyennganh')->pluck('ChuyenNganhID')->toArray();
        $hocVis = ['Thạc sĩ', 'Tiến sĩ', 'Phó Giáo sư', 'Giáo sư'];
        
        
        for ($i = 1; $i <= 20; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT); 
            
            $hoTenThat = $taoTenThat(); 
            $email = strtolower($maGV) . '@ntv.edu.vn';

            
            $userID = DB::table('nguoidung')->insertGetId([
                'TenDangNhap' => $maGV,
                'Email'       => $email,
                'MatKhau'     => Hash::make('123456'),
                'HoTen'       => $hoTenThat, 
                'VaiTro'      => 'GiangVien',
            ]);

            
            DB::table('giangvien')->insert([
                'MaGV'          => $maGV,
                'HoTen'         => $hoTenThat, 
                'HocVi'         => $hocVis[array_rand($hocVis)],
                'ChuyenNganhID' => $listCN[array_rand($listCN)], 
                'NguoiDungID'   => $userID, 
            ]);
        }
        echo "   + Đã tạo 20 Giảng viên với tên tiếng Việt đầy đủ.\n";
    }
}