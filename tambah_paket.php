<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Paket Wisata | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">

    <style>
        .form-box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 600px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .form-box input,
        .form-box textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-box button {
            padding: 10px 16px;
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        .form-box a {
            margin-left: 10px;
            text-decoration: none;
            color: #2563eb;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php" class="active">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="pengguna.php">👤 Pengguna</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">

    <div class="topbar">
        <b>Tambah Paket Wisata</b>
    </div>

    <div class="form-box">
        <form method="post" action="paket_simpan.php">

            <label>Nama Paket</label>
            <input type="text" name="nama" required>

            <label>Lokasi</label>
            <input type="text" name="lokasi" required>

            <label>Harga</label>
            <input type="number" name="harga" required>

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"></textarea>

            <button type="submit">💾 Simpan</button>
            <a href="paket.php">Kembali</a>
        </form>
    </div>

</div>

</body>
</html>
