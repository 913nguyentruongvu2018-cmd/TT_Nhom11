@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Người Dùng</h1>

        <a href="/admin/nguoi-dung/them"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+
            Thêm Tài Khoản</a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">✅ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:10px;">⚠️ {{ $errors->first() }}</div>
        @endif

        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse; border-color: #ddd;">
            <thead>
                <tr style="background-color: #f2f2f2; text-align: left;">
                    <th>ID</th>
                    <th>Email</th> <th>Họ Tên</th>
                    <th>Vai Trò</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsNguoiDung as $user)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td>{{ $user->id }}</td>
                        
                        <td style="font-weight:bold; color:blue;">
                            {{ $user->Email }}
                        </td>

                        <td>{{ $user->HoTen }}</td>
                        <td>
                            @if ($user->VaiTro == 'Admin')
                                <span style="color:red; font-weight:bold;">Admin</span>
                            @elseif($user->VaiTro == 'GiangVien')
                                <span style="color:orange; font-weight:bold;">Giảng Viên</span>
                            @else
                                <span style="color:green; font-weight:bold;">Sinh Viên</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/nguoi-dung/sua/{{ $user->id }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/nguoi-dung/xoa/{{ $user->id }}" style="color: red;"
                                onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection