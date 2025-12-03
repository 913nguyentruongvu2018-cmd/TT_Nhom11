@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/lop-hoc">← Quay lại</a>
        <h2>Thêm Lớp Học</h2>

        <form action="/admin/lop-hoc/them" method="POST">
            @csrf

            <label>Tên Lớp:</label>
            <input type="text" name="TenLop" required placeholder="VD: CNTT K17"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenLop')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Giảng Viên Chủ Nhiệm:</label>
            <select name="GiangVienID" style="width:100%; padding:10px; margin:5px 0;">
                @foreach ($dsGiangVien as $gv)
                    <option value="{{ $gv->GiangVienID }}">{{ $gv->HoTen }} ({{ $gv->MaGV }})</option>
                @endforeach
            </select>

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Lưu
                Lại</button>
        </form>
    </div>
@endsection
