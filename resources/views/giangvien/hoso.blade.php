@extends('layouts.giangvien')

@section('noidung')
<div class="card">
    <h1>👤 Hồ Sơ Giảng Viên</h1>

    @if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:4px; border: 1px solid #c3e6cb;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:4px; border: 1px solid #f5c6cb;">
        ⚠️ {{ $errors->first() }}
    </div>
    @endif

    <div style="display:flex; gap:30px; flex-wrap:wrap;">
        
        <div style="flex:1; min-width: 300px;">
            <h3 style="color:#007bff; border-bottom: 2px solid #eee; padding-bottom: 10px;">Thông tin cá nhân</h3>
            <table cellpadding="12" style="width:100%;">
                <tr>
                    <td style="color:#666; width: 140px;">Mã Giảng Viên:</td>
                    <td><b style="font-size:18px;">{{ $gv->MaGV }}</b></td>
                </tr>
                <tr>
                    <td style="color:#666;">Họ và Tên:</td>
                    <td><b>{{ $gv->HoTen }}</b></td>
                </tr>
                <tr>
                    <td style="color:#666;">Lớp Chủ Nhiệm:</td>
                    <td>{{ $gv->lopHoc->TenLop ?? 'Chưa phân công' }}</td>
                </tr>
                <tr>
                    <td style="color:#666;">Email hệ thống:</td>
                    <td>{{ $user->Email }}</td>
                </tr>
            </table>
        </div>

        <div style="flex:1; min-width: 300px; border-left:1px solid #eee; padding-left:30px;">
            <h3 style="color:#28a745; border-bottom: 2px solid #eee; padding-bottom: 10px;">🔐 Đổi mật khẩu</h3>
            
            <form action="/giang-vien/doi-mat-khau" method="POST">
                @csrf

                <div style="margin-bottom:15px;">
                    <label style="font-weight:bold; color:#555;">Mật khẩu hiện tại:</label><br>
                    <input type="password" name="password_old" 
                           style="width:100%; padding:10px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">

                    @error('password_old')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                </div>

                <div style="margin-bottom:15px;">
                    <label style="font-weight:bold; color:#555;">Mật khẩu mới:</label><br>
                    <input type="password" name="password_new" 
                           style="width:100%; padding:10px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">

                    @error('password_new')
                    <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                </div>

                <div style="margin-bottom:20px;">
                    <label style="font-weight:bold; color:#555;">Xác nhận mật khẩu mới:</label><br>
                    <input type="password" name="password_new_confirmation" 
                           style="width:100%; padding:10px; margin-top:5px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" 
                        style="background:#007bff; color:white; padding:12px 25px; border:none; cursor:pointer; border-radius:4px; font-weight:bold; width: 100%;">
                    💾 Lưu Thay Đổi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection