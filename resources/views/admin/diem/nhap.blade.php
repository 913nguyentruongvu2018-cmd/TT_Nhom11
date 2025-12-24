@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>📝 Nhập Điểm Mới</h1>
            
            <a href="{{ isset($svSelected) ? route('admin.diem.chitiet', ['sv_id' => $svSelected->id]) : route('admin.diem.index') }}" 
               style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:10px; border-radius:4px;">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.diem.nhap') }}" method="POST">
            @csrf
           
<input type="hidden" name="url_params" value="{{ http_build_query(request()->except(['_token', 'from_source'])) }}">
<input type="hidden" name="from_source" value="{{ request('from_source') }}">
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Chi Tiết Lựa Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Sinh Viên</td>
                        <td>
                            @if(isset($svSelected) && $svSelected)
                                
                                <span style="font-size:16px; color:#2c3e50; font-weight:bold;">
                                    👤 {{ $svSelected->HoTen }} ({{ $svSelected->MaSV }})
                                </span>
                                
                                <input type="hidden" name="SinhVienID" value="{{ $svSelected->id }}">
                            @else
                                
                                <div style="display:flex; gap:10px;">
                                    
                                    <select onchange="window.location.href='?lop_id='+this.value" style="padding:8px; border:1px solid #ccc; width:150px;">
                                        <option value="">-- Lọc Lớp --</option>
                                        @foreach ($dsLop as $lop)
                                            <option value="{{ $lop->LopID }}" {{ request('lop_id') == $lop->LopID ? 'selected' : '' }}>
                                                {{ $lop->TenLop }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select name="SinhVienID" required style="flex:1; padding:8px; border:1px solid #ccc;">
                                        <option value="">-- Chọn Sinh Viên --</option>
                                        @foreach ($dsSinhVien as $sv)
                                            <option value="{{ $sv->id }}" {{ request('sv_id') == $sv->id ? 'selected' : '' }}>
                                                {{ $sv->MaSV }} - {{ $sv->HoTen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Môn Học</td>
                        <td>
                            @if(isset($mhSelected) && $mhSelected)
                                
                                <span style="font-size:16px; color:#2c3e50; font-weight:bold;">
                                    📚 {{ $mhSelected->TenMonHoc }} ({{ $mhSelected->SoTinChi }} tín chỉ)
                                </span>
                                <input type="hidden" name="MonHocID" value="{{ $mhSelected->MonHocID }}">
                            @else
                                
                                <select name="MonHocID" required style="width:100%; padding:8px; border:1px solid #ccc;">
                                    <option value="">-- Chọn Môn --</option>
                                    @foreach ($dsMonHoc as $mh)
                                        <option value="{{ $mh->MonHocID }}" {{ request('mh_id') == $mh->MonHocID ? 'selected' : '' }}>
                                            {{ $mh->TenMonHoc }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="font-weight:bold; background:#fff3cd; color:#856404;">Nhập Điểm Số Mới</td>
                        <td style="background:#fff3cd;">
                            <input type="number" name="DiemSo" step="0.1" min="0" max="10" required placeholder="0.0" autofocus
                                style="width:150px; padding:10px; border:2px solid #e67e22; border-radius:4px; font-weight:bold; font-size:18px; color:#e67e22;">
                            <span style="color:#856404; margin-left:10px; font-style:italic;">(Thang điểm 10)</span>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU ĐIỂM
                </button>
            </div>
        </form>
    </div>
@endsection