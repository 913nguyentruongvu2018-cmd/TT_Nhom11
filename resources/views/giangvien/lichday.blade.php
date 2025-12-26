@extends('layouts.giangvien')

@section('noidung')
<div class="card">
    <h1>📅 Lich giảng dạy của giảng viên {{ $gv->HoTen }}</h1>

    @if($dsTKB->isEmpty())
    <div class="card" style="text-align:center; padding:80px 20px;">
        <h1 style="font-size:60px; margin:0;">😉</h1>
        <h2 style="color:#555; margin-top:20px;">Chưa được phân công lịch dạy</h2>
        <p style="color:#777; font-size:16px;">
            Hiện tại thầy/cô chưa có lịch dạy nào.
        </p>
        <a href="/giang-vien/dashboard" style="display:inline-block; margin-top:30px; text-decoration:none; background:#007bff; color:white; padding:12px 25px; border-radius:50px; font-weight:bold;">
            ← Quay về Trang chủ
        </a>
    </div>
    @else
    @php
    $thuMap = [
    'Hai' => 'Thứ Hai',
    'Ba' => 'Thứ Ba',
    'Tu' => 'Thứ Tư',
    'Nam' => 'Thứ Năm',
    'Sau' => 'Thứ Sáu',
    'Bay' => 'Thứ Bảy',
    'CN' => 'Chủ Nhật'
    ];
    @endphp

    <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th width="12%">Thứ</th>
                <th width="15%">Lớp</th>
                <th>Môn Học</th>
                <th width="20%">Thời Gian</th>
                <th width="10%">Phòng</th>
                <th width="15%" style="text-align:center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsTKB as $tkb)
            <tr>
                <td style="font-weight:bold; color:#e67e22;">
                    {{ $thuMap[$tkb->ThuTrongTuan] ?? $tkb->ThuTrongTuan }}
                </td>

                <td style="font-weight:bold; color:#007bff;">
                    {{ $tkb->lopHoc->TenLop ?? 'Lớp đã xóa' }}
                </td>

                <td>
                    {{ $tkb->monHoc->TenMonHoc ?? 'Môn đã xóa' }}
                </td>

                <td>
                    {{ date('H:i', strtotime($tkb->GioBatDau)) }} - {{ date('H:i', strtotime($tkb->GioKetThuc)) }}
                </td>

                <td style="font-weight:bold; color:#dc3545;">
                    {{ $tkb->PhongHoc }}
                </td>

                <td style="text-align:center;">
                    <a href="/giang-vien/xem-lop-day/{{ $tkb->LopID }}/{{ $tkb->MonHocID }}"
                        style="background:#17a2b8; color:white; padding:6px 10px; text-decoration:none; border-radius:4px; font-weight:bold; font-size:13px; display:inline-block;">
                        📋 Danh Sách
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection