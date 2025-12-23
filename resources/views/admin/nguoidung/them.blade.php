@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 600px; margin: 0 auto;">
        <a href="/admin/nguoi-dung">← Quay lại</a>
        <h2>Thêm Tài Khoản Mới</h2>

        <form action="/admin/nguoi-dung/them" method="POST">
            @csrf

            
            <label>Vai Trò:</label>
            <select name="VaiTro" id="roleSelect" style="width:100%; padding:10px; margin:5px 0;"
                onchange="handleRoleChange()">
                <option value="SinhVien" {{ (old('VaiTro') ?? request('role')) == 'SinhVien' ? 'selected' : '' }}>Sinh Viên</option>
                <option value="GiangVien" {{ (old('VaiTro') ?? request('role')) == 'GiangVien' ? 'selected' : '' }}>Giảng Viên</option>
                <option value="Admin" {{ (old('VaiTro') ?? request('role')) == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>

            
            <div id="studentSelectArea" style="margin:10px 0; border:1px dashed blue; padding:10px; display:none;">
                <label style="color:blue; font-weight:bold;">Chọn Sinh viên cần cấp tài khoản:</label>
                <select name="SinhVienID" id="selectSinhVien" style="width:100%; padding:10px;" onchange="autoFill('sv')">
                    <option value="">-- Chọn sinh viên --</option>
                    @foreach ($svChuaCoTK as $sv)
                        <option value="{{ $sv->id }}" 
                                data-code="{{ $sv->MaSV }}" 
                                data-name="{{ $sv->HoTen }}"
                                
                                {{ (old('SinhVienID') ?? request('id')) == $sv->id ? 'selected' : '' }}>
                            {{ $sv->MaSV }} - {{ $sv->HoTen }}
                        </option>
                    @endforeach
                </select>
            </div>

            
            <div id="lecturerSelectArea" style="margin:10px 0; border:1px dashed orange; padding:10px; display:none;">
                <label style="color:orange; font-weight:bold;">Chọn Giảng viên cần cấp tài khoản:</label>
                <select name="GiangVienID" id="selectGiangVien" style="width:100%; padding:10px;" onchange="autoFill('gv')">
                    <option value="">-- Chọn giảng viên --</option>
                    @foreach ($gvChuaCoTK as $gv)
                        <option value="{{ $gv->GiangVienID }}" 
                                data-code="{{ $gv->MaGV }}" 
                                data-name="{{ $gv->HoTen }}"
                                {{ (old('GiangVienID') ?? request('id')) == $gv->GiangVienID ? 'selected' : '' }}>
                            {{ $gv->MaGV }} - {{ $gv->HoTen }}
                        </option>
                    @endforeach
                </select>
            </div>

            
            <label>Tên Đăng Nhập (Tự động):</label>
            <input type="text" name="TenDangNhap" id="TenDangNhap" style="width:100%; padding:10px; margin:5px 0; background:#e9ecef;" readonly>

            <label>Họ Tên (Tự động):</label>
            <input type="text" name="HoTen" id="HoTen" style="width:100%; padding:10px; margin:5px 0; background:#e9ecef;" readonly>

            <label>Email (Nhập mới):</label>
            <input type="email" name="Email" value="{{ old('Email') }}" required style="width:100%; padding:10px; margin:5px 0;">

            <label>Mật Khẩu:</label>
            <input type="password" name="MatKhau" required style="width:100%; padding:10px; margin:5px 0;">

            <button type="submit" style="background:green; color:white; padding:10px; width:100%; border:none; margin-top:20px; cursor:pointer;">Lưu Tài Khoản</button>
        </form>
    </div>

    <script>
        function handleRoleChange() {
            var role = document.getElementById("roleSelect").value;
            var svArea = document.getElementById("studentSelectArea");
            var gvArea = document.getElementById("lecturerSelectArea");
            
            svArea.style.display = 'none';
            gvArea.style.display = 'none';

            if (role === 'SinhVien') {
                svArea.style.display = 'block';
                
                if(document.getElementById("selectSinhVien").value) autoFill('sv');
            } else if (role === 'GiangVien') {
                gvArea.style.display = 'block';
                if(document.getElementById("selectGiangVien").value) autoFill('gv');
            } else {
                
                document.getElementById("TenDangNhap").readOnly = false;
                document.getElementById("TenDangNhap").style.backgroundColor = "white";
                document.getElementById("HoTen").readOnly = false;
                document.getElementById("HoTen").style.backgroundColor = "white";
            }
        }

        function autoFill(type) {
            var selectBox = type === 'sv' ? document.getElementById("selectSinhVien") : document.getElementById("selectGiangVien");
            var selectedOption = selectBox.options[selectBox.selectedIndex];
            
            var code = selectedOption.getAttribute('data-code');
            var name = selectedOption.getAttribute('data-name');

            if (code && name) {
                document.getElementById("TenDangNhap").value = code;
                document.getElementById("HoTen").value = name;
                
                
                document.getElementById("TenDangNhap").readOnly = true;
                document.getElementById("HoTen").readOnly = true;
                document.getElementById("TenDangNhap").style.backgroundColor = "#e9ecef";
                document.getElementById("HoTen").style.backgroundColor = "#e9ecef";
            }
        }

        
        window.onload = function() {
            handleRoleChange();
        };
    </script>
@endsection