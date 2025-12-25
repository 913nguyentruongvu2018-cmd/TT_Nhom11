@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Điểm Số</h1>
            
            <a href="{{ route('admin.diem.chitiet', ['sv_id' => $diem->SinhVienID]) }}" 
               style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại bảng điểm
            </a>
        </div>
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:10px; border-radius:4px;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập.
            </div>
        @endif
        <form action="/admin/diem/sua/{{ $diem->DiemID }}" method="POST" novalidate>
            @csrf
            
            <input type="hidden" name="url_params" value="{{ http_build_query(request()->except(['_token', 'from_source'])) }}">
            <input type="hidden" name="from_source" value="{{ request('from_source') }}">
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width:250px;">Thông Tin</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Sinh Viên</td>
                        <td>
                            <span style="font-size:16px; font-weight:bold;">
                                {{ $diem->sinhVien->HoTen }} ({{ $diem->sinhVien->MaSV }})
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Môn Học</td>
                        <td>
                            <span style="font-size:16px; font-weight:bold;">
                                {{ $diem->monHoc->TenMonHoc }} ({{ $diem->monHoc->SoTinChi }} tín chỉ)
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="font-weight:bold; background:#fff3cd; color:#856404;">Điểm Số Mới</td>
                        <td style="background:#fff3cd;">
                            <input type="number" name="DiemSo" step="0.1" min="0" max="10" required
                                value="{{ $diem->DiemSo }}"
                                style="width:150px; padding:10px; border:2px solid #e67e22; border-radius:4px; font-weight:bold; font-size:18px; color:#e67e22;">
                            
                            @error('DiemSo') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit"
                    style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU CẬP NHẬT
                </button>
            </div>
        </form>
    </div>
@endsection