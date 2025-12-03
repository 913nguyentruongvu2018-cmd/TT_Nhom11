<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký Sinh Viên</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f2f5;
            padding: 50px;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            width: 320px;
            margin: 0 auto; /* ⭐ Đưa form ra giữa */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }

        button:hover {
            background: #1e7e34;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .error-msg {
            color: red;
            text-align: left;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 15px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <form action="/dang-ky" method="POST">
        <h2>Đăng Ký Tài Khoản</h2>

        @csrf

        <label>Mã Sinh Viên:</label>
        <input type="text" name="MaSV" placeholder="Nhập MSSV"
            value="{{ old('MaSV') }}"
            style="{{ $errors->has('MaSV') ? 'border: 1px solid red;' : '' }}">

        @error('MaSV')
            <div class="error-msg">⚠️ {{ $message }}</div>
        @enderror


        <label>Tên đăng nhập:</label>
        <input type="text" name="TenDangNhap" value="{{ old('TenDangNhap') }}"
            style="{{ $errors->has('TenDangNhap') ? 'border: 1px solid red;' : '' }}">

        @error('TenDangNhap')
            <div class="error-msg">⚠️ {{ $message }}</div>
        @enderror


        <label>Mật khẩu:</label>
        <input type="password" name="MatKhau"
            style="{{ $errors->has('MatKhau') ? 'border: 1px solid red;' : '' }}">

        @error('MatKhau')
            <div class="error-msg">⚠️ {{ $message }}</div>
        @enderror

        <button type="submit">Đăng Ký</button>
    </form>

</body>

</html>