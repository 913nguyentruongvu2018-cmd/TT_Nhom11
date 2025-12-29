
@extends('layouts.sinhvien')

@section('noidung')
<div class="card">
    <h1>📅 Lịch học của sinh viên {{ $sv->HoTen }}</h1>

    @if($dsTKB->isEmpty())
    <div class="card" style="text-align:center; padding:80px 20px;">
        <h1 style="font-size:60px; margin:0;">😉</h1>
        <h2 style="color:#555; margin-top:20px;">Chưa có lịch học</h2>
        <p style="color:#777; font-size:16px;">
            Hiện tại bạn chưa có lịch học nào trong học kỳ này.
        </p>
        <a href="/sinh-vien/dashboard" style="display:inline-block; margin-top:30px; text-decoration:none; background:#007bff; color:white; padding:12px 25px; border-radius:50px; font-weight:bold;">
            ← Quay về Trang chủ
        </a>
    </div>
    @else
    @php
    $thuMap = [
    'Hai' => 'Thứ Hai', 'Ba' => 'Thứ Ba', 'Tu' => 'Thứ Tư',
    'Nam' => 'Thứ Năm', 'Sau' => 'Thứ Sáu', 'Bay' => 'Thứ Bảy', 'CN' => 'Chủ Nhật'
    ];
    @endphp

    <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th width="12%">Thứ</th>
                <th>Môn Học</th>
                <th width="20%">Thời Gian</th>
                <th width="10%">Phòng</th>
                <th width="20%">Giảng Viên</th> </tr>
        </thead>
        <tbody>
            @foreach($dsTKB as $tkb)
            <tr>
                <td style="font-weight:bold; color:#e67e22;">
                    {{ $thuMap[$tkb->ThuTrongTuan] ?? $tkb->ThuTrongTuan }}
                </td>

                <td style="font-weight:bold; color:#007bff;">
                    {{ $tkb->monHoc->TenMonHoc ?? 'Môn đã xóa' }}
                    <br><span style="font-weight:normal; color:#666; font-size:13px;">({{ $tkb->monHoc->SoTinChi }} tín chỉ)</span>
                </td>

                <td>
                    {{ date('H:i', strtotime($tkb->GioBatDau)) }} - {{ date('H:i', strtotime($tkb->GioKetThuc)) }}
                </td>

                <td style="font-weight:bold; color:#dc3545;">
                    {{ $tkb->PhongHoc }}
                </td>

                <td style="font-weight:bold;">
                     {{ $tkb->giangVien->HoTen ?? 'Chưa xếp GV' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection