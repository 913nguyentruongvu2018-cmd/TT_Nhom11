@extends('layouts.admin')

@section('noidung')
<div class="card">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom:1px solid #eee; padding-bottom:15px;">
        <div>
            <h1 style="margin:0; color:#2c3e50;">🎓 Bảng Điểm Chi Tiết</h1>
            <p style="margin:5px 0 0 0; color:#7f8c8d; font-size:16px;">
                Sinh viên: <strong style="color:#000;">{{ $sinhVien->HoTen }}</strong> - MSSV: <strong style="color:blue;">{{ $sinhVien->MaSV }}</strong>
            </p>
            <p style="margin:0; color:#7f8c8d;">Lớp: {{ $sinhVien->lopHoc->TenLop ?? '...' }}</p>
        </div>

        <a href="{{ route('admin.diem.index', request()->query()) }}"
            style="background:#6c757d; color:white; padding:10px 20px; text-decoration:none; border-radius:4px; font-weight:bold;">
            ← Quay lại Danh sách
        </a>
    </div>

    @if (session('success'))
    <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px;">
        ✅ {{ session('success') }}
    </div>
    @endif


    <table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#34495e; color:white;">
                <th style="width:50px; text-align:center;">STT</th>
                <th>Tên Môn Học</th>
                <th style="text-align:center;">Số Tín Chỉ</th>
                <th style="text-align:center; width:150px;">Điểm Số</th>
                <th style="text-align:center; width:200px;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsMonHoc as $key => $mh)
            <tr style="background: {{ $mh->diem_hien_tai ? '#ffffff' : '#f9f9f9' }};">
                <td style="text-align:center;">{{ $key + 1 }}</td>
                <td style="font-weight:bold; color:#2c3e50;">
                    {{ $mh->TenMonHoc }}
                </td>
                <td style="text-align:center;">{{ $mh->SoTinChi }}</td>


                <td style="text-align:center;">
                    @if($mh->diem_hien_tai)

                    <span style="font-size:18px; font-weight:bold; color: {{ $mh->diem_hien_tai->DiemSo < 5 ? 'red' : 'blue' }}">
                        {{ $mh->diem_hien_tai->DiemSo }}
                    </span>
                    @else

                    <span style="color:#ccc;">--</span>
                    @endif
                </td>


                <td style="text-align:center;">
                    @if($mh->diem_hien_tai)

                    <a href="/admin/diem/sua/{{ $mh->diem_hien_tai->DiemID }}?from_source=chitiet"
                        style="color:#007bff; font-weight:bold; text-decoration:none; border:1px solid #007bff; padding:4px 10px; border-radius:4px; display:inline-block; background:white; margin-right:5px;">
                        - Sửa
                    </a>
                    <span style="color:#ccc;">|</span>
                    <a href="/admin/diem/xoa/{{ $mh->diem_hien_tai->DiemID }}"
                        style="color:#dc3545; font-weight:bold; text-decoration:none; border:1px solid #dc3545; padding:4px 10px; border-radius:4px; display:inline-block; background:white;"
                        onclick="return confirm('Xóa điểm này?')">
                        x Xóa
                    </a>
                    @else


                    <a href="{{ route('admin.diem.nhap', ['sv_id' => $sinhVien->id, 'mh_id' => $mh->MonHocID, 'lop_id' => $sinhVien->Lop, 'from_source' => 'chitiet']) }}"
                        style="color:green; font-weight:bold; text-decoration:none; border:1px solid green; padding:5px 15px; border-radius:4px; display:inline-block;">
                        + Nhập
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:20px; text-align:right;">
        <p style="font-size:18px;">
            Tổng số môn: <strong>{{ $dsMonHoc->count() }}</strong> |
            Đã có điểm: <strong style="color:blue;">{{ $dsMonHoc->whereNotNull('diem_hien_tai')->count() }}</strong>
        </p>
    </div>
</div>
@endsection