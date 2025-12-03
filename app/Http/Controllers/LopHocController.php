<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\GiangVien;

class LopHocController extends Controller
{
    // 1. Danh sách
    public function index() {
        $dsLop = LopHoc::with('giangVien')->get();
        return view('admin.lophoc.index', ['dsLop' => $dsLop]);
    }

    // 2. Thêm mới
    public function hienFormThem() {
        $dsGiangVien = GiangVien::all();
        return view('admin.lophoc.them', ['dsGiangVien' => $dsGiangVien]);
    }

    public function luuLopHoc(Request $request) {
        $request->validate([
            'TenLop' => 'required|unique:lophoc,TenLop',
            'GiangVienID' => 'required',
        ], [
            'TenLop.unique' => 'Tên lớp này đã tồn tại!',
            'TenLop.required' => 'Vui lòng nhập tên lớp.',
            'GiangVienID.required' => 'Vui lòng chọn giảng viên chủ nhiệm.'
        ]);

        LopHoc::create($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Đã tạo lớp học mới!');
    }

    // 3. Sửa
    public function hienFormSua($id) {
        $lop = LopHoc::find($id);
        $dsGiangVien = GiangVien::all();
        return view('admin.lophoc.sua', ['lop' => $lop, 'dsGiangVien' => $dsGiangVien]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'TenLop' => 'required|unique:lophoc,TenLop,'.$id.',LopID',
            'GiangVienID' => 'required',
        ]);

        $lop = LopHoc::find($id);
        $lop->update($request->all());
        return redirect('/admin/lop-hoc')->with('success', 'Cập nhật lớp thành công!');
    }

    // 4. Xóa
    public function xoa($id) {
        LopHoc::find($id)->delete();
        return redirect('/admin/lop-hoc')->with('success', 'Đã xóa lớp học.');
    }
}