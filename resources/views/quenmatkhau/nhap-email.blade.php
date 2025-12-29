<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quên Mật Khẩu</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }


        input.is-invalid {
            border: 1px solid #dc3545;
            background-color: #fff8f8;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #0056b3;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2 style="text-align: center; color: #333;">🔒 Quên Mật Khẩu</h2>

        @if(session('error'))
        <div class="alert">⚠️ {{ session('error') }}</div>
        @endif


        <form action="/quen-mat-khau" method="POST" novalidate>
            @csrf
            <label style="font-weight: bold;">Nhập Email của bạn:</label>

            <input type="email" name="Email"
                value="{{ old('Email') }}"
                class="@error('Email') is-invalid @enderror"
                required placeholder="VD: hoangphuc@mailinator.com">


            @error('Email')
            <span class="text-danger">⚠️ {{ $message }}</span>
            @enderror

            <button type="submit">Gửi Mã Xác Nhận</button>
        </form>

        <p style="text-align:center; margin-top:15px;">
            <a href="/dang-nhap" style="text-decoration: none; color: #666;">← Quay lại đăng nhập</a>
        </p>
    </div>
</body>

</html>