<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\ThoiKhoaBieu;

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
       ThoiKhoaBieu::where('MonHocId',$id)->delete();
       $monHoc = MonHoc::find($id);
       if($monHoc) {
           $monHoc->delete();
       }
       return redirect('/admin/mon-hoc')->with('success', 'Đã xóa môn học và lịch học liên quan.');
    }
}