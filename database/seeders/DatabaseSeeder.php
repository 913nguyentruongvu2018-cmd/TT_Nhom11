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

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. TẠO NGƯỜI DÙNG (ADMIN)
        // --------------------------------------------
        NguoiDung::create([
            'TenDangNhap' => 'admin',
            'Email' => 'admin@mailinator.com', // Cập nhật đuôi mailinator
            'MatKhau' => Hash::make('123456'), 
            'HoTen' => 'Quản Trị Viên',
            'VaiTro' => 'Admin'
        ]);

        // 2. TẠO CHUYÊN NGÀNH
        // --------------------------------------------
        $cnCNTT = ChuyenNganh::create(['MaCN' => 'CNTT', 'TenChuyenNganh' => 'Công Nghệ Thông Tin']);
        $cnKT = ChuyenNganh::create(['MaCN' => 'KT', 'TenChuyenNganh' => 'Kế Toán']);

        // 3. TẠO GIẢNG VIÊN & TÀI KHOẢN GIẢNG VIÊN
        // --------------------------------------------
        // GV 1
        $userGV1 = NguoiDung::create([
            'TenDangNhap' => 'gv01',
            'Email' => 'gv01@mailinator.com', // Cập nhật đuôi mailinator
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Nguyễn Văn Thầy',
            'VaiTro' => 'GiangVien'
        ]);
        $gv1 = GiangVien::create([
            'MaGV' => 'GV001',
            'HoTen' => 'Nguyễn Văn Thầy',
            'HocVi' => 'Thạc sĩ',
            'ChuyenNganhID' => $cnCNTT->ChuyenNganhID,
            'NguoiDungID' => $userGV1->id
        ]);

        // GV 2
        $userGV2 = NguoiDung::create([
            'TenDangNhap' => 'gv02',
            'Email' => 'gv02@mailinator.com', // Cập nhật đuôi mailinator
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Trần Thị Cô',
            'VaiTro' => 'GiangVien'
        ]);
        $gv2 = GiangVien::create([
            'MaGV' => 'GV002',
            'HoTen' => 'Trần Thị Cô',
            'HocVi' => 'Tiến sĩ',
            'ChuyenNganhID' => $cnKT->ChuyenNganhID,
            'NguoiDungID' => $userGV2->id
        ]);

        // 4. TẠO LỚP HỌC
        // --------------------------------------------
        $lop1 = LopHoc::create([
            'TenLop' => 'CNTT-K15',
            'NamHoc' => '2024-2025',
            'GiangVienID' => $gv1->GiangVienID,
            'ChuyenNganhID' => $cnCNTT->ChuyenNganhID
        ]);

        $lop2 = LopHoc::create([
            'TenLop' => 'KT-K15',
            'NamHoc' => '2024-2025',
            'GiangVienID' => $gv2->GiangVienID,
            'ChuyenNganhID' => $cnKT->ChuyenNganhID
        ]);

        // 5. TẠO SINH VIÊN & TÀI KHOẢN SV
        // --------------------------------------------
        // SV 1
        $userSV1 = NguoiDung::create([
            'TenDangNhap' => 'DH52201111',
            'Email' => 'sv01@mailinator.com', // Cập nhật đuôi mailinator
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Lê Văn Trò',
            'VaiTro' => 'SinhVien'
        ]);
        $sv1 = SinhVien::create([
            'MaSV' => 'DH52201230',
            'HoTen' => 'Lê Văn Trò',
            'NguoiDungID' => $userSV1->id,
            'LopID' => $lop1->LopID,
            'NgaySinh' => '2003-01-01'
        ]);

        // SV 2
        $userSV2 = NguoiDung::create([
            'TenDangNhap' => 'DH52201231',
            'Email' => 'sv02@mailinator.com', // Cập nhật đuôi mailinator
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Phạm Thị Mơ',
            'VaiTro' => 'SinhVien'
        ]);
        $sv2 = SinhVien::create([
            'MaSV' => 'SV002',
            'HoTen' => 'Phạm Thị Mơ',
            'NguoiDungID' => $userSV2->id,
            'LopID' => $lop2->LopID,
            'NgaySinh' => '2003-05-20'
        ]);

        // 6. TẠO MÔN HỌC
        // --------------------------------------------
        $monPHP = MonHoc::create(['MaMon' => 'MH01', 'TenMonHoc' => 'Lập trình PHP', 'SoTinChi' => 3]);
        $monCSDL = MonHoc::create(['MaMon' => 'MH03', 'TenMonHoc' => 'Cơ sở dữ liệu', 'SoTinChi' => 4]);

        // 7. NHẬP ĐIỂM MẪU
        // --------------------------------------------
        Diem::create(['SinhVienID' => $sv1->id, 'MonHocID' => $monPHP->MonHocID, 'DiemSo' => 8.5]);
        Diem::create(['SinhVienID' => $sv2->id, 'MonHocID' => $monPHP->MonHocID, 'DiemSo' => 9.0]);

        // 8. TẠO THỜI KHÓA BIỂU
        // --------------------------------------------
        ThoiKhoaBieu::create([
            'LopID' => $lop1->LopID,
            'MonHocID' => $monPHP->MonHocID,
            'GiangVienID' => $gv1->GiangVienID,
            'ThuTrongTuan' => 'Hai',
            'GioBatDau' => '07:00:00',
            'GioKetThuc' => '11:00:00',
            'PhongHoc' => 'A101'
        ]);
    }
}