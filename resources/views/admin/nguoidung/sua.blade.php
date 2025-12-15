@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/nguoi-dung">← Quay lại</a>
        <h2>Cập Nhật Tài Khoản</h2>

        <form action="/admin/nguoi-dung/sua/{{ $user->id }}" method="POST">
            @csrf

            <label>Tên Đăng Nhập:</label>
            <input type="text" name="TenDangNhap" value="{{ $user->TenDangNhap }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenDangNhap')
                <div style="color:red; font-size:14px;">{{ $message }}</div>
            @enderror

            {{-- THÊM Ô EMAIL VÀO ĐÂY --}}
            <label>Email:</label>
            <input type="email" name="Email" value="{{ old('Email', $user->Email) }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('Email')
                <div style="color:red; font-size:14px;">{{ $message }}</div>
            @enderror

            <label>Mật Khẩu Mới (Để trống nếu không đổi):</label>
            <input type="password" name="MatKhau" placeholder="Nhập nếu muốn đổi pass"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MatKhau')
                <div style="color:red; font-size:14px;">{{ $message }}</div>
            @enderror

            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ $user->HoTen }}" required
                style="width:100%; padding:10px; margin:5px 0;">
            @error('HoTen')
                <div style="color:red; font-size:14px;">{{ $message }}</div>
            @enderror

            <label>Vai Trò:</label>
            <select name="VaiTro" style="width:100%; padding:10px; margin:5px 0;">
                <option value="SinhVien" {{ $user->VaiTro == 'SinhVien' ? 'selected' : '' }}>Sinh Viên</option>
                <option value="GiangVien" {{ $user->VaiTro == 'GiangVien' ? 'selected' : '' }}>Giảng Viên</option>
                <option value="Admin" {{ $user->VaiTro == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <button type="submit"
                style="background:#e67e22; color:white; padding:10px; width:100%; border:none; margin-top:20px; cursor:pointer;">
                Cập Nhật
            </button>
        </form>
    </div>
@endsection