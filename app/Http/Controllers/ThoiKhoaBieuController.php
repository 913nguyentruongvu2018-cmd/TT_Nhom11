<?php
//update
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\GiangVien;

class ThoiKhoaBieuController extends Controller
{
    public function index() {
        $dsTKB = ThoiKhoaBieu::with(['lopHoc', 'monHoc', 'giangVien'])
                             ->orderBy('ThuTrongTuan', 'asc')
                             ->get();
        return view('admin.tkb.index', ['dsTKB' => $dsTKB]);
    }

    public function hienFormThem() {
        $lops = LopHoc::all();
        $mons = MonHoc::all();
        $gvs = GiangVien::all();

        return view('admin.tkb.them', [
            'lops' => $lops,
            'mons' => $mons,
            'gvs' => $gvs
        ]);
    }

    public function luuTKB(Request $request) {
        $request->validate([
            'LopID' => 'required',
            'MonHocID' => 'required',
            'GiangVienID' => 'required',
            'ThuTrongTuan' => 'required',
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required|after:GioBatDau',
            'PhongHoc' => 'required',
        ], [
            'GioKetThuc.after' => 'Giờ kết thúc phải sau giờ bắt đầu.'
        ]);


        ThoiKhoaBieu::create($request->all());
        return redirect('/admin/tkb')->with('success', 'Đã xếp lịch học thành công!');
    }

    public function xoa($id) {
        ThoiKhoaBieu::find($id)->delete();
        return redirect('/admin/tkb')->with('success', 'Đã xóa lịch học.');
    }
}