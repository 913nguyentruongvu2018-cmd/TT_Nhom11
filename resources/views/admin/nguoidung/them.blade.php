@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>👤 Thêm Tài Khoản Mới</h1>
            <a href="/admin/nguoi-dung" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- hien thi loi --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="/admin/nguoi-dung/them" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Nhập</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- vai tro lien ket --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Vai Trò (*)</td>
                        <td>
                            {{-- vai tro --}}
                            <select name="VaiTro" id="roleSelect" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;" onchange="handleRoleChange()">
                                <option value="SinhVien" {{ (old('VaiTro') ?? request('role')) == 'SinhVien' ? 'selected' : '' }}>Sinh Viên</option>
                                <option value="GiangVien" {{ (old('VaiTro') ?? request('role')) == 'GiangVien' ? 'selected' : '' }}>Giảng Viên</option>
                                <option value="Admin" {{ (old('VaiTro') ?? request('role')) == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>

                            {{-- sinh vien (an /hien) --}}
                            <div id="studentSelectArea" style="margin-top:10px; border:1px dashed #007bff; background:#e9f7fe; padding:10px; border-radius:4px; display:none;">
                                <label style="color:#0056b3; font-weight:bold; font-size:13px; display:block; margin-bottom:5px;">Chọn Sinh viên cần cấp tài khoản:</label>
                                <select name="SinhVienID" id="selectSinhVien" style="width:100%; padding:8px;" onchange="autoFill('sv')">
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

                            {{-- giang vien( an /hien) --}}
                            <div id="lecturerSelectArea" style="margin-top:10px; border:1px dashed #e67e22; background:#fff8e1; padding:10px; border-radius:4px; display:none;">
                                <label style="color:#d35400; font-weight:bold; font-size:13px; display:block; margin-bottom:5px;">Chọn Giảng viên cần cấp tài khoản:</label>
                                <select name="GiangVienID" id="selectGiangVien" style="width:100%; padding:8px;" onchange="autoFill('gv')">
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
                        </td>
                    </tr>

                    {{-- ten dang nhap --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Tên Đăng Nhập (*)</td>
                        <td>
                            <input type="text" name="TenDangNhap" id="TenDangNhap" required
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef;" readonly>
                            <div style="font-size:12px; color:#666; margin-top:5px;">Tự động điền khi chọn SV/GV (Hoặc nhập tay nếu là Admin).</div>
                            @error('TenDangNhap') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- ho ten --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ Tên (*)</td>
                        <td>
                            <input type="text" name="HoTen" id="HoTen" required
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef;" readonly>
                             @error('HoTen') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- mail --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Email (*)</td>
                        <td>
                            <input type="email" name="Email" value="{{ old('Email') }}" required placeholder="VD: example@gmail.com"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                             @error('Email') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- mat khau --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mật Khẩu (*)</td>
                        <td>
                            <input type="password" name="MatKhau" required
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                             @error('MatKhau') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU TÀI KHOẢN
                </button>
            </div>
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
               
                enableInput("TenDangNhap");
                enableInput("HoTen");
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
                disableInput("TenDangNhap");
                disableInput("HoTen");
            }
        }

        function enableInput(id) {
            var el = document.getElementById(id);
            el.readOnly = false;
            el.style.backgroundColor = "white";
            el.value = ""; // Xóa trắng để nhập
        }

        function disableInput(id) {
            var el = document.getElementById(id);
            el.readOnly = true;
            el.style.backgroundColor = "#e9ecef";
        }

        window.onload = function() {
            handleRoleChange();
        };
    </script>
@endsection