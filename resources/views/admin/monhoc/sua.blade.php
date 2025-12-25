@extends('layouts.admin')

@section('noidung')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <h1>✏️ Cập Nhật Môn Học</h1>
            <a href="/admin/mon-hoc" style="background:#6c757d; color:white; padding:8px 15px; text-decoration:none; border-radius:4px;">
                ← Quay lại
            </a>
        </div>

        <form action="/admin/mon-hoc/sua/{{ $mon->MonHocID }}" method="POST" novalidate>
            @csrf
            
            <table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; border:1px solid #ddd; margin-bottom:20px;">
                <thead>
                    <tr style="background:#2980b9; color:white;">
                        <th style="width: 250px;">Thông Tin</th>
                        <th>Dữ Liệu Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- MÃ MÔN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Mã Môn Học</td>
                        <td>
                            <input type="text" name="MaMon" value="{{ old('MaMon', $mon->MaMon) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                             @error('MaMon') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- TÊN MÔN --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Tên Môn Học</td>
                        <td>
                            <input type="text" name="TenMonHoc" value="{{ old('TenMonHoc', $mon->TenMonHoc) }}" required 
                                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                             @error('TenMonHoc') <div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div> @enderror
                        </td>
                    </tr>

                    {{-- SỐ TÍN CHỈ --}}
                    <tr>
                        <td style="font-weight:bold; background:#f9f9f9;">Số Tín Chỉ</td>
                        <td>
                            <input type="number" name="SoTinChi" step="any" value="{{ old('SoTinChi', $mon->SoTinChi) }}" min="1" required 
                                   style="width:100px; padding:8px; border:1px solid #ccc; border-radius:4px;">
                                    @error('SoTinChi')<div style="color:red; font-size:13px; margin-top:5px;">⚠️ {{ $message }}</div>
                                    @enderror
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