<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. GỌI SEEDER CHUYÊN NGÀNH
        $this->call(ChuyenNganhSeeder::class);
        
        // Lấy danh sách ID chuyên ngành
        $listChuyenNganhIDs = DB::table('chuyennganh')->pluck('ChuyenNganhID')->toArray();

        // Xóa sạch dữ liệu cũ
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('nguoidung')->truncate();
        DB::table('giangvien')->truncate();
        DB::table('lophoc')->truncate();
        DB::table('sinhvien')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "--- ĐANG TẠO DỮ LIỆU VỚI TÊN THẬT ---\n";

        // ================================================================
        // BỘ DỮ LIỆU TÊN TIẾNG VIỆT
        // ================================================================
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $demNam = ['Văn', 'Minh', 'Đức', 'Thành', 'Quốc', 'Tuấn', 'Hữu', 'Công', 'Gia'];
        $demNu = ['Thị', 'Ngọc', 'Thu', 'Mai', 'Thanh', 'Khánh', 'Hồng', 'Thùy'];
        $tenNam = ['Hùng', 'Tuấn', 'Dũng', 'Nam', 'Sơn', 'Huy', 'Phúc', 'Long', 'Quân', 'Minh', 'Hiếu', 'Thịnh', 'Trí', 'Tài'];
        $tenNu = ['Lan', 'Hương', 'Hoa', 'Thảo', 'Trang', 'Linh', 'Huyền', 'Ngân', 'Hằng', 'Nhung', 'Phương', 'Uyên', 'Vy'];

        // Hàm tạo tên ngẫu nhiên
        $taoTen = function() use ($ho, $demNam, $demNu, $tenNam, $tenNu) {
            $isNam = rand(0, 1);
            $chonHo = $ho[array_rand($ho)];
            if ($isNam) {
                return $chonHo . ' ' . $demNam[array_rand($demNam)] . ' ' . $tenNam[array_rand($tenNam)];
            } else {
                return $chonHo . ' ' . $demNu[array_rand($demNu)] . ' ' . $tenNu[array_rand($tenNu)];
            }
        };

        // ================================================================
        // 1. TẠO ADMIN
        // ================================================================
        DB::table('nguoidung')->insert([
            'TenDangNhap' => 'admin',
            'Email'       => 'daotao@ntv.edu.vn',
            'MatKhau'     => Hash::make('123456'),
            'HoTen'       => 'Phòng Đào Tạo',
            'VaiTro'      => 'Admin',
        ]);

        // ================================================================
        // 2. TẠO 5 GIẢNG VIÊN (TÊN THẬT)
        // ================================================================
        $listGiangVienIDs = [];
        $hocVis = ['Thạc sĩ', 'Tiến sĩ', 'Giáo sư'];

        for ($i = 1; $i <= 5; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $hoTenGV = $taoTen(); // Tạo tên thật
            
            // 2a. User Giảng viên
            $userId = DB::table('nguoidung')->insertGetId([
                'TenDangNhap' => strtolower($maGV),
                'Email'       => strtolower($maGV) . '@ntv.edu.vn',
                'MatKhau'     => Hash::make('123456'),
                'HoTen'       => $hoTenGV,
                'VaiTro'      => 'GiangVien',
            ]);

            // 2b. Hồ sơ Giảng viên
            $gvId = DB::table('giangvien')->insertGetId([
                'MaGV'          => $maGV,
                'HoTen'         => $hoTenGV,
                'HocVi'         => $hocVis[array_rand($hocVis)],
                'ChuyenNganhID' => $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)],
                'NguoiDungID'   => $userId,
            ]);

            $listGiangVienIDs[] = $gvId;
            echo "   + GV: $maGV - $hoTenGV\n";
        }

        // ================================================================
        // 3. TẠO 3 LỚP HỌC MẪU
        // ================================================================
        $tenLops = ['CNTT K15', 'KTPM K16', 'HTTT K15'];
        $listLopIDs = [];

        foreach ($tenLops as $tenLop) {
            $lopId = DB::table('lophoc')->insertGetId([
                'TenLop'        => $tenLop,
                'GiangVienID'   => $listGiangVienIDs[array_rand($listGiangVienIDs)],
                'ChuyenNganhID' => $listChuyenNganhIDs[array_rand($listChuyenNganhIDs)],
            ]);
            $listLopIDs[] = $tenLop; // Lưu tên lớp để gán cho SV
        }

        // ================================================================
        // 4. TẠO 15 SINH VIÊN (TÊN THẬT)
        // ================================================================
        for ($k = 1; $k <= 15; $k++) {
            $mssv = 'SV24' . str_pad($k, 3, '0', STR_PAD_LEFT);
            $hoTenSV = $taoTen(); // Tạo tên thật

            // 4a. User Sinh viên
            $userId = DB::table('nguoidung')->insertGetId([
                'TenDangNhap' => $mssv,
                'Email'       => $mssv . '@student.ntv.edu.vn',
                'MatKhau'     => Hash::make('123456'),
                'HoTen'       => $hoTenSV,
                'VaiTro'      => 'SinhVien',
            ]);

            // 4b. Hồ sơ Sinh viên
            DB::table('sinhvien')->insert([
                'MaSV'        => $mssv,
                'HoTen'       => $hoTenSV,
                'NguoiDungID' => $userId,
                'Lop'         => $listLopIDs[array_rand($listLopIDs)],
            ]);
        }
        
        echo "✅ Xong! Đã tạo 15 SV với tên tiếng Việt ngẫu nhiên.\n";
    }
}