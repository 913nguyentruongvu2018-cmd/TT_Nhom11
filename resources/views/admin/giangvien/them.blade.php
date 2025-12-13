@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/giang-vien">← Quay lại</a>
        <h2>Thêm Giảng Viên</h2>

        <form action="/admin/giang-vien/them" method="POST">
            @csrf

            <label>Mã Giảng Viên:</label>
            <input type="text" name="MaGV" value="{{ old('MaGV') }}" required placeholder="VD: GV001"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MaGV')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen') }}" required placeholder="VD: Nguyễn Văn A"
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Học Vị:</label>
            <input type="text" name="HocVi" value="{{ old('HocVi') }}" placeholder="VD: Thạc sĩ, Tiến sĩ"
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Chuyên Ngành:</label>
            <select name="ChuyenNganhID" style="width:100%; padding:10px; margin:5px 0;" required>
                <option value="">-- Chọn chuyên ngành --</option>
                @foreach ($dsChuyenNganh as $cn)
                    <option value="{{ $cn->ChuyenNganhID }}">{{ $cn->TenChuyenNganh }}</option>
                @endforeach
            </select>

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Lưu
                Lại</button>
        </form>
    </div>
@endsection
