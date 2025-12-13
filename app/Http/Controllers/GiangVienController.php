<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiangVien;
use App\Models\ChuyenNganh; // Nhớ thêm dòng này

class GiangVienController extends Controller
{
    public function index() {
        // Load thêm quan hệ chuyenNganh để hiển thị tên
        $dsGiangVien = GiangVien::with('chuyenNganh')->get();
        return view('admin.giangvien.index', ['dsGiangVien' => $dsGiangVien]);
    }

    public function hienFormThem() {
        $dsChuyenNganh = ChuyenNganh::all(); // Lấy list chuyên ngành
        return view('admin.giangvien.them', ['dsChuyenNganh' => $dsChuyenNganh]);
    }

    public function luuGiangVien(Request $request) {
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV',
            'HoTen' => 'required',
            'ChuyenNganhID' => 'required', // Bắt buộc chọn
        ]);

        GiangVien::create([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganhID' => $request->ChuyenNganhID, // Lưu ID
            'NguoiDungID' => null
        ]);

        return redirect('/admin/giang-vien')->with('success', 'Đã thêm giảng viên!');
    }

    public function hienFormSua($id) {
        $gv = GiangVien::find($id);
        $dsChuyenNganh = ChuyenNganh::all();
        return view('admin.giangvien.sua', ['gv' => $gv, 'dsChuyenNganh' => $dsChuyenNganh]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV,'.$id.',GiangVienID',
            'HoTen' => 'required',
            'ChuyenNganhID' => 'required',
        ]);

        $gv = GiangVien::find($id);
        $gv->update([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganhID' => $request->ChuyenNganhID
        ]);

        return redirect('/admin/giang-vien')->with('success', 'Cập nhật thành công!');
    }

    public function xoa($id) {
        GiangVien::find($id)->delete();
        return redirect('/admin/giang-vien')->with('success', 'Đã xóa giảng viên.');
    }
}