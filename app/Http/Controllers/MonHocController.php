<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\ThoiKhoaBieu;
use App\Models\Diem;

class MonHocController extends Controller
{
    public function index()
    {
        $danhSachMon = MonHoc::all();
        return view('admin.monhoc.index', ['dsMon' => $danhSachMon]);
    }

    public function hienFormThem()
    {
        return view('admin.monhoc.them');
    }

    public function luuMonHoc(Request $request)
    {
        $request->validate([
            'MaMon'     => 'required|unique:monhoc,MaMon', 
            'TenMonHoc' => 'required|unique:monhoc,TenMonHoc',
            'SoTinChi'  => 'required|integer|min:1',
        ], [
            'MaMon.unique' => 'Mã môn này đã tồn tại.',
            'MaMon.required' => 'Vui lòng nhập mã môn.',
            
            'TenMonHoc.unique' => 'Tên môn học này đã tồn tại.',
            'TenMonHoc.required' => 'Vui lòng nhập tên môn học.',

            'SoTinChi.required'  => 'Vui lòng nhập số tín chỉ.',
            'SoTinChi.integer'   => 'Số tín chỉ phải là số nguyên (không nhập số lẻ).',
            'SoTinChi.min'       => 'Số tín chỉ phải lớn hơn hoặc bằng 1.',
        ]);

        MonHoc::create([
            'MaMon'     => $request->MaMon, 
            'TenMonHoc' => $request->TenMonHoc,
            'SoTinChi'  => $request->SoTinChi
        ]);

        return redirect('/admin/mon-hoc')->with('success', 'Thêm môn học thành công!');
    }

    public function hienFormSua($id)
    {
        $monHoc = MonHoc::find($id); 
        return view('admin.monhoc.sua', ['mon' => $monHoc]);
    }

    public function capNhat(Request $request, $id)
    {
       $request->validate([
            'MaMon'     => 'required|unique:monhoc,MaMon,'.$id.',MonHocID', 
            'TenMonHoc' => 'required|unique:monhoc,TenMonHoc,'.$id.',MonHocID',
            'SoTinChi'  => 'required|integer|min:1',
        ],[
            'MaMon.required'     => 'Vui lòng nhập mã môn học.',
            'MaMon.unique'       => 'Mã môn học này đã tồn tại (trùng với môn khác).',
            
            'TenMonHoc.required' => 'Vui lòng nhập tên môn học.',
            'TenMonHoc.unique'   => 'Tên môn học này đã tồn tại.',
            
            'SoTinChi.required'  => 'Vui lòng nhập số tín chỉ.',
            'SoTinChi.integer'   => 'Số tín chỉ phải là số nguyên.',
            'SoTinChi.min'       => 'Số tín chỉ phải lớn hơn hoặc bằng 1.',

        ]);

        $monHoc = MonHoc::find($id);
        $monHoc->update([
            'MaMon'     => $request->MaMon, 
            'TenMonHoc' => $request->TenMonHoc,
            'SoTinChi'  => $request->SoTinChi
        ]);

        return redirect('/admin/mon-hoc')->with('success', 'Cập nhật thành công!');
    }

    public function xoa($id)
    {
        $monHoc = MonHoc::find($id);
       $countTKB = ThoiKhoaBieu::where('MonHocID', $id)->count();

        if ($countTKB > 0) {
            return redirect('/admin/mon-hoc')->with('error', 
                "Không thể xóa! Môn này đang có $countTKB lịch dạy trong Thời Khóa Biểu.");
        }

        $countDiem = Diem::where('MonHocID', $id)->count();

        if ($countDiem > 0) {
            return redirect('/admin/mon-hoc')->with('error', 
                "Không thể xóa! Môn này đã nhập điểm cho $countDiem sinh viên.");
        }
        try {
            $monHoc->delete();
            return redirect('/admin/mon-hoc')->with('success', 'Đã xóa môn học thành công.');
        } catch (\Exception $e) {
            return redirect('/admin/mon-hoc')->with('error', 'Lỗi hệ thống: Không thể xóa môn học này.');
        }
    }
}