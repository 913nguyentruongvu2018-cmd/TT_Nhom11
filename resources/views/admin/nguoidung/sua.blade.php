@extends('layouts.admin')

@section('noidung')
    <div class="card">
       
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Tài Khoản</h1>
            <a href="/admin/nguoi-dung" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- loi all --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="/admin/nguoi-dung/sua/{{ $user->id }}" method="POST" novalidate>
            @csrf
            
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {{-- ten dang nhap --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Tên Đăng Nhập</td>
                        <td>
                            <input type="text" value="{{ $user->TenDangNhap }}" readonly 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef; cursor:not-allowed;">
                        </td>
                    </tr>

                    {{-- ho ten --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Họ Tên</td>
                        <td>
                            <input type="text" value="{{ $user->HoTen }}" readonly 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef; cursor:not-allowed;">
                        </td>
                    </tr>

                    {{--vai tro --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Vai Trò</td>
                        <td>
                            <input type="text" value="{{ $user->VaiTro }}" readonly 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; background:#e9ecef; color:blue; font-weight:bold; cursor:not-allowed;">
                        </td>
                    </tr>

                    {{-- mail --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Email</td>
                        <td>
                            <input type="email" name="Email" value="{{ old('Email', $user->Email) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('Email') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- mat khau --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Đổi Mật Khẩu</td>
                        <td>
                            <input type="password" name="MatKhau" placeholder="Nhập mật khẩu mới nếu muốn đổi..." 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            <div style="font-size:12px; color:#666; margin-top:5px;">⚠️ Để trống nếu bạn vẫn dùng mật khẩu cũ.</div>
                            @error('MatKhau') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                </tbody>
            </table>
            <div style="text-align: right;">
                <button type="submit" style="background:#e67e22; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU CẬP NHẬT
                </button>
            </div>
        </form>
    </div>
@endsection