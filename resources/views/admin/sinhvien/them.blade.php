@extends('layouts.admin')

@section('noidung')
<div style="max-width: 600px; margin: 0 auto;">

    <h1 style="text-align: center; margin-bottom: 20px;">Thêm Sinh Viên Mới</h1>

    <a href="/admin/sinh-vien" style="text-decoration: none; color: #555; display: inline-block; margin-bottom: 15px;">
        ← Quay lại danh sách
    </a>

    @if ($errors->any())
    <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius: 5px;">
        ⚠️ {{ $errors->first() }}
    </div>
    @endif

    <form action="/admin/sinh-vien/them" method="POST"
        style="background: #fff; padding: 25px; border: 1px solid #ddd; border-radius: 8px;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Mã Sinh Viên (*)</label>
            <input type="text" name="MaSV" value="{{ old('MaSV') }}" required placeholder="VD: DH52201234"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            <small style="color: #666; font-style: italic;">Bắt đầu bằng DH522 và 5 số.</small>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Họ và Tên (*)</label>
            <input type="text" name="HoTen" value="{{ old('HoTen') }}" required placeholder="Nhập họ tên"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Ngày Sinh (*)</label>
            <input type="date" name="NgaySinh" value="{{ old('NgaySinh') }}" required
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Lớp</label>
            <select name="Lop" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Chọn Lớp Học --</option>
                @foreach($dsLop as $lop)
                <option value="{{ $lop->LopID }}" {{ old('Lop') == $lop->LopID ? 'selected' : '' }}>
                    {{ $lop->TenLop }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="background: green; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%;">
            Lưu Sinh Viên
        </button>
    </form>
</div>
@endsection