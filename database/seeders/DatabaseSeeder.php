<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. TẠO TÀI KHOẢN ADMIN
        DB::table('nguoidung')->insert([
            'TenDangNhap' => 'admin',
            'Email' => 'admin@ntv.edu.vn', // Đã có email
            'MatKhau' => Hash::make('123456'), 
            'HoTen' => 'Quản Trị Viên',
            'VaiTro' => 'Admin',
        ]);

        // --- KHAI BÁO BIẾN TRƯỚC KHI DÙNG (Sửa lỗi ảnh 2) ---
        $soNgauNhien = rand(10000, 99999);
        $mssv = 'DH522' . $soNgauNhien;             // Tạo biến mssv
        $emailSinhVien = $mssv . '@student.ntv.vn'; // Tạo biến email
        // ---------------------------------------------------

        // 2. TẠO TÀI KHOẢN SINH VIÊN
        $studentUserId = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => $mssv,        // Dùng biến đã khai báo
            'Email' => $emailSinhVien,     // Dùng biến đã khai báo
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Nguyễn Văn A',
            'VaiTro' => 'SinhVien',
        ]);

        // 3. TẠO HỒ SƠ SINH VIÊN
        DB::table('sinhvien')->insert([
            'MaSV' => $mssv,
            'HoTen' => 'Nguyễn Văn A',
            'NguoiDungID' => $studentUserId,
            'Lop' => 'CNTT K15',
        ]);

        // 4. TẠO MÔN HỌC MẪU
        DB::table('monhoc')->insert([
            ['TenMonHoc' => 'Lập Trình Web', 'SoTinChi' => 3],
            ['TenMonHoc' => 'Cơ Sở Dữ Liệu', 'SoTinChi' => 4],
            ['TenMonHoc' => 'Tiếng Anh Chuyên Ngành', 'SoTinChi' => 2],
        ]);

        echo "Đã tạo xong dữ liệu SV mẫu! \n";
        echo "Email SV: $emailSinhVien \n";

        // 5. TẠO TÀI KHOẢN GIẢNG VIÊN 1 (SỬA LỖI ẢNH 1 TẠI ĐÂY)
        $gvUserId1 = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => 'gv01',
            'Email' => 'gv01@ntv.edu.vn', // <--- THÊM DÒNG NÀY
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Thầy Giáo Ba',
            'VaiTro' => 'GiangVien',
        ]);

        // 6. TẠO HỒ SƠ GIẢNG VIÊN 1
        $gvId1 = DB::table('giangvien')->insertGetId([
            'MaGV' => 'GV001',
            'HoTen' => 'Thầy Giáo Ba',
            'HocVi' => 'Tiến sĩ',
            'ChuyenNganh' => 'Công nghệ phần mềm',
            'NguoiDungID' => $gvUserId1,
        ]);

        // 7. TẠO TÀI KHOẢN GIẢNG VIÊN 2 (SỬA LỖI ẢNH 1 TẠI ĐÂY)
        $gvUserId2 = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => 'gv02',
            'Email' => 'gv02@ntv.edu.vn', // <--- THÊM DÒNG NÀY
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Cô Giáo Tư',
            'VaiTro' => 'GiangVien',
        ]);

        // 8. TẠO HỒ SƠ GIẢNG VIÊN 2
        $gvId2 = DB::table('giangvien')->insertGetId([
            'MaGV' => 'GV002',
            'HoTen' => 'Cô Giáo Tư',
            'HocVi' => 'Thạc sĩ',
            'ChuyenNganh' => 'Hệ thống thông tin',
            'NguoiDungID' => $gvUserId2,
        ]);

        // 9. TẠO LỚP HỌC
        DB::table('lophoc')->insert([
            ['TenLop' => 'CNTT K15', 'GiangVienID' => $gvId1],
            ['TenLop' => 'CNTT K16', 'GiangVienID' => $gvId2],
            ['TenLop' => 'KTPM K15', 'GiangVienID' => $gvId1],
        ]);

        // 10. TẠO THỜI KHÓA BIỂU MẪU
        DB::table('thoikhoabieu')->insert([
            [
                'LopID' => 1,
                'MonHocID' => 1,
                'GiangVienID' => 1,
                'ThuTrongTuan' => 'Hai',
                'GioBatDau' => '07:00:00',
                'GioKetThuc' => '11:00:00',
                'PhongHoc' => 'A101',
            ],
            [
                'LopID' => 1,
                'MonHocID' => 2,
                'GiangVienID' => 2,
                'ThuTrongTuan' => 'Tu',
                'GioBatDau' => '13:00:00',
                'GioKetThuc' => '16:30:00',
                'PhongHoc' => 'Lab 3',
            ],
            [
                'LopID' => 2,
                'MonHocID' => 1,
                'GiangVienID' => 1,
                'ThuTrongTuan' => 'Sau',
                'GioBatDau' => '07:00:00',
                'GioKetThuc' => '11:00:00',
                'PhongHoc' => 'C305',
            ],
        ]);
        
        echo "Đã nạp full dữ liệu thành công!";
    }
}