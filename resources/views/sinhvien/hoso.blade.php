@extends('layouts.sinhvien')

@section('noidung')
<div class="card">
    <h1>👤 Hồ Sơ Cá Nhân</h1>

    @if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:4px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:4px;">
        ⚠️ {{ $errors->first() }}
    </div>
    @endif

    <div style="display:flex; gap:30px;">
        <div style="flex:1;">
            <h3>Thông tin sinh viên</h3>
            <table cellpadding="10" style="width:100%;">
                <tr>
                    <td>Mã SV:</td>
                    <td><b>{{ $sv->MaSV }}</b></td>
                </tr>
                <tr>
                    <td>Họ tên:</td>
                    <td><b>{{ $sv->HoTen }}</b></td>
                </tr>
                <tr>
                    <td>Ngày sinh:</td>
                    <td>{{ date('d/m/Y', strtotime($sv->NgaySinh)) }}</td>
                </tr>
                <tr>
                    <td>Lớp sinh hoạt:</td>
                    <td>{{ $sv->lopHoc->TenLop ?? 'Chưa có' }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $user->Email }}</td>
                </tr>
            </table>
        </div>

        <div style="flex:1; border-left:1px solid #eee; padding-left:30px;">
            <h3>🔐 Đổi mật khẩu</h3>
            <form action="/sinh-vien/doi-mat-khau" method="POST">
                @csrf

                <div style="margin-bottom:15px;">
                    <label>Mật khẩu hiện tại:</label><br>
                    <input type="password" name="password_old" style="width:100%; padding:8px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">

                    @error('password_old')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label>Mật khẩu mới:</label><br>
                    <input type="password" name="password_new" style="width:100%; padding:8px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">

                    @error('password_new')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label>Xác nhận mật khẩu mới:</label><br>
                    <input type="password" name="password_new_confirmation" style="width:100%; padding:8px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" style="background:#007bff; color:white; padding:10px 20px; border:none; cursor:pointer; border-radius:4px; font-weight:bold;">
                    Lưu Thay Đổi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection