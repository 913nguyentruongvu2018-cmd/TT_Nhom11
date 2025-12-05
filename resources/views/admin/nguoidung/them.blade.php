@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/nguoi-dung">← Quay lại</a>
        <h2>Thêm Tài Khoản Mới</h2>

        <form action="/admin/nguoi-dung/them" method="POST">
            @csrf

            <label>Tên Đăng Nhập:</label>
            <input type="text" name="TenDangNhap" value="{{ old('TenDangNhap') }}"
                style="width:100%; padding:10px; margin:5px 0;">
            @error('TenDangNhap')
                <div style="color:red; font-size:14px; margin-bottom:10px;">⚠️ {{ $message }}</div>
            @enderror


            <label>Mật Khẩu:</label>
            <input type="password" name="MatKhau" 
                style="width:100%; padding:10px; margin:5px 0;">
            @error('MatKhau')
                <div style="color:red; font-size:14px; margin-bottom:10px;">⚠️ {{ $message }}</div>
            @enderror


            <label>Họ Tên:</label>
            <input type="text" name="HoTen" value="{{ old('HoTen') }}"
                style="width:100%; padding:10px; margin:5px 0;">

            @error('HoTen')
                <div style="color:red; font-size:14px; margin-bottom:10px;">⚠️ {{ $message }}</div>
            @enderror


            <label>Vai Trò:</label>
            <select name="VaiTro" id="roleSelect" style="width:100%; padding:10px; margin:5px 0;"
                onchange="toggleStudentSelect()">
                <option value="SinhVien">Sinh Viên</option>
                <option value="GiangVien">Giảng Viên</option>
                <option value="Admin">Admin</option>
            </select>


            <div id="studentSelectArea" style="margin-top:10px; border:1px dashed blue; padding:10px; display:none;">
                <label style="color:blue; font-weight:bold;">Liên kết với Sinh viên (Chưa có TK):</label>
                <select name="SinhVienID" style="width:100%; padding:10px; margin:5px 0;">
                    <option value="">-- Chọn sinh viên --</option>
                    @foreach ($svChuaCoTK as $sv)
                        <option value="{{ $sv->id }}">{{ $sv->MaSV }} - {{ $sv->HoTen }}</option>
                        
                    @endforeach
                </select>
                @error('SinhVienID')
                    <div style="color:red; font-size:14px; margin-top:5px; font-weight:bold;">
                        ⚠️ {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit"
                style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:20px; cursor:pointer;">
                Lưu Tài Khoản
            </button>
        </form>
    </div>

    <script>
        function toggleStudentSelect() {
            var role = document.getElementById("roleSelect").value;
            var area = document.getElementById("studentSelectArea");
            if (role === 'SinhVien') {
                area.style.display = 'block';
            } else {
                area.style.display = 'none';
            }
        }
        // Chạy ngay khi vào trang
        toggleStudentSelect();
    </script>
@endsection
