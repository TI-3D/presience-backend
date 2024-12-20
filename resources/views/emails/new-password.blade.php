<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .content {
            text-align: center;
            color: #333333;
        }
        .content h1 {
            font-size: 24px;
            color:#2B2464;;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .password-box {
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            background-color:#2B2464;;
            padding: 10px 15px;
            display: inline-block;
            border-radius: 4px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
        <img src="https://res.cloudinary.com/darlcg2xv/image/upload/v1734150335/a1a1k2tnhsjxca8srrqc.png" alt="Logo Presience">
        </div>
        <div class="content">
            <h2>Hai {{ $name }}</h2>
            <p>Password akun Presience Anda berhasil diperbarui.<br>Silakan login menggunakan password dibawah ini.</p>
            <div class="password-box">{{ $password }}</div>
            <p>Jika Anda tidak melakukan perubahan password ini, mohon segera hubungi Admin.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Presience App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
