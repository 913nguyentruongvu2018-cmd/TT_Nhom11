@extends('layouts.giangvien')

@section('noidung')

<div class="card">
    <h1>🏫 Lớp chủ nhiệm của giảng viên {{ $gv->HoTen }}</h1>
    @if(!$lop)
    <div class="card" style="text-align:center; padding:80px 20px;">
        <h1 style="font-size:60px; margin:0;">😉</h1>
        <h2 style="color:#555; margin-top:20px;">Chưa được phân công chủ nhiệm</h2>
        <p style="color:#777; font-size:16px;">
            Hiện tại thầy/cô chưa có thông tin lớp chủ nhiệm trong học kỳ này.
        </p>
        <a href="/giang-vien/dashboard" style="display:inline-block; margin-top:30px; text-decoration:none; background:#007bff; color:white; padding:12px 25px; border-radius:50px; font-weight:bold;">
            ← Quay về Trang chủ
        </a>
    </div>

    @else
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:15px;">
            <div>
                <h1 style="margin:0; color:#2c3e50;">📋 Danh Sách Sinh Viên</h1>
                <p style="color:#666; margin:5px 0 0;">
                    Lớp chủ nhiệm: <b style="color:#007bff; font-size:18px;">{{ $lop->TenLop }}</b>
                    - Sĩ số: <b>{{ $dsSV->count() }}</b>
                </p>
            </div>
        </div>

        @if($dsSV->isEmpty())
        <div style="text-align:center; padding:30px; color:#999; font-style:italic;">
            <p>Lớp này hiện chưa có sinh viên nào.</p>
        </div>
        @else
        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
            <thead style="background:#007bff; color:white;">
                <tr>
                    <th width="50px" style="text-align:center;">STT</th>
                    <th width="150px">Mã SV</th>
                    <th>Họ và Tên</th>
                    <th width="120px" style="text-align:center;">Ngày Sinh</th>
                    <th width="150px" style="text-align:center;">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsSV as $index => $sv)
                <tr>
                    <td style="text-align:center;">{{ $index + 1 }}</td>
                    <td style="font-weight:bold; color:#555;">{{ $sv->MaSV }}</td>
                    <td style="font-weight:bold;">{{ $sv->HoTen }}</td>
                    <td style="text-align:center;">{{ $sv->NgaySinh ? date('d/m/Y', strtotime($sv->NgaySinh)) : '-' }}</td>
                    <td style="text-align:center;">
                        <a href="/giang-vien/xem-diem-sinh-vien/{{ $sv->id }}"
                            style="background:#17a2b8; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; font-size:13px; font-weight:bold;">
                            👁️ Xem Điểm
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif
</div>

@endsection