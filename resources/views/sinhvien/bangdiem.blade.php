@extends('layouts.sinhvien')

@section('noidung')
<div class="card">
    <div style="border-bottom:1px solid #eee; padding-bottom:15px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 style="margin:0; font-size:24px; color:#2c3e50;">📊 Kết Quả Học Tập Cá Nhân</h1>
            <p style="margin:5px 0 0;">Sinh viên: <b style="color:#007bff">{{ $sv->HoTen }}</b></p>
        </div>
    </div>

    @if($dsMonHoc->isEmpty())
    <div style="text-align:center; padding:50px;">
        <p style="color:#666; font-style:italic;">Lớp của bạn chưa được xếp môn học nào.</p>
    </div>
    @else
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th>Môn Học</th>
                <th width="100px" style="text-align:center;">Tín Chỉ</th>
                <th width="120px" style="text-align:center;">Điểm Số</th>
                <th width="120px" style="text-align:center;">Kết Quả</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsMonHoc as $mon)
            <tr>
                <td style="font-weight:bold;">
                    {{ $mon->TenMonHoc }}
                </td>
                <td style="text-align:center;">{{ $mon->SoTinChi }}</td>

                <td style="text-align:center; font-weight:bold; font-size:16px;">
                    @if($mon->diem_so !== null)
                    <span style="color:#d35400;">{{ $mon->diem_so }}</span>
                    @else
                    <span style="color:#bbb;">--</span>
                    @endif
                </td>

                <td style="text-align:center;">
                    @if($mon->diem_so !== null)
                    @if($mon->diem_so >= 5)
                    <span style="color:green; font-weight:bold;">Đạt</span>
                    @else
                    <span style="color:red; font-weight:bold;">Không Đạt</span>
                    @endif
                    @else
                    <span style="color:#999; font-size:13px; font-style:italic;">Chưa chấm</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection