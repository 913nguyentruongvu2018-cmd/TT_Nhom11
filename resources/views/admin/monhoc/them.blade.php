@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/mon-hoc">← Quay lại</a>
        <h2>Thêm Môn Học</h2>

        <form action="/admin/mon-hoc/them" method="POST">
            @csrf

            <label>Tên Môn Học:</label>
            <input type="text" name="TenMonHoc" value="{{ old('TenMonHoc') }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenMonHoc')
                <div style="color:red">{{ $message }}</div>
            @enderror

            <label>Số Tín Chỉ:</label>
            <input type="number" name="SoTinChi" value="{{ old('SoTinChi', 3) }}" min="1" required
                style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:10px; cursor:pointer;">Lưu
                Môn Học</button>
        </form>
    </div>
@endsection
