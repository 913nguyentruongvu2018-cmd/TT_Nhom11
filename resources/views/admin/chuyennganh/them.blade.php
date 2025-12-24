@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>🎓 Thêm Chuyên Ngành Mới</h1>
            <a href="/admin/chuyen-nganh" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        {{-- Hiển thị lỗi --}}
        @if($errors->any())
            <div style="background:#f8d7da; color:red; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">
                ⚠️ Vui lòng kiểm tra lại dữ liệu nhập bên dưới.
            </div>
        @endif

        <form action="" method="POST">
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Nhập</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- MÃ NGÀNH --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Ngành (*)</td>
                        <td>
                            <input type="text" name="MaCN" required placeholder="VD: CNTT" value="{{ old('MaCN') }}"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            <div style="font-size:12px; color:#666; margin-top:5px;">Mã ngành viết tắt (Ví dụ: CNTT, KT, NNA...)</div>
                            @error('MaCN') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- TÊN NGÀNH --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Tên Chuyên Ngành (*)</td>
                        <td>
                            <input type="text" name="TenCN" required placeholder="VD: Công Nghệ Thông Tin" value="{{ old('TenCN') }}"
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                            @error('TenCN') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: right;">
                <button type="submit" style="background:#28a745; color:white; padding:12px 40px; border:none; border-radius:4px; cursor:pointer; font-weight:bold; font-size:16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    💾 LƯU CHUYÊN NGÀNH
                </button>
            </div>
        </form>
    </div>
@endsection