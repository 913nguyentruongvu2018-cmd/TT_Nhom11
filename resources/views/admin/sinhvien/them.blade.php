@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/sinh-vien" style="text-decoration:none; color:black;">← Quay lại danh sách</a>

        <h2>Thêm Sinh Viên Mới</h2>

        <form action="/admin/sinh-vien/them" method="POST">
            @csrf

            <label>Mã Sinh Viên:</label>
            <input type="text" name="MaSV" value="{{ old('MaSV') }}" required placeholder="VD: SV001"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MaSV')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen') }}" required placeholder="Nguyễn Văn A"
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Lớp:</label>
            <input type="text" name="Lop" value="{{ old('Lop') }}" required placeholder="CNTT K15"
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Ngày Sinh:</label>
            <input type="date" name="NgaySinh" value="{{ old('NgaySinh') }}"
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Lưu
                Hồ Sơ</button>
        </form>
    </div>
@endsection
