@extends('layouts.admin')

@section('noidung')
    <div class="card" style="width: 500px; margin: 0 auto;">
        <a href="/admin/diem">← Quay lại danh sách</a>
        <h2>📝 Nhập Điểm (Lọc Nhanh)</h2>

        @if (session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px; text-align:center;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="/admin/diem/nhap" method="POST">
            @csrf

            
            <label style="font-weight:bold;">Chọn Lớp:</label>
            <select id="LopSelect" style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px;">
                <option value="">-- Chọn Lớp --</option>
                @foreach ($dsLop as $lop)
                    {{-- Lưu ý: Khóa chính bảng Lớp của bạn là LopID --}}
                    <option value="{{ $lop->LopID }}">{{ $lop->TenLop }}</option>
                @endforeach
            </select>

            
            <label style="font-weight:bold;">Chọn Sinh Viên:</label>
            <select name="SinhVienID" id="SvSelect" required
                style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px; background-color: #f9f9f9;">
                <option value="">-- Vui lòng chọn Lớp trước --</option>
            </select>

            
            <label style="font-weight:bold;">Chọn Môn Học:</label>
            <select name="MonHocID" required style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px;">
                @foreach ($dsMonHoc as $mh)
                    <option value="{{ $mh->MonHocID }}">{{ $mh->TenMonHoc }}</option>
                @endforeach
            </select>

            <label style="font-weight:bold;">Chọn Học Kỳ:</label>
            <select name="HocKy" required style="width:100%; padding:10px; margin:5px 0 15px 0; border:1px solid #ddd; border-radius:4px;">
                <option value="HK1">Học Kỳ 1</option>
                <option value="HK2">Học Kỳ 2</option>
            </select>

            <label style="font-weight:bold;">Điểm Số:</label>
            <input type="number" name="DiemSo" step="0.1" min="0" max="10" required placeholder="Nhập điểm..."
                style="width:100%; padding:10px; margin:5px 0 5px 0; border:1px solid #ddd; border-radius:4px;">

            <button type="submit" style="background:#2ecc71; color:white; padding:12px; width:100%; border:none; margin-top:20px; cursor:pointer;">
                Lưu Điểm
            </button>
        </form>
    </div>

    
    <script>
        const tatCaSinhVien = @json($dsSinhVien);
        document.getElementById('LopSelect').addEventListener('change', function() {
            const lopIDCanTim = this.value; 
            const svSelect = document.getElementById('SvSelect');
            
            
            svSelect.innerHTML = '<option value="">-- Chọn Sinh Viên --</option>';

            if (lopIDCanTim) {
                
                const dsLocDuoc = tatCaSinhVien.filter(sv => sv.Lop == lopIDCanTim);

                if (dsLocDuoc.length > 0) {
                    dsLocDuoc.forEach(sv => {
                        const option = document.createElement('option');
                        option.value = sv.id;
                        option.textContent = sv.MaSV + ' - ' + sv.HoTen;
                        svSelect.appendChild(option);
                    });
                } else {
                    svSelect.innerHTML = '<option value="">Lớp này không có sinh viên</option>';
                }
            } else {
                svSelect.innerHTML = '<option value="">-- Vui lòng chọn Lớp trước --</option>';
            }
        });
    </script>
@endsection