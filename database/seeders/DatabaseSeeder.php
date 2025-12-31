<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\NguoiDung;
use App\Models\ChuyenNganh;
use App\Models\GiangVien;
use App\Models\LopHoc;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\Diem;
use App\Models\ThoiKhoaBieu;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Khởi tạo Faker tiếng Việt
        $faker = Faker::create('vi_VN');

        // =================================================================
        // 1. TẠO ADMIN 
        // =================================================================
        NguoiDung::create([
            'TenDangNhap' => 'admin',
            'Email'       => 'pdt@mailinator.com',
            'MatKhau'     => Hash::make('123456'),
            'HoTen'       => 'Quản Trị Hệ Thống',
            'VaiTro'      => 'Admin'
        ]);
        $this->command->info('1. Đã tạo Admin.');


        // =================================================================
        // 2. TẠO CHUYÊN NGÀNH
        // =================================================================
        $itMajors = [
            'KTPM' => 'Kỹ thuật Phần mềm',
            'HTTT' => 'Hệ thống Thông tin',
            'KHMT' => 'Khoa học Máy tính',
            'ATTT' => 'An toàn Thông tin',
            'MMT'  => 'Mạng Máy tính & Viễn thông'
        ];
        $cnIds = [];
        foreach ($itMajors as $ma => $ten) {
            $cn = ChuyenNganh::create(['MaCN' => $ma, 'TenChuyenNganh' => $ten]);
            $cnIds[] = $cn->ChuyenNganhID;
        }
        $this->command->info('2. Đã tạo Chuyên ngành.');


        // =================================================================
        // 3. TẠO GIẢNG VIÊN (20 người cho cân đối với 100 SV)
        // =================================================================
        $gvIds = [];
        for ($i = 1; $i <= 20; $i++) {
            $maGV = 'GV' . str_pad($i, 3, '0', STR_PAD_LEFT); 
            $hoTen = $faker->lastName . ' ' . $faker->middleName . ' ' . $faker->firstName;

            $user = NguoiDung::create([
                'TenDangNhap' => strtolower($maGV),
                'Email'       => strtolower($maGV) . '@mailinator.com',
                'MatKhau'     => Hash::make('123456'),
                'HoTen'       => $hoTen,
                'VaiTro'      => 'GiangVien'
            ]);

            $gv = GiangVien::create([
                'MaGV'          => $maGV,
                'HoTen'         => $hoTen,
                'HocVi'         => $faker->randomElement(['Thạc sĩ', 'Tiến sĩ', 'Cử nhân']),
                'ChuyenNganhID' => $faker->randomElement($cnIds),
                'NguoiDungID'   => $user->id
            ]);
            $gvIds[] = $gv->GiangVienID;
        }
        $this->command->info('3. Đã tạo 20 Giảng viên.');


        // =================================================================
        // 4. TẠO LỚP HỌC (20 Lớp: D22_TH01 -> D22_TH20)
        // =================================================================
        $lopIds = [];
        $keysMajors = array_keys($itMajors); 

        for ($i = 1; $i <= 20; $i++) { 
            $maNganhRandom = $faker->randomElement($keysMajors);
            $cnModel = ChuyenNganh::where('MaCN', $maNganhRandom)->first();

            $tenLop = 'D22_TH' . str_pad($i, 2, '0', STR_PAD_LEFT);

            $lop = LopHoc::create([
                'TenLop'        => $tenLop,
                'NamHoc'        => '2022-2026',
                'GiangVienID'   => $faker->randomElement($gvIds),
                'ChuyenNganhID' => $cnModel->ChuyenNganhID
            ]);
            $lopIds[] = $lop->LopID;
        }
        $this->command->info('4. Đã tạo 20 Lớp học.');


        // =================================================================
        // 5. TẠO SINH VIÊN (100 BẠN)
        // =================================================================
        $svIds = [];
        $hoPhoBien = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Huỳnh', 'Hoàng', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Ngô', 'Dương'];
        
        for ($i = 1; $i <= 100; $i++) {
            $maSV = 'DH522' . str_pad($i, 5, '0', STR_PAD_LEFT); 
            
            $hoTen = $faker->randomElement($hoPhoBien) . ' ' . $faker->middleName . ' ' . $faker->firstName;

            $user = NguoiDung::create([
                'TenDangNhap' => $maSV,
                'Email'       => $maSV . '@mailinator.com',
                'MatKhau'     => Hash::make('123456'),
                'HoTen'       => $hoTen,
                'VaiTro'      => 'SinhVien'
            ]);

            $sv = SinhVien::create([
                'MaSV'        => $maSV,
                'HoTen'       => $hoTen,
                'NguoiDungID' => $user->id,
                'LopID'       => $faker->randomElement($lopIds),
                'NgaySinh'    => $faker->dateTimeBetween('2004-01-01', '2004-12-31')->format('Y-m-d') 
            ]);
            $svIds[] = $sv->id;
        }
        $this->command->info('5. Đã tạo 100 Sinh viên.');


        // =================================================================
        // 6. TẠO MÔN HỌC
        // =================================================================
        $itSubjects = [
            'Nhập môn Lập trình', 'Kỹ thuật Lập trình', 'Lập trình Java',
            'Cấu trúc Dữ liệu', 'Cơ sở Dữ liệu', 'Hệ Quản trị CSDL',
            'Kiến trúc Máy tính', 'Mạng Máy tính', 'Hệ điều hành', 
            'Lập trình Web', 'Công nghệ Phần mềm', 'Quản trị Dự án',
            'Lập trình Di động', 'Trí tuệ Nhân tạo', 'An toàn Thông tin', 
            'Thực tập Chuyên ngành', 'Đồ án Tốt nghiệp', 'Điện toán đám mây'
        ];

        $mhIds = [];
        foreach ($itSubjects as $idx => $tenMon) {
            $maMon = 'IT' . str_pad($idx + 1, 3, '0', STR_PAD_LEFT);
            $mh = MonHoc::create([
                'MaMon'      => $maMon,
                'TenMonHoc'  => $tenMon,
                'SoTinChi'   => $faker->randomElement([2, 3, 4])
            ]);
            $mhIds[] = $mh->MonHocID;
        }
        $this->command->info('6. Đã tạo Môn học.');


        // =================================================================
        // 7. NHẬP ĐIỂM
        // =================================================================
        foreach ($svIds as $sinhVienID) {
            // Mỗi sinh viên có điểm của 4 môn ngẫu nhiên
            $randomSubjects = $faker->randomElements($mhIds, 4); 
            foreach ($randomSubjects as $monHocID) {
                Diem::create([
                    'SinhVienID' => $sinhVienID,
                    'MonHocID'   => $monHocID,
                    'DiemSo'     => $faker->randomFloat(1, 4.0, 10.0)
                ]);
            }
        }
        $this->command->info('7. Đã nhập Điểm số.');


        // =================================================================
        // 8. TẠO TKB (50 slot cho dày lịch)
        // =================================================================
        for ($i = 0; $i < 50; $i++) {
            $gioBatDau = $faker->randomElement(['07:00:00', '09:00:00', '13:00:00', '15:00:00']);
            ThoiKhoaBieu::create([
                'LopID'        => $faker->randomElement($lopIds),
                'MonHocID'     => $faker->randomElement($mhIds),
                'GiangVienID'  => $faker->randomElement($gvIds),
                'ThuTrongTuan' => $faker->randomElement(['Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy']),
                'GioBatDau'    => $gioBatDau,
                'GioKetThuc'   => date('H:i:s', strtotime($gioBatDau) + 3*3600),
                'PhongHoc'     => $faker->randomElement(['A101', 'A202', 'B303', 'C404', 'Lab-01', 'Lab-02'])
            ]);
        }
        
        $this->command->info('=== DONE (Đã tạo 100 SV thành công) ===');
    }
}