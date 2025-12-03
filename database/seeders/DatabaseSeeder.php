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
            'MatKhau' => Hash::make('123456'), // Mật khẩu là 123456
            'HoTen' => 'Quản Trị Viên',
            'VaiTro' => 'Admin',
        ]);

        // 2. TẠO TÀI KHOẢN SINH VIÊN (Và lấy luôn ID vừa tạo)
        $studentUserId = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => 'sinhvien',
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Nguyễn Văn A',
            'VaiTro' => 'SinhVien',
        ]);

        // 3. TẠO HỒ SƠ SINH VIÊN (Nối với tài khoản trên)
        DB::table('sinhvien')->insert([
            'MaSV' => 'SV001',
            'HoTen' => 'Nguyễn Văn A',
            'NguoiDungID' => $studentUserId, // Tự động điền ID
            'Lop' => 'CNTT K15',
        ]);

        // 4. TẠO MÔN HỌC MẪU
        DB::table('monhoc')->insert([
            ['TenMonHoc' => 'Lập Trình Web', 'SoTinChi' => 3],
            ['TenMonHoc' => 'Cơ Sở Dữ Liệu', 'SoTinChi' => 4],
            ['TenMonHoc' => 'Tiếng Anh Chuyên Ngành', 'SoTinChi' => 2],
        ]);

        echo "Đã tạo xong dữ liệu mẫu! \n";
        echo "Admin: admin / 123456 \n";
        echo "SinhVien: sinhvien / 123456 \n";

        // 5. TẠO TÀI KHOẢN GIẢNG VIÊN 1
        $gvUserId1 = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => 'gv01',
            'MatKhau' => Hash::make('123456'),
            'HoTen' => 'Thầy Giáo Ba',
            'VaiTro' => 'GiangVien',
        ]);

        // 6. TẠO HỒ SƠ GIẢNG VIÊN 1 (Lấy ID vừa tạo ở trên)
        $gvId1 = DB::table('giangvien')->insertGetId([
            'MaGV' => 'GV001',
            'HoTen' => 'Thầy Giáo Ba',
            'HocVi' => 'Tiến sĩ',
            'ChuyenNganh' => 'Công nghệ phần mềm',
            'NguoiDungID' => $gvUserId1,
        ]);

        // 7. TẠO TÀI KHOẢN GIẢNG VIÊN 2
        $gvUserId2 = DB::table('nguoidung')->insertGetId([
            'TenDangNhap' => 'gv02',
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

        // 9. TẠO LỚP HỌC (Gán cho giảng viên chủ nhiệm)
        DB::table('lophoc')->insert([
            ['TenLop' => 'CNTT K15', 'GiangVienID' => $gvId1], // Thầy Ba chủ nhiệm
            ['TenLop' => 'CNTT K16', 'GiangVienID' => $gvId2], // Cô Tư chủ nhiệm
            ['TenLop' => 'KTPM K15', 'GiangVienID' => $gvId1],
        ]);
        // 10. TẠO THỜI KHÓA BIỂU MẪU
        // Lưu ý: ID 1, 2, 3... tương ứng với thứ tự bạn tạo Lớp/Môn/GV ở trên
        DB::table('thoikhoabieu')->insert([
            [
                'LopID' => 1,        // Lớp CNTT K15
                'MonHocID' => 1,     // Môn Lập Trình Web
                'GiangVienID' => 1,  // Thầy Ba
                'ThuTrongTuan' => 'Hai',
                'GioBatDau' => '07:00:00',
                'GioKetThuc' => '11:00:00',
                'PhongHoc' => 'A101',
            ],
            [
                'LopID' => 1,        // Vẫn lớp CNTT K15
                'MonHocID' => 2,     // Môn Cơ Sở Dữ Liệu
                'GiangVienID' => 2,  // Cô Tư
                'ThuTrongTuan' => 'Tu',
                'GioBatDau' => '13:00:00',
                'GioKetThuc' => '16:30:00',
                'PhongHoc' => 'Lab 3',
            ],
            [
                'LopID' => 2,        // Lớp CNTT K16
                'MonHocID' => 1,     // Môn Lập Trình Web
                'GiangVienID' => 1,  // Thầy Ba
                'ThuTrongTuan' => 'Sau',
                'GioBatDau' => '07:00:00',
                'GioKetThuc' => '11:00:00',
                'PhongHoc' => 'C305',
            ],
        ]);
        
        echo "Đã nạp full dữ liệu mẫu (Admin, SV, GV, Môn, Lớp, TKB)!";
    }
}