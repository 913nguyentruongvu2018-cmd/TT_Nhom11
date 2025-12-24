<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\GiangVien;

class ThoiKhoaBieuController extends Controller
{
    // Danh sach 
    public function index(Request $request) {
        $query = ThoiKhoaBieu::with(['lopHoc', 'monHoc', 'giangVien']);
        //xu ly tim theo ten mh hoac gv
        if ($request->has('tu_khoa') && $request->tu_khoa != "") {
            $tu_khoa = $request->tu_khoa;
            $query->where(function($q) use ($tu_khoa) {
                $q->whereHas('monHoc', function($subQ) use ($tu_khoa) {
                    $subQ->where('TenMonHoc', 'like', "%{$tu_khoa}%");
                })->orWhereHas('giangVien', function($subQ) use ($tu_khoa) {
                    $subQ->where('HoTen', 'like', "%{$tu_khoa}%");
                });
            });
        }
        // loc lop
        if ($request->has('LopID') && $request->LopID != "") {
            $query->where('LopID', $request->LopID);
        }

        //loc thu
        if ($request->has('ThuTrongTuan') && $request->ThuTrongTuan != "") {
            $query->where('ThuTrongTuan', $request->ThuTrongTuan);
        }

        //sap xep
        $dsTKB = $query->orderByRaw("FIELD(ThuTrongTuan, 'Hai', 'Ba', 'Tu', 'Nam', 'Sau', 'Bay', 'CN')")
                       ->orderBy('GioBatDau', 'asc')
                       ->paginate(10); 

       
        $dslop = LopHoc::all();

        return view('admin.tkb.index', compact('dsTKB', 'dslop'));
    }

    // form them
    public function hienFormThem() {
        $lops = LopHoc::all();
        $mons = MonHoc::all();
        $gvs = GiangVien::all();
        return view('admin.tkb.them', compact('lops', 'mons', 'gvs'));
    }

    // them
    public function luuTKB(Request $request) {
        $request->validate([
            'LopID' => 'required',
            'MonHocID' => 'required',
            'GiangVienID' => 'required',
            'ThuTrongTuan' => 'required',
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required',
            'PhongHoc' => 'required',
        ]);
        

        ThoiKhoaBieu::create($request->all());
        return redirect('/admin/tkb')->with('success', 'Đã xếp lịch học thành công!');
    }

    //form sua
    public function hienFormSua($id) {
        $tkb = ThoiKhoaBieu::find($id);
        if(!$tkb) return redirect('/admin/tkb')->with('error', 'Không tìm thấy lịch học này!');

        $lops = LopHoc::all();
        $mons = MonHoc::all();
        $gvs = GiangVien::all();

        return view('admin.tkb.sua', compact('tkb', 'lops', 'mons', 'gvs'));
    }

    // sua
    public function capNhat(Request $request, $id) {
        $tkb = ThoiKhoaBieu::find($id);
        
        $tkb->update($request->all());

        return redirect('/admin/tkb')->with('success', 'Cập nhật lịch học thành công!');
    }

    // Xoa
    public function xoa($id) {
        ThoiKhoaBieu::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa lịch học!');
    }
}