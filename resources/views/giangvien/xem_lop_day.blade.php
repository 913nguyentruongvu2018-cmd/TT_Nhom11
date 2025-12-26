@extends('layouts.giangvien')

@section('noidung')
    <div class="card">
        <div style="border-bottom:1px solid #eee; margin-bottom:20px; padding-bottom:10px; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h1 style="margin:0; font-size:24px;">📋 Danh Sách Lớp Giảng Dạy</h1>
                <p style="color:#666; margin:5px 0 0;">
                    Lớp: <b style="color:#007bff">{{ $lop->TenLop }}</b> - Môn: <b style="color:#e67e22">{{ $mon->TenMonHoc }}</b>
                </p>
            </div>
            <a href="/giang-vien/lop-giang-day" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        <p>Tổng số sinh viên: <b>{{ $dsSV->count() }}</b></p>

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
            <thead style="background:#007bff; color:white;">
                <tr>
                    <th width="50px">STT</th>
                    <th width="120px">Mã SV</th>
                    <th>Họ và Tên</th>
                    <th width="100px" style="text-align:center;">Điểm</th>
                    <th width="100px" style="text-align:center;">Kết Quả</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsSV as $index => $sv)
                @php 
                    $d = $sv->diem_chi_tiet; 
                @endphp
                <tr>
                    <td style="text-align:center;">{{ $index + 1 }}</td>
                    <td style="font-weight:bold; color:#555;">{{ $sv->MaSV }}</td>
                    <td style="font-weight:bold;">{{ $sv->HoTen }}</td>
                    
                    <td style="text-align:center; font-weight:bold; color:#d35400;">
                        {{ $d ? $d->DiemSo : '-' }}
                    </td>

                    <td style="text-align:center;">
                        @if($d)
                            @if($d->DiemSo >= 4) <span style="color:green; font-weight:bold;">Đạt</span>
                            @else <span style="color:red; font-weight:bold;">Học lại</span>
                            @endif
                        @else
                            <span style="color:#999;">--</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection