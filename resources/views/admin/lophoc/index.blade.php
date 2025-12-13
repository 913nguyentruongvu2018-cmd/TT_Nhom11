@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <h1>Quản Lý Lớp Học</h1>

        <a href="/admin/lop-hoc/them"
            style="background:green; color:white; padding:10px; text-decoration:none; border-radius:5px; margin-bottom:15px; display:inline-block;">+
            Thêm Lớp Học</a>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Lớp</th>
                    <th>Chuyên Ngành</th> {{-- Cột mới thêm --}}
                    <th>GV Chủ Nhiệm</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsLop as $lop)
                    <tr>
                        <td>{{ $lop->LopID }}</td>
                        <td style="font-weight:bold; color:blue;">{{ $lop->TenLop }}</td>
                        
                        {{-- Hiển thị tên Chuyên Ngành --}}
                        <td>
                            @if($lop->chuyenNganh)
                                {{ $lop->chuyenNganh->TenChuyenNganh }}
                            @else
                                <span style="color:gray; font-style:italic;">(Chưa cập nhật)</span>
                            @endif
                        </td>

                        {{-- Hiển thị tên Giảng Viên --}}
                        <td>
                            @if($lop->giangVien)
                                {{ $lop->giangVien->HoTen }}
                            @else
                                <span style="color:red;">(Chưa phân công)</span>
                            @endif
                        </td>

                        <td>
                            <a href="/admin/lop-hoc/sua/{{ $lop->LopID }}" style="color: blue;">Sửa</a> |
                            <a href="/admin/lop-hoc/xoa/{{ $lop->LopID }}" style="color: red;"
                                onclick="return confirm('Bạn có chắc muốn xóa lớp {{ $lop->TenLop }}?');">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection