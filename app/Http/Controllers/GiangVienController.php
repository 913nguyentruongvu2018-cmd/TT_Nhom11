<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiangVien;

class GiangVienController extends Controller
{
    // 1. Xem danh sách
    public function index() {
        $dsGiangVien = GiangVien::all();
        return view('admin.giangvien.index', ['dsGiangVien' => $dsGiangVien]);
    }

    // 2. Thêm mới
    public function hienFormThem() {
        return view('admin.giangvien.them');
    }

    public function luuGiangVien(Request $request) {
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV',
            'HoTen' => 'required',
        ], [
            'MaGV.unique' => 'Mã giảng viên này đã tồn tại!',
            'MaGV.required' => 'Vui lòng nhập mã giảng viên.',
            'HoTen.required' => 'Vui lòng nhập họ tên.'
        ]);

        GiangVien::create([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganh' => $request->ChuyenNganh,
            'NguoiDungID' => null
        ]);

        return redirect('/admin/giang-vien')->with('success', 'Đã thêm giảng viên mới thành công!');
    }

    // 3. Sửa
    public function hienFormSua($id) {
        $gv = GiangVien::find($id);
        return view('admin.giangvien.sua', ['gv' => $gv]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV,'.$id.',GiangVienID',
            'HoTen' => 'required',
        ]);

        $gv = GiangVien::find($id);
        $gv->update([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganh' => $request->ChuyenNganh
        ]);

        return redirect('/admin/giang-vien')->with('success', 'Đã cập nhật thông tin giảng viên!');
    }

    // 4. Xóa
    public function xoa($id) {
        $gv = GiangVien::find($id);
        $gv->delete();
        return redirect('/admin/giang-vien')->with('success', 'Đã xóa giảng viên.');
    }
}