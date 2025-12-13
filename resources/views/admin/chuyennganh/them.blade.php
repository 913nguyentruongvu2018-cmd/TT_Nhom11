@extends('layouts.admin')
@section('noidung')
<div style="width:500px; margin:0 auto;">
    <h2>Thêm Chuyên Ngành</h2>
    <a href="/admin/chuyen-nganh">← Quay lại</a>
    
    <form action="" method="POST" style="background:#fff; padding:20px; border:1px solid #ddd; margin-top:10px;">
        @csrf
        <label>Mã Ngành (*):</label>
        <input type="text" name="MaCN" required placeholder="VD: CNTT" style="width:100%; padding:8px; margin-bottom:10px;">
        
        <label>Tên Chuyên Ngành (*):</label>
        <input type="text" name="TenCN" required placeholder="VD: Công Nghệ Thông Tin" style="width:100%; padding:8px; margin-bottom:10px;">
        
        <button type="submit" style="background:green; color:white; padding:10px; border:none; width:100%; cursor:pointer;">Lưu</button>
    </form>
</div>
@endsection