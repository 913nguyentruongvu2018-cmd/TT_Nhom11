<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\GiangVien;
use App\Models\ChuyenNganh;

class LopHocController extends Controller
{
    
    public function index(Request $request) {
        
        $query = LopHoc::with(['giangVien', 'chuyenNganh']);

        
        if ($request->filled('tim_ten')) {
            $query->where('TenLop', 'LIKE', '%' . $request->tim_ten . '%');
        }

        
        if ($request->filled('tim_cn')) {
            $query->where('ChuyenNganhID', $request->tim_cn);
        }

        
        if ($request->filled('tim_nam')) {
            $query->where('NamHoc', 'LIKE', '%' . $request->tim_nam . '%');
        }

        $dsLop = $query->get();
        
        
        $dsChuyenNganh = ChuyenNganh::all(); 

        return view('admin.lophoc.index', [
            'dsLop' => $dsLop,
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    
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
            'NamHoc' => 'required', 
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ],[
            'TenLop.required'        => 'Vui lòng nhập tên lớp.',
            'TenLop.unique'          => 'Tên lớp này đã tồn tại.',
            'NamHoc.required'        => 'Vui lòng nhập khóa học/năm học.',
            'GiangVienID.required'   => 'Vui lòng chọn cố vấn học tập (GVCN).',
            'ChuyenNganhID.required' => 'Vui lòng chọn chuyên ngành.',
        ]
    );

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
            'NamHoc' => 'required',
            'GiangVienID' => 'required',
            'ChuyenNganhID' => 'required',
        ],[
            'TenLop.required'        => 'Vui lòng nhập tên lớp.',
            'TenLop.unique'          => 'Tên lớp này đã tồn tại (trùng với lớp khác).',
            'NamHoc.required'        => 'Vui lòng nhập khóa học/năm học.',
            'GiangVienID.required'   => 'Vui lòng chọn cố vấn học tập.',
            'ChuyenNganhID.required' => 'Vui lòng chọn chuyên ngành.',
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