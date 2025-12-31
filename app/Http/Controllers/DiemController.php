<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diem;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\LopHoc;

class DiemController extends Controller
{
    
    public function index(Request $request)
    {
        $dsLop = LopHoc::all();
        $dsMonHoc = MonHoc::all();
        $query = SinhVien::query();

        if ($request->filled('lop_id')) {
            $query->where('LopID', $request->lop_id);
        }
        if ($request->filled('tu_khoa')) {
            $tuKhoa = $request->tu_khoa;
            $query->where(function($q) use ($tuKhoa) {
                $q->where('HoTen', 'LIKE', "%{$tuKhoa}%")
                  ->orWhere('MaSV', 'LIKE', "%{$tuKhoa}%");
            });
        }
        $dsSinhVien = $query->orderBy('MaSV', 'asc')->paginate(20);

        $monHocDuocChon = null;
        if ($request->filled('mh_id')) {
            $monHocDuocChon = MonHoc::find($request->mh_id);
            $svIDs = $dsSinhVien->pluck('id');
            $bangDiem = Diem::where('MonHocID', $request->mh_id)
                            ->whereIn('SinhVienID', $svIDs)->get()->keyBy('SinhVienID');
            foreach ($dsSinhVien as $sv) {
                $sv->diem_hien_tai = $bangDiem->get($sv->id);
            }
        }

        return view('admin.diem.index', [
            'dsSinhVien' => $dsSinhVien,
            'dsLop' => $dsLop,
            'dsMonHoc' => $dsMonHoc,
            'monHocDuocChon' => $monHocDuocChon
        ]);
    }

    
    public function xemChiTiet($sv_id)
    {
        
        $sinhVien = SinhVien::find($sv_id);
        if (!$sinhVien) $sinhVien = SinhVien::where('id', $sv_id)->first();
        if (!$sinhVien) $sinhVien = SinhVien::where('SinhVienID', $sv_id)->first();

        if (!$sinhVien) {
            return "<h1>⚠️ LỖI: Không tìm thấy sinh viên ID $sv_id</h1>";
        }
        
        $dsMonHoc = MonHoc::all();
        $diemDaCo = Diem::where('SinhVienID', $sinhVien->id)->get()->keyBy('MonHocID');

        foreach ($dsMonHoc as $mh) {
            $mh->diem_hien_tai = $diemDaCo->get($mh->MonHocID);
        }

        return view('admin.diem.chitiet', [
            'sinhVien' => $sinhVien,
            'dsMonHoc' => $dsMonHoc
        ]);
    }

    
    public function hienFormNhap(Request $request) {
        $dsLop = LopHoc::all();
        $dsMonHoc = MonHoc::all();
        
        $svList = $request->filled('lop_id') ? SinhVien::where('LopID', $request->lop_id)->get() : SinhVien::all();
        
        $svSelected = null;
        if ($request->filled('sv_id')) {
             $svSelected = SinhVien::find($request->sv_id);
             if(!$svSelected) $svSelected = SinhVien::where('id', $request->sv_id)->first();
        }

        $mhSelected = null;
        if ($request->filled('mh_id')) {
            $mhSelected = MonHoc::where('MonHocID', $request->mh_id)->first();
        }

        return view('admin.diem.nhap', [
            'dsLop' => $dsLop, 
            'dsMonHoc' => $dsMonHoc, 
            'dsSinhVien' => $svList, 
            'svSelected' => $svSelected,
            'mhSelected' => $mhSelected
        ]);
    }

    
    public function luuDiem(Request $request) {
        $request->validate([
            'SinhVienID'=>'required', 
            'MonHocID'=>'required', 
            'DiemSo'=>'required|numeric|min:0|max:10'
        ], [
            'SinhVienID.required' => 'Vui lòng chọn sinh viên.',
            'MonHocID.required' => 'Vui lòng chọn môn học.',
            'DiemSo.required' => 'Vui lòng nhập điểm số.',
            'DiemSo.numeric' => 'Điểm số phải là số.',
            'DiemSo.min' => 'Điểm số không được thấp hơn 0.',
            'DiemSo.max' => 'Điểm số không được cao hơn 10.',
        ]);
        
        $exists = Diem::where('SinhVienID', $request->SinhVienID)->where('MonHocID', $request->MonHocID)->exists();
        if($exists) return back()->withErrors(['msg'=>'Đã có điểm môn này!']);
        
        Diem::create([
            'SinhVienID' => $request->SinhVienID,
            'MonHocID' => $request->MonHocID,
            'DiemSo' => $request->DiemSo
        ]);
        
        
        if ($request->from_source == 'chitiet') {
            
            return redirect()->route('admin.diem.chitiet', ['sv_id' => $request->SinhVienID])
                             ->with('success', 'Đã nhập điểm!');
        } else {
            
            return redirect('/admin/diem?' . $request->url_params)
                             ->with('success', 'Đã nhập điểm!');
        }
    }

    
    public function hienFormSua($id) {
        return view('admin.diem.sua', ['diem' => Diem::findOrFail($id)]);
    }

    
    public function capNhat(Request $request, $id) {
        $request->validate([
            'DiemSo' => 'required|numeric|min:0|max:10'
        ], [
            'DiemSo.required' => 'Vui lòng nhập điểm số.',
            'DiemSo.numeric' => 'Điểm số phải là số.',
            'DiemSo.min' => 'Điểm số không được thấp hơn 0.',
            'DiemSo.max' => 'Điểm số không được cao hơn 10.',
        ]);
        
        $diem = Diem::findOrFail($id);
        $diem->update(['DiemSo' => $request->DiemSo]);
        
        
        if ($request->from_source == 'chitiet') {
            
            return redirect()->route('admin.diem.chitiet', ['sv_id' => $diem->SinhVienID])
                             ->with('success', 'Cập nhật thành công!');
        } else {
            
            return redirect('/admin/diem?' . $request->url_params)
                             ->with('success', 'Cập nhật thành công!');
        }
    }

    
    public function xoa($id) {
        Diem::destroy($id);
        return back()->with('success', 'Đã xóa điểm.');
    }
}