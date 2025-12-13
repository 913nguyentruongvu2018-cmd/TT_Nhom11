<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\GiangVien;
use App\Models\ChuyenNganh; // Nhớ thêm

class LopHocController extends Controller
{
    public function index() {
        // Load cả giảng viên và chuyên ngành
        $dsLop = LopHoc::with(['giangVien', 'chuyenNganh'])->get();
        return view('admin.lophoc.index', ['dsLop' => $dsLop]);
    }

    public function hienFormThem() {
        $dsGiangVien = GiangVien::all();
        $dsChuyenNganh = ChuyenNganh::all(); // Lấy list CN
        return view('admin.lophoc.them', [
            'dsGiangVien' => $dsGiangVien, 
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    public function luuLopHoc(Request $request) {
        $request->validate([
            'TenLop' => 'required|unique:lophoc,TenLop',
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ]);

        LopHoc::create($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Đã tạo lớp học mới!');
    }

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
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ]);

        $lop = LopHoc::find($id);
        $lop->update($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Cập nhật thành công!');
    }

    public function xoa($id) {
        LopHoc::find($id)->delete();
        return redirect('/admin/lop-hoc')->with('success', 'Đã xóa lớp học.');
    }
}