@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Điểm Số</h1>
    
        
        <div style="background:#f1f1f1; padding:15px; margin-bottom:20px; border-radius:5px;">
            <form action="/admin/diem" method="GET" style="display:flex; gap:10px; align-items:center;">
                
                
                <select name="sv_id" style="padding:8px; border:1px solid #ccc; min-width: 200px;">
                    <option value="">-- Tất cả Sinh Viên --</option>
                    @foreach($dsSinhVien as $sv)
                        <option value="{{ $sv->id }}" {{ request('sv_id') == $sv->id ? 'selected' : '' }}>
                            {{ $sv->MaSV }} - {{ $sv->HoTen }}
                        </option>
                    @endforeach
                </select>

                
                <select name="mh_id" style="padding:8px; border:1px solid #ccc; min-width: 200px;">
                    <option value="">-- Tất cả Môn Học --</option>
                    @foreach($dsMonHoc as $mh)
                        <option value="{{ $mh->MonHocID }}" {{ request('mh_id') == $mh->MonHocID ? 'selected' : '' }}>
                            {{ $mh->TenMonHoc }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" style="background:#007bff; color:white; border:none; padding:8px 15px; cursor:pointer;">
                    🔍 Lọc
                </button>
                <a href="/admin/diem" style="color:#666; margin-left:5px; text-decoration:none;">❌ Xóa lọc</a>
            </form>
        </div>

        <a href="/admin/diem/nhap"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">
            + Nhập Điểm Mới
        </a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}</div>
        @endif

        <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#2980b9; color:white;">
                    <th>Mã SV</th>
                    <th>Sinh Viên</th>
                    <th>Môn Học</th>
                    <th>Số Tín Chỉ</th>
                    <th>Học Kỳ</th>
                    <th>Điểm Số</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsDiem as $diem)
                    <tr>
                        <td>{{ $diem->sinhVien->MaSV ?? 'N/A' }}</td>
                        <td>{{ $diem->sinhVien->HoTen ?? 'Không xác định' }}</td>
                        <td>{{ $diem->monHoc->TenMonHoc ?? 'Không xác định' }}</td>
                        <td style="text-align:center;">{{ $diem->monHoc->SoTinChi ?? 0 }}</td>
                        <td style="text-align:center; font-weight:bold;">{{ $diem->HocKy }}</td>
                        <td style="text-align:center; font-weight:bold; color: {{ $diem->DiemSo < 5 ? 'red' : 'black' }}">
                            {{ $diem->DiemSo }}
                        </td>
                        <td style="text-align:center;">
                            <a href="/admin/diem/sua/{{ $diem->DiemID }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/diem/xoa/{{ $diem->DiemID }}" style="color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa điểm này?')">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top:15px;">
            {{ $dsDiem->appends(request()->all())->links('phantrang') }}
        </div>
    </div>
@endsection