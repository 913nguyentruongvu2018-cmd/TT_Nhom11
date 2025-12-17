<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiangVien;
use App\Models\NguoiDung;
use App\Models\ChuyenNganh;

class GiangVienController extends Controller
{
    
    public function index(Request $request) {
        $query = GiangVien::with('chuyenNganh');

        
        if ($request->has('chua_co_tk')) {
            $query->whereNull('NguoiDungID');
        }
        

        
        if ($request->filled('tu_khoa')) {
            $query->where(function($q) use ($request) {
                $q->where('HoTen', 'LIKE', '%' . $request->tu_khoa . '%')
                  ->orWhere('MaGV', 'LIKE', '%' . $request->tu_khoa . '%');
            });
        }

        
        if ($request->filled('cn_id')) {
            $query->where('ChuyenNganhID', $request->cn_id);
        }

        $dsGiangVien = $query->paginate(10);
        $dsChuyenNganh = ChuyenNganh::all();

        return view('admin.giangvien.index', [
            'dsGiangVien' => $dsGiangVien, 
            'dsChuyenNganh' => $dsChuyenNganh
        ]);
    }

    
    
    
    
    
    public function hienFormThem() {
        $dsChuyenNganh = ChuyenNganh::all();
        return view('admin.giangvien.them', ['dsChuyenNganh' => $dsChuyenNganh]);
    }

    public function luuGiangVien(Request $request) {
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV',
            'HoTen' => 'required',
            'ChuyenNganhID' => 'required',
        ]);
        GiangVien::create([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganhID' => $request->ChuyenNganhID,
            'NguoiDungID' => null
        ]);
        return redirect('/admin/giang-vien')->with('success', 'Đã thêm hồ sơ giảng viên!');
    }

    public function hienFormSua($id) {
        $gv = GiangVien::where('GiangVienID', $id)->first();
        if(!$gv) $gv = GiangVien::where('MaGV', $id)->first();
        $dsChuyenNganh = ChuyenNganh::all();
        return view('admin.giangvien.sua', ['gv' => $gv, 'dsChuyenNganh' => $dsChuyenNganh]);
    }

    public function capNhat(Request $request, $id) {
        $gv = GiangVien::where('GiangVienID', $id)->orWhere('MaGV', $id)->first();
        if(!$gv) return back()->with('error', 'Không tìm thấy giảng viên.');
        $request->validate([
            'MaGV' => 'required|unique:giangvien,MaGV,'.$gv->GiangVienID.',GiangVienID',
            'HoTen' => 'required',
            'ChuyenNganhID' => 'required',
        ]);
        $gv->update([
            'MaGV' => $request->MaGV,
            'HoTen' => $request->HoTen,
            'HocVi' => $request->HocVi,
            'ChuyenNganhID' => $request->ChuyenNganhID
        ]);
        if ($gv->NguoiDungID) {
            $user = NguoiDung::find($gv->NguoiDungID);
            if ($user) $user->update(['HoTen' => $request->HoTen]);
        }
        return redirect('/admin/giang-vien')->with('success', 'Cập nhật thành công!');
    }

    public function xoa($id) {
        $gv = GiangVien::where('GiangVienID', $id)->orWhere('MaGV', $id)->first();
        if($gv) $gv->delete();
        return redirect('/admin/giang-vien')->with('success', 'Đã xóa giảng viên.');
    }
}