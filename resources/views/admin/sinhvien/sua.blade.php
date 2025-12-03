@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/sinh-vien">← Quay lại</a>
        <h2>Cập Nhật Sinh Viên</h2>

        <form action="/admin/sinh-vien/sua/{{ $sv->id }}" method="POST">
            @csrf

            <label>Mã Sinh Viên:</label>
            <input type="text" name="MaSV" value="{{ old('MaSV', $sv->MaSV) }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MaSV')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen', $sv->HoTen) }}" required
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Lớp:</label>
            <input type="text" name="Lop" value="{{ old('Lop', $sv->Lop) }}" required
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" value="{{ old('NgaySinh', $sv->NgaySinh) }}"
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Cập
                Nhật</button>
        </form>
    </div>
@endsection
