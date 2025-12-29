<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập Hệ Thống</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 50px;
            background-color: #f0f2f5;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            width: 320px;
            margin: 0 auto;
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
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }

        button:hover {
            background: #0056b3;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
            font-size: 14px;
        }

        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            text-align: center;
        }
        
        .note {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 15px;
            font-style: italic;
        }

        .forgot-pass {
            text-align: right;
            margin-bottom: 15px;
            margin-top: -10px;
        }
        .forgot-pass a {
            color: #007bff;
            text-decoration: none;
            font-size: 13px;
        }
        .forgot-pass a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <form action="/dang-nhap" method="POST">
        <h2>Đăng Nhập</h2>

        @if (session('success'))
            <div class="success-msg">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @csrf

        <label for="TenDangNhap">Tên đăng nhập:</label>
        <input type="text" id="TenDangNhap" name="TenDangNhap" required placeholder="VD: DH52200001" autofocus>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="MatKhau" required placeholder="Nhập mật khẩu">

        <div class="forgot-pass">
            <a href="/quen-mat-khau">Quên mật khẩu?</a>
        </div>
        
        <button type="submit">Đăng Nhập</button>
        
        <div class="note">
            Sử dụng Mã SV hoặc Mã GV để đăng nhập.
        </div>
    </form>

</body>

</html>