@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Thời Khóa Biểu</h1>
        
        <a href="/admin/tkb/them" style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+ Xếp Lịch Học Mới</a>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Thứ</th>
                    <th>Lớp</th>
                    <th>Môn Học</th>
                    <th>Giảng Viên</th>
                    <th>Thời Gian</th>
                    <th>Phòng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dsTKB as $tkb)
                <tr>
                    <td style="font-weight:bold;">{{ $tkb->ThuTrongTuan }}</td>
                    <td style="color:blue; font-weight:bold;">{{ $tkb->lopHoc->TenLop }}</td>
                    <td>{{ $tkb->monHoc->TenMonHoc }}</td>
                    <td>{{ $tkb->giangVien->HoTen }}</td>
                    <td>{{ date('H:i', strtotime($tkb->GioBatDau)) }} - {{ date('H:i', strtotime($tkb->GioKetThuc)) }}</td>
                    <td style="font-weight:bold; color:red;">{{ $tkb->PhongHoc }}</td>
                    <td>
                        <a href="/admin/tkb/xoa/{{ $tkb->TKBid }}" 
                           style="color: red; text-decoration:none;"
                           onclick="return confirm('Xóa lịch học này?');">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection