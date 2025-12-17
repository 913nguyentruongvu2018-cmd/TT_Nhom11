<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SinhVienSeeder extends Seeder
{
    public function run(): void
    {
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh'];
        $ten = ['Nam', 'Hùng', 'Tuấn', 'Dũng', 'Lan', 'Mai', 'Hoa'];
        
        $listLop = DB::table('lophoc')->pluck('LopID')->toArray();
        $counter = 1;

        // Mỗi lớp tạo 10 sinh viên
        foreach ($listLop as $lopID) {
            for ($k = 1; $k <= 10; $k++) {
                $mssv = 'DH522' . str_pad($counter, 5, '0', STR_PAD_LEFT);
                $hoTen = $ho[array_rand($ho)] . ' ' . $ten[array_rand($ten)] . ' ' . $counter;
                $email = $mssv . '@student.ntv.edu.vn';

                // 1. TẠO TÀI KHOẢN TRƯỚC
                $userID = DB::table('nguoidung')->insertGetId([
                    'TenDangNhap' => $mssv, // User là MSSV
                    'Email'       => $email,
                    'MatKhau'     => Hash::make('123456'),
                    'HoTen'       => $hoTen,
                    'VaiTro'      => 'SinhVien',
                ]);

                // 2. TẠO HỒ SƠ SINH VIÊN (Liên kết luôn)
                DB::table('sinhvien')->insert([
                    'MaSV'        => $mssv,
                    'HoTen'       => $hoTen,
                    'NgaySinh'    => '2004-01-01',
                    'Lop'         => $lopID,
                    'NguoiDungID' => $userID, // <--- ĐÃ LIÊN KẾT
                ]);
                $counter++;
            }
        }
        echo "   + Đã tạo 50 Sinh viên (Có tài khoản).\n";
    }
}