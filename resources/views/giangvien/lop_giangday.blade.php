@extends('layouts.giangvien')

@section('noidung')
<div class="card">
    <h1>📚 Danh sach các lớp giảng dạy của giảng viên  {{ $gv->HoTen }}</h1>

    @if($dsLopDay->isEmpty())
    <div class="card" style="text-align:center; padding:80px 20px;">
        <h1 style="font-size:60px; margin:0;">😉</h1>
        <h2 style="color:#555; margin-top:20px;">Chưa được phân công lớp giảng dạy nào</h2>
        <p style="color:#777; font-size:16px;">
            Hiện tại thầy/cô chưa có thông tin lớp giảng dạy nào trong học kỳ này.
        </p>
        <a href="/giang-vien/dashboard" style="display:inline-block; margin-top:30px; text-decoration:none; background:#007bff; color:white; padding:12px 25px; border-radius:50px; font-weight:bold;">
            ← Quay về Trang chủ
        </a>
    </div>
    @else
    <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th>Lớp Học</th>
                <th>Môn Học</th>
                <th>Số Tín Chỉ</th>
                <th width="150px" style="text-align:center;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsLopDay as $item)
            <tr>
                <td style="font-weight:bold; color:#007bff; font-size:16px;">
                    {{ $item->lopHoc->TenLop }}
                </td>
                <td style="font-weight:bold;">
                    {{ $item->monHoc->TenMonHoc }}
                </td>
                <td>
                    {{ $item->monHoc->SoTinChi }} tín chỉ
                </td>
                <td style="text-align:center;">
                    <a href="/giang-vien/xem-lop-day/{{ $item->LopID }}/{{ $item->MonHocID }}"
                        style="background:#17a2b8; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; font-weight:bold; font-size:13px;">
                        👁️ Xem Danh Sách
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection