<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\NguoiDung;
use App\Models\LopHoc; // Import Model LopHoc
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    // 1. Xem danh sách
    public function index()
    {
        $dsSinhVien = SinhVien::all();
        return view('admin.sinhvien.index', compact('dsSinhVien'));
    }

    // 2. Hiển thị form thêm (Lấy danh sách lớp từ DB)
    public function hienFormThem()
    {
        $dsLop = LopHoc::all(); 
        return view('admin.sinhvien.them', compact('dsLop'));
    }

    // 3. Xử lý lưu
    public function luuSinhVien(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'MaSV' => ['required', 'unique:sinhvien,MaSV', 'unique:nguoidung,TenDangNhap', 'regex:/^DH522[0-9]{5}$/'],
            'HoTen' => 'required|string|max:255',
            'NgaySinh' => 'required|date', // Bắt buộc nhập ngày sinh
            'Lop' => 'required',           // Bắt buộc chọn lớp
        ], [
            'MaSV.regex' => 'Mã SV phải là DH522 + 5 số.',
            'MaSV.unique' => 'Mã sinh viên hoặc tài khoản đã tồn tại.',
            'NgaySinh.required' => 'Vui lòng chọn ngày sinh.',
            'Lop.required' => 'Vui lòng chọn lớp.',
        ]);

        DB::beginTransaction();
        try {
            $mssv = $request->MaSV;
            $email = $mssv . '@student.ntv.vn';
            
            // Tạo User
            $user = NguoiDung::create([
                'TenDangNhap' => $mssv,
                'Email' => $email,
                'MatKhau' => Hash::make('123456'),
                'HoTen' => $request->HoTen,
                'VaiTro' => 'SinhVien',
            ]);

            // Tạo SinhVien (Lưu NgaySinh và Lớp)
            SinhVien::create([
                'MaSV' => $mssv,
                'HoTen' => $request->HoTen,
                'NgaySinh' => $request->NgaySinh, 
                'Lop' => $request->Lop,          
                'NguoiDungID' => $user->id,
            ]);

            DB::commit();
            return redirect('/admin/sinh-vien')->with('success', "Đã thêm SV $request->HoTen thành công!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
    
    // 4. Hiển thị form sửa
    public function hienFormSua($id)
    {
        // Đổi tên biến thành $sv cho khớp với View sua.blade.php
        $sv = SinhVien::find($id);
        
        if (!$sv) return redirect('/admin/sinh-vien')->with('error', 'Không tìm thấy sinh viên!');
        
        $dsLop = LopHoc::all(); // Lấy danh sách lớp đổ vào dropdown
        
        return view('admin.sinhvien.sua', compact('sv', 'dsLop'));
    }

    // 5. Xử lý cập nhật
    public function capNhat(Request $request, $id)
    {
        $sinhvien = SinhVien::find($id);
        
        // Validate
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'NgaySinh' => 'required|date',
            'Lop' => 'required',
        ], [
            'NgaySinh.required' => 'Vui lòng chọn ngày sinh.',
        ]);

        // Cập nhật thông tin hồ sơ
        $sinhvien->update([
            'HoTen' => $request->HoTen,
            'NgaySinh' => $request->NgaySinh, // Cập nhật ngày sinh
            'Lop'   => $request->Lop,         // Cập nhật lớp
        ]);

        // Cập nhật tên bên bảng User cho đồng bộ
        if ($sinhvien->NguoiDungID) {
            $user = NguoiDung::find($sinhvien->NguoiDungID);
            if ($user) {
                $user->update(['HoTen' => $request->HoTen]);
            }
        }

        return redirect('/admin/sinh-vien')->with('success', 'Cập nhật thông tin thành công!');
    }

    // 6. Xóa sinh viên
    public function xoa($id) {
        try {
            $sinhvien = SinhVien::find($id);
            if ($sinhvien) {
                $userId = $sinhvien->NguoiDungID;
                $sinhvien->delete();
                if ($userId) NguoiDung::destroy($userId);
            }
            return redirect()->back()->with('success', 'Đã xóa sinh viên!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}