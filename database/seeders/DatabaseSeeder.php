<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. GỌI SEEDER CHUYÊN NGÀNH (Để có dữ liệu Chuyên ngành trước)
        $this->call(ChuyenNganhSeeder::class);
        $listChuyenNganhIDs = DB::table('chuyennganh')->pluck('ChuyenNganhID')->toArray();

        // 2. LÀM SẠCH DỮ LIỆU CŨ
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('nguoidung')->truncate();
        DB::table('giangvien')->truncate();
        DB::table('lophoc')->truncate();
        DB::table('sinhvien')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "--- BẮT ĐẦU TẠO DỮ LIỆU MẪU ---\n";

        // ================================================================
        // 3. TẠO ADMIN & GIẢNG VIÊN (Giữ lại như cũ cho bạn dùng)
        // ================================================================
        DB::table('nguoidung')->insert([
            'TenDangNhap' => 'admin',
            'Email' => 'pdt@ntv.edu.vn',
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Phòng Đào Tạo',
            'VaiTro' => 'Admin',
        ]);

        // Tạo 5 Giảng viên
        $listGiangVienIDs = [];
        for ($i = 1; $i <= 5; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $userId = DB::table('nguoidung')->insertGetId([
                'TenDangNhap' => strtolower($maGV),
                'Email' => strtolower($maGV) . '@ntv.edu.vn',
                'MatKhau' => Hash::make('123456'),
                'HoTen' => "Giảng Viên $i",
                'VaiTro' => 'GiangVien',
            ]);
            $gvId = DB::table('giangvien')->insertGetId([
                'MaGV' => $maGV,
                'HoTen' => "Giảng Viên $i",
                'HocVi' => 'Thạc sĩ',
                'ChuyenNganhID' => $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)],
                'NguoiDungID' => $userId,
            ]);
            $listGiangVienIDs[] = $gvId;
        }

        // ================================================================
        // 4. TẠO 10 LỚP HỌC & 100 SINH VIÊN (CHIA ĐỀU)
        // ================================================================

        // Hàm tạo tên ngẫu nhiên
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng'];
        $dem = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Đức', 'Thanh'];
        $ten = ['Hùng', 'Lan', 'Tuấn', 'Hương', 'Dũng', 'Hoa', 'Nam', 'Trang', 'Sơn', 'Linh'];

        $taoTen = function () use ($ho, $dem, $ten) {
            return $ho[array_rand($ho)] . ' ' . $dem[array_rand($dem)] . ' ' . $ten[array_rand($ten)];
        };

        // Biến đếm số thứ tự sinh viên để tạo Mã SV (Bắt đầu từ 00001)
        $svCounter = 1;

        // Vòng lặp tạo 10 Lớp học
        for ($lopIndex = 1; $lopIndex <= 10; $lopIndex++) {

            // a. Tạo Lớp
            $tenLop = 'DH522CN' . $lopIndex; // Tên lớp: DH522CN1, DH522CN2...
            $gvCN = $listGiangVienIDs[array_rand($listGiangVienIDs)];
            $cnID = $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)];

            $lopId = DB::table('lophoc')->insertGetId([
                'TenLop' => $tenLop,
                'NamHoc' => '2024-2025',
                'GiangVienID' => $gvCN,
                'ChuyenNganhID' => $cnID,
            ]);

            echo "✅ Đã tạo lớp: $tenLop (ID: $lopId)\n";

            // b. Tạo ngay 10 Sinh viên nhét vào lớp này
            for ($k = 1; $k <= 10; $k++) {
                // Tạo Mã SV: DH522 + 5 số (VD: DH52200001)
                $duoiMaSo = str_pad($svCounter, 5, '0', STR_PAD_LEFT);
                $mssv = 'DH522' . $duoiMaSo;

                $hoTenSV = $taoTen();

                // Tạo User
                $userId = DB::table('nguoidung')->insertGetId([
                    'TenDangNhap' => $mssv,
                    'Email' => $mssv . '@student.ntv.edu.vn',
                    'MatKhau' => Hash::make('123456'),
                    'HoTen' => $hoTenSV,
                    'VaiTro' => 'SinhVien',
                ]);

                // Tạo Hồ sơ SV - GÁN LUÔN VÀO LỚP VỪA TẠO
                DB::table('sinhvien')->insert([
                    'MaSV' => $mssv,
                    'HoTen' => $hoTenSV,
                    'NguoiDungID' => $userId,
                    'Lop' => $lopId, // <--- KHẮC PHỤC LỖI KHÔNG CÓ LỚP Ở ĐÂY
                ]);

                $svCounter++; // Tăng biến đếm cho sinh viên tiếp theo
            }
        }

        echo "✅ Đã tạo xong 100 Sinh viên và phân bổ đều vào 10 lớp!\n";
    }
}
