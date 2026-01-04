<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Java Adventure</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, sans-serif;
            /* Latar belakang gambar alam dengan overlay biru tua sesuai tema Java Adventure */
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                        url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            width: 350px;
            text-align: center;
            backdrop-filter: blur(5px);
        }

        .login-container h2 {
            color: #1e3a8a;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .login-container p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            color: #1e3a8a;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 0;
            border: none;
            border-bottom: 2px solid #cbd5e1;
            background: transparent;
            outline: none;
            transition: 0.3s;
            font-size: 16px;
            color: #334155;
        }

        .input-group input:focus {
            border-bottom: 2px solid #1e3a8a;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #1e3a8a;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: #1d4ed8;
            box-shadow: 0 5px 15px rgba(30, 58, 138, 0.4);
        }

        /* Gaya untuk link Sign Up */
        .signup-link {
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }

        .signup-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 11px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>JAVA ADVENTURE</h2>
    <p>Silakan masuk ke akun Anda</p>
    
    <form action="proses_login.php" method="POST">
        <div class="input-group">
            <label for="username">USERNAME</label>
            <input type="text" name="username" id="username" placeholder="Masukkan username" required>
        </div>
        
        <div class="input-group">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login" class="btn-login">Masuk Sekarang</button>
    </form>

    <div class="signup-link">
        Belum punya akun? <a href="signup.php">Daftar Sekarang</a>
    </div>

    <div class="footer-text">
        © 2026 Java Adventure Project - Exploration Awaits
    </div>
</div>

</body>
</html>