<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SinhVienSeeder extends Seeder
{
    public function run(): void
    {
        
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $dem = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Đức', 'Thanh', 'Hữu', 'Mạnh', 'Quang', 'Thùy', 'Kim', 'Bá', 'Gia', 'Xuân', 'Thu', 'Hồng'];

        
        
        $tenAlpha = [
            'An', 'Anh', 'Ánh',             
            'Bình', 'Bảo', 'Bách', 'Bắc',   
            'Cường', 'Châu', 'Chi', 'Công', 
            'Dũng', 'Dương', 'Đạt', 'Đức',  
            'Giang', 'Giao', 'Giáp',        
            'Hùng', 'Hương', 'Hải', 'Hiếu', 
            'Khánh', 'Khoa', 'Kiên', 'Khôi',
            'Lan', 'Linh', 'Long', 'Lâm',   
            'Minh', 'Mai', 'Mạnh', 'My',    
            'Nam', 'Nhung', 'Ngọc', 'Nga',  
            'Oanh',                         
            'Phúc', 'Phương', 'Phong', 'Phú',
            'Quân', 'Quang', 'Quyên', 'Quốc',
            'Sơn', 'Sang', 'Sâm',           
            'Tuấn', 'Thảo', 'Thịnh', 'Tú',  
            'Uyên', 'Uy',                   
            'Vinh', 'Vy', 'Việt', 'Vân',    
            'Xuân', 'Xuyên',                
            'Yến', 'Ý', 'Yên'               
        ];

        
        $listLop = DB::table('lophoc')->pluck('LopID')->toArray();

        
        if (empty($listLop)) {
            echo "⚠️ Cảnh báo: Chưa có lớp học nào. Vui lòng chạy LopHocSeeder trước!\n";
            return;
        }

        echo "🚀 Đang tạo 200 sinh viên...\n";

        
        for ($i = 1; $i <= 200; $i++) {
            
            
            $mssv = 'DH522' . str_pad($i, 5, '0', STR_PAD_LEFT);
            
            
            $tenRandom = $tenAlpha[array_rand($tenAlpha)]; 
            $hoTen = $ho[array_rand($ho)] . ' ' . $dem[array_rand($dem)] . ' ' . $tenRandom;
            
            $email = $mssv . '@student.ntv.edu.vn';

            
            $userID = DB::table('nguoidung')->insertGetId([
                'TenDangNhap' => $mssv,
                'Email'       => $email,
                'MatKhau'     => Hash::make('123456'), 
                'HoTen'       => $hoTen,
                'VaiTro'      => 'SinhVien',
            ]);

            
            DB::table('sinhvien')->insert([
                'MaSV'        => $mssv,
                'HoTen'       => $hoTen,
                
                'NgaySinh'    => rand(2002, 2004) . '-' . rand(1, 12) . '-' . rand(1, 28),
                'Lop'         => $listLop[array_rand($listLop)], 
                'NguoiDungID' => $userID,
            ]);
        }

        echo "✅ Đã tạo xong 200 Sinh viên (Có tài khoản + Đủ tên A-Z)!\n";
    }
}