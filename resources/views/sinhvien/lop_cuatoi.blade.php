@extends('layouts.sinhvien')

@section('noidung')

<div class="card">
    <h1>🏫 Lớp sinh hoạt: {{ $lop->TenLop ?? 'Chưa phân lớp' }}</h1>

    @if(!$lop)
    <div class="card" style="text-align:center; padding:80px 20px;">
        <h2 style="color:#555;">Bạn chưa được phân vào lớp nào</h2>
    </div>
    @else
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:15px;">
            <div>
                <h1 style="margin:0; color:#2c3e50;">📋 Danh Sách Thành Viên Lớp</h1>
                <p style="color:#666; margin:5px 0 0;">
                   Sĩ số: <b>{{ $dsSV->count() }}</b> sinh viên
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
                    <th width="150px" style="text-align:center;">Ngày Sinh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsSV as $index => $item)
                <tr style="{{ $item->id == $sv->id ? 'background:#e3f2fd;' : '' }}"> <td style="text-align:center;">{{ $index + 1 }}</td>
                    <td style="font-weight:bold; color:#555;">{{ $item->MaSV }}</td>
                    <td style="font-weight:bold;">
                        {{ $item->HoTen }} 
                        @if($item->id == $sv->id) <span style="color:#007bff; font-size:12px;">(Tôi)</span> @endif
                    </td>
                    <td style="text-align:center;">{{ $item->NgaySinh ? date('d/m/Y', strtotime($item->NgaySinh)) : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif
</div>

@endsection