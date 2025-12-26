@extends('layouts.giangvien')

@section('noidung')
<div class="card">
    <div style="border-bottom:1px solid #eee; padding-bottom:15px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 style="margin:0; font-size:24px; color:#2c3e50;">📊 Bảng Điểm Cá Nhân</h1>
            <p style="margin:5px 0 0;">Sinh viên: <b style="color:#007bff">{{ $sv->HoTen }}</b> - MSSV: <b>{{ $sv->MaSV }}</b></p>
        </div>
        <a href="/giang-vien/lop-chu-nhiem" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">← Quay lại</a>
    </div>
    
    @if($sv->diems->isEmpty())
        <p style="color:#666; font-style:italic; text-align:center; padding:20px;">Sinh viên này chưa có điểm môn nào.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">
            <thead style="background:#007bff; color:white;">
                <tr>
                    <th>Môn Học</th>
                    <th width="100px" style="text-align:center;">Tín Chỉ</th>
                    <th width="120px" style="text-align:center;">Điểm</th>
                    <th width="120px" style="text-align:center;">Kết Quả</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sv->diems as $diem)
                <tr>
                    <td style="font-weight:bold;">{{ $diem->monHoc->TenMonHoc ?? 'Môn ID: '.$diem->MonHocID }}</td>
                    <td style="text-align:center;">{{ $diem->monHoc->SoTinChi ?? '-' }}</td>
                    <td style="text-align:center; font-weight:bold; color:#d35400;">{{ $diem->DiemSo }}</td>
                    <td style="text-align:center;">
                        @if($diem->DiemSo >= 4) <span style="color:green; font-weight:bold;">Đạt</span>
                        @else <span style="color:red; font-weight:bold;">Học lại</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection