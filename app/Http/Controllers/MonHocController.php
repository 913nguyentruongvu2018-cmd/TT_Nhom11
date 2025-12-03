<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;

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
        $request->validate(
            [
                'TenMonHoc' => 'required|unique:monhoc,TenMonHoc',
                'SoTinChi' => 'required|integer|min:1',
            ],
            [
                'TenMonHoc.unique' => 'Tên môn học này đã tồn tại rồi',
                'TenMonHoc.required' => 'Vui lòng nhập tên môn học.',
                
                'SoTinChi.required' => 'Vui lòng nhập số tín chỉ.',
            ]
        );

        MonHoc::create([
            'TenMonHoc' => $request->TenMonHoc,
            'SoTinChi' => $request->SoTinChi
        ]);

        return redirect('/admin/mon-hoc');
    }
    public function hienFormSua($id)
    {
        $monHoc = MonHoc::find($id); 
        return view('admin.monhoc.sua', ['mon' => $monHoc]);
    }

    public function capNhat(Request $request, $id)
    {
        $request->validate([
            'TenMonHoc' => 'required|unique:monhoc,TenMonHoc,' . $id . ',MonHocID',
            'SoTinChi' => 'required|integer|min:1',
        ], [
            'TenMonHoc.unique' => 'Tên môn học này đã bị trùng với môn khác!',
        ]);
        $monHoc = MonHoc::find($id);

        $monHoc->update([
            'TenMonHoc' => $request->TenMonHoc,
            'SoTinChi' => $request->SoTinChi
        ]);

        return redirect('/admin/mon-hoc');
    }

    public function xoa($id)
    {
        $monHoc = MonHoc::find($id);
        $monHoc->delete();

        return redirect('/admin/mon-hoc');
    }

    //test github
}
