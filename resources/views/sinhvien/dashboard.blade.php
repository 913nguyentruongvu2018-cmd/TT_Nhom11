@extends('layouts.sinhvien')

@section('noidung')
    <div class="card">
        <h1>👋 Xin chào, Sinh viên {{ $sv->HoTen }}!</h1>
        <p style="color:#666;">MSSV: <b>{{ $sv->MaSV }}</b> - Lớp: <b>{{ $sv->lopHoc->TenLop ?? 'Chưa cập nhật' }}</b></p>

        <div style="display:flex; gap:20px; margin-top:30px;">
            <div style="flex:1; background:#e3f2fd; padding:20px; border-radius:8px; border-left:5px solid #007bff;">
                <h3 style="margin:0; color:#007bff;">📅 Lịch Học</h3>
                <p>Xem thời khóa biểu học tập cá nhân.</p>
                <a href="/sinh-vien/lich-hoc" style="text-decoration:none; font-weight:bold; color:#0056b3;">Xem chi tiết &rarr;</a>
            </div>

            <div style="flex:1; background:#fff3cd; padding:20px; border-radius:8px; border-left:5px solid #ffc107;">
                <h3 style="margin:0; color:#d39e00;">📊 Bảng Điểm</h3>
                <p>Xem kết quả học tập các môn.</p>
                <a href="/sinh-vien/bang-diem" style="text-decoration:none; font-weight:bold; color:#856404;">Xem điểm số &rarr;</a>
            </div>
            
             <div style="flex:1; background:#e8f5e9; padding:20px; border-radius:8px; border-left:5px solid #28a745;">
                <h3 style="margin:0; color:#28a745;">🏫 Lớp Của Tôi</h3>
                <p>Xem danh sách bạn bè cùng lớp.</p>
                <a href="/sinh-vien/lop-cua-toi" style="text-decoration:none; font-weight:bold; color:#1e7e34;">Xem danh sách &rarr;</a>
            </div>
        </div>
    </div>
@endsection