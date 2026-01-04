<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | Java Adventure</title>
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: sans-serif;
        }
        .card {
            background: white; padding: 40px; border-radius: 15px; width: 350px; text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .btn {
            background: #1e3a8a; color: white; border: none; padding: 12px; width: 100%;
            border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 20px;
        }
        input { width: 100%; padding: 10px 0; margin-bottom: 20px; border: none; border-bottom: 1px solid #ddd; outline: none; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="color: #1e3a8a;">JAVA ADVENTURE</h2>
        <p style="color: #64748b; font-size: 0.9em;">Buat akun petualangan Anda</p>
        
        <form action="signup_proses.php" method="POST">
            <input type="text" name="username" placeholder="Buat Username" required>
            <input type="password" name="password" placeholder="Buat Password" required>
            <input type="password" name="confirm_password" placeholder="Ulangi Password" required>
            <button type="submit" class="btn">DAFTAR SEKARANG</button>
        </form>
        
        <p style="font-size: 0.8em; margin-top: 20px;">Sudah punya akun? <a href="login.php" style="color: #1e3a8a;">Login</a></p>
    </div>
</body>
</html>