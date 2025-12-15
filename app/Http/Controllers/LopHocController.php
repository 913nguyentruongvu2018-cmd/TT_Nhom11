<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\GiangVien;
use App\Models\ChuyenNganh;

class LopHocController extends Controller
{
    // 1. Danh sách + TÌM KIẾM
    public function index(Request $request) {
        // Khởi tạo query
        $query = LopHoc::with(['giangVien', 'chuyenNganh']);

        // Tìm theo tên lớp
        if ($request->filled('tim_ten')) {
            $query->where('TenLop', 'LIKE', '%' . $request->tim_ten . '%');
        }

        // Tìm theo chuyên ngành
        if ($request->filled('tim_cn')) {
            $query->where('ChuyenNganhID', $request->tim_cn);
        }

        // Tìm theo năm học
        if ($request->filled('tim_nam')) {
            $query->where('NamHoc', 'LIKE', '%' . $request->tim_nam . '%');
        }

        $dsLop = $query->get();
        
        // Lấy danh sách chuyên ngành để hiện vào ô lọc
        $dsChuyenNganh = ChuyenNganh::all(); 

        return view('admin.lophoc.index', [
            'dsLop' => $dsLop,
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    // 2. Thêm mới
    public function hienFormThem() {
        $dsGiangVien = GiangVien::all();
        $dsChuyenNganh = ChuyenNganh::all();
        return view('admin.lophoc.them', [
            'dsGiangVien' => $dsGiangVien,
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    public function luuLopHoc(Request $request) {
        $request->validate([
            'TenLop' => 'required|unique:lophoc,TenLop',
            'NamHoc' => 'required', // Bắt buộc nhập
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ]);

        LopHoc::create($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Đã tạo lớp học mới!');
    }

    // 3. Sửa
    public function hienFormSua($id) {
        $lop = LopHoc::find($id);
        $dsGiangVien = GiangVien::all();
        $dsChuyenNganh = ChuyenNganh::all();
        return view('admin.lophoc.sua', [
            'lop' => $lop, 
            'dsGiangVien' => $dsGiangVien,
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'TenLop' => 'required|unique:lophoc,TenLop,'.$id.',LopID',
            'NamHoc' => 'required',
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ]);

        $lop = LopHoc::find($id);
        $lop->update($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Cập nhật thành công!');
    }

    // 4. Xóa
    public function xoa($id) {
        LopHoc::find($id)->delete();
        return redirect('/admin/lop-hoc')->with('success', 'Đã xóa lớp học.');
    }
}