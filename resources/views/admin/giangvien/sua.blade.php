@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/giang-vien">← Quay lại</a>
        <h2>Cập Nhật Giảng Viên</h2>

        <form action="/admin/giang-vien/sua/{{ $gv->GiangVienID }}" method="POST">
            @csrf

            <label>Mã Giảng Viên:</label>
            <input type="text" name="MaGV" value="{{ old('MaGV', $gv->MaGV) }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MaGV')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen', $gv->HoTen) }}" required
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Học Vị:</label>
            <input type="text" name="HocVi" value="{{ old('HocVi', $gv->HocVi) }}"
                style="width:100%; padding:10px; margin:5px 0;">

            <label>Chuyên Ngành:</label>
            <input type="text" name="ChuyenNganh" value="{{ old('ChuyenNganh', $gv->ChuyenNganh) }}"
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Cập
                Nhật</button>
        </form>
    </div>
@endsection
