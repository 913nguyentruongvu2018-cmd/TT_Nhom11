<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Diem;
use App\Models\NguoiDung;

class SinhVienController extends Controller
{
    public function index() {
        $dsSinhVien = SinhVien::orderBy('id', 'desc')->get();
        return view('admin.sinhvien.index', ['dsSinhVien' => $dsSinhVien]);
    }

    

    public function hienFormThem() {
        return view('admin.sinhvien.them');
    }

    public function luuSinhVien(Request $request) {
        $request->validate([
            'MaSV' => 'required|unique:sinhvien,MaSV',
            'HoTen' => 'required',
            'Lop' => 'required',
        ], [
            'MaSV.unique' => 'Mã sinh viên này đã tồn tại!',
            'MaSV.required' => 'Vui lòng nhập mã sinh viên.'
        ]);

        SinhVien::create([
            'MaSV' => $request->MaSV,
            'HoTen' => $request->HoTen,
            'Lop' => $request->Lop,
            'NgaySinh' => $request->NgaySinh,
            'NguoiDungID' => null
        ]);

        return redirect('/admin/sinh-vien')->with('success', 'Đã thêm sinh viên mới!');
    }

    public function hienFormSua($id) {
        $sinhVien = SinhVien::find($id);
        return view('admin.sinhvien.sua', ['sv' => $sinhVien]);
    }

    public function capNhat(Request $request, $id) {
        $request->validate([
            'MaSV' => 'required|unique:sinhvien,MaSV,'.$id,
            'HoTen' => 'required',
            'Lop' => 'required',
        ]);

        $sinhVien = SinhVien::find($id);
        $sinhVien->update([
            'MaSV' => $request->MaSV,
            'HoTen' => $request->HoTen,
            'Lop' => $request->Lop,
            'NgaySinh' => $request->NgaySinh
        ]);

        return redirect('/admin/sinh-vien')->with('success', 'Cập nhật thành công!');
    }

    public function xoa($id) {
        $sinhVien = SinhVien::find($id);

        if ($sinhVien) {
            Diem::where('SinhVienID', $id)->delete();

            $userId = $sinhVien->NguoiDungID;

            $sinhVien->delete();

            if ($userId) {
                NguoiDung::where('id', $userId)->delete();
            }
        }
        
        return redirect('/admin/sinh-vien')->with('success', 'Đã xóa sinh viên và toàn bộ dữ liệu liên quan.');
    }
}