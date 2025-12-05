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
    
        //Trung Phong
        $trungPhong = ThoiKhoaBieu::where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('PhongHoc', $request->PhongHoc)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();

        if ($trungPhong) {
            return back()->withErrors(['PhongHoc' => 'Phòng học này đã có lớp học vào giờ đó!'])->withInput();
        }
        //Trung GV
        $trungGV = ThoiKhoaBieu::where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('GiangVienID', $request->GiangVienID)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();
        if ($trungGV) {
            return back()->withErrors(['GiangVienID' => 'Giảng viên này đã có lịch dạy lớp khác vào giờ đó!'])->withInput();
        }
        //Trung Lop
        $trungLop = ThoiKhoaBieu::where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('LopID', $request->LopID)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();

        if ($trungLop) {
            return back()->withErrors(['LopID' => 'Lớp này đang học môn khác vào giờ đó!'])->withInput();
        }

        ThoiKhoaBieu::create($request->all());
        return redirect('/admin/tkb')->with('success', 'Đã xếp lịch học thành công!');
    }

    public function xoa($id) {
        ThoiKhoaBieu::find($id)->delete();
        return redirect('/admin/tkb')->with('success', 'Đã xóa lịch học.');
    }
}