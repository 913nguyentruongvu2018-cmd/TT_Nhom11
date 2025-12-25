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
    public function index(Request $request)
    {
        $query = ThoiKhoaBieu::with(['lopHoc', 'monHoc', 'giangVien']);
        //xu ly tim theo ten mh hoac gv
        if ($request->has('tu_khoa') && $request->tu_khoa != "") {
            $tu_khoa = $request->tu_khoa;
            $query->where(function ($q) use ($tu_khoa) {
                $q->whereHas('monHoc', function ($subQ) use ($tu_khoa) {
                    $subQ->where('TenMonHoc', 'like', "%{$tu_khoa}%");
                })->orWhereHas('giangVien', function ($subQ) use ($tu_khoa) {
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
    public function hienFormThem()
    {
        $lops = LopHoc::all();
        $mons = MonHoc::all();
        $gvs = GiangVien::all();
        return view('admin.tkb.them', compact('lops', 'mons', 'gvs'));
    }

    // them
    public function luuTKB(Request $request)
    {
        $request->validate([
            'LopID' => 'required',
            'MonHocID' => 'required',
            'GiangVienID' => 'required',
            'ThuTrongTuan' => 'required',
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required|after:GioBatDau',
            'PhongHoc' => 'required',
        ], [
            'LopID.required' => 'Vui lòng chọn lớp học.',
            'MonHocID.required' => 'Vui lòng chọn môn học.',
            'GiangVienID.required' => 'Vui lòng chọn giảng viên.',
            'ThuTrongTuan.required' => 'Vui lòng chọn thứ trong tuần.',
            'GioBatDau.required' => 'Vui lòng nhập giờ bắt đầu.',
            'GioKetThuc.required' => 'Vui lòng nhập giờ kết thúc.',
            'PhongHoc.required' => 'Vui lòng nhập tên phòng học.',
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

    //form sua
    public function hienFormSua($id)
    {
        $tkb = ThoiKhoaBieu::find($id);
        if (!$tkb) return redirect('/admin/tkb')->with('error', 'Không tìm thấy lịch học này!');

        $lops = LopHoc::all();
        $mons = MonHoc::all();
        $gvs = GiangVien::all();

        return view('admin.tkb.sua', compact('tkb', 'lops', 'mons', 'gvs'));
    }

    // sua
    public function capNhat(Request $request, $id)
    {
        $tkb = ThoiKhoaBieu::findOrFail($id);
        $request->validate([
            'LopID' => 'required',
            'MonHocID' => 'required',
            'GiangVienID' => 'required',
            'ThuTrongTuan' => 'required',
            'GioBatDau' => 'required',
            'GioKetThuc' => 'required|after:GioBatDau',
            'PhongHoc' => 'required',
        ], [
            'LopID.required' => 'Vui lòng chọn lớp học.',
            'MonHocID.required' => 'Vui lòng chọn môn học.',
            'GiangVienID.required' => 'Vui lòng chọn giảng viên.',
            'ThuTrongTuan.required' => 'Vui lòng chọn thứ trong tuần.',
            'GioBatDau.required' => 'Vui lòng nhập giờ bắt đầu.',
            'GioKetThuc.required' => 'Vui lòng nhập giờ kết thúc.',
            'PhongHoc.required' => 'Vui lòng nhập tên phòng học.',
            'GioKetThuc.after' => 'Giờ kết thúc phải sau giờ bắt đầu.'
        ]);

        $trungPhong = ThoiKhoaBieu::where('TKBid', '!=', $id) 
            ->where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('PhongHoc', $request->PhongHoc)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();

        if ($trungPhong) {
            return back()->withErrors(['PhongHoc' => 'Phòng học này đang có lớp khác học vào giờ đó!'])->withInput();
        }
        $trungGV = ThoiKhoaBieu::where('TKBid', '!=', $id)
            ->where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('GiangVienID', $request->GiangVienID)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();

        if ($trungGV) {
            return back()->withErrors(['GiangVienID' => 'Giảng viên này bị trùng lịch dạy lớp khác!'])->withInput();
        }

        $trungLop = ThoiKhoaBieu::where('TKBid', '!=', $id) 
            ->where('ThuTrongTuan', $request->ThuTrongTuan)
            ->where('LopID', $request->LopID)
            ->whereTime('GioBatDau', '<', $request->GioKetThuc)
            ->whereTime('GioKetThuc', '>', $request->GioBatDau)
            ->exists();

        if ($trungLop) {
            return back()->withErrors(['LopID' => 'Lớp này đang học môn khác vào giờ đó!'])->withInput();
        }

        $tkb->update($request->all());

        return redirect('/admin/tkb')->with('success', 'Cập nhật lịch học thành công!');
    }

    // Xoa
    public function xoa($id)
    {
        ThoiKhoaBieu::destroy($id);
        return redirect()->back()->with('success', 'Đã xóa lịch học!');
    }
}