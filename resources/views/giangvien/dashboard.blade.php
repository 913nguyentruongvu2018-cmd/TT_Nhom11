@extends('layouts.giangvien')

@section('noidung')
    <div class="card">
        <h1>👋 Xin chào, Giảng viên {{ $gv->HoTen }}!</h1>
        <p style="color:#666;">Chúc thầy/cô một ngày làm việc hiệu quả.</p>

        <div style="display:flex; gap:20px; margin-top:30px;">
            <div style="flex:1; background:#e3f2fd; padding:20px; border-radius:8px; border-left:5px solid #007bff;">
                <h3 style="margin:0; color:#007bff;">📅 Lịch Dạy</h3>
                <p>Xem thời khóa biểu giảng dạy cá nhân.</p>
                <a href="/giang-vien/lich-day" style="text-decoration:none; font-weight:bold; color:#0056b3;">Xem chi tiết &rarr;</a>
            </div>

            <div style="flex:1; background:#e8f5e9; padding:20px; border-radius:8px; border-left:5px solid #28a745;">
                <h3 style="margin:0; color:#28a745;">🏫 Lớp Chủ Nhiệm</h3>
                <p>Quản lý danh sách và điểm số sinh viên.</p>
                <a href="/giang-vien/lop-chu-nhiem" style="text-decoration:none; font-weight:bold; color:#1e7e34;">Xem danh sách &rarr;</a>
            </div>
        </div>
    </div>
@endsection