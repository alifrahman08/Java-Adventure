<?php
session_start();
// Proteksi halaman agar hanya admin yang bisa mengakses
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

include 'config/database.php';

// Mengambil ID dari URL
$id = $_GET['id'];

// Mengambil data paket berdasarkan ID
$data = mysqli_query($koneksi, "SELECT * FROM paket_wisata WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Jika data tidak ditemukan
if (!$row) {
    echo "Data paket tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Paket Wisata | Jawa Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Menggunakan tema yang sama dengan pemesanan_edit */
        .content {
            background: linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)), 
                        url('https://www.toptal.com/designers/subtlepatterns/patterns/batik.png');
            min-height: 100vh;
            padding: 20px;
            margin-left: 260px; /* Menyesuaikan dengan lebar sidebar */
        }
        
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .form-group { 
            margin-bottom: 20px; 
        }

        .form-group label { 
            display: block; 
            font-weight: bold; 
            margin-bottom: 8px; 
            color: #1e3a8a; 
        }

        .form-group input, .form-group textarea { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #cbd5e1; 
            border-radius: 8px; 
            font-family: inherit;
        }

        .form-group textarea { 
            height: 100px; 
            resize: vertical; 
        }

        .btn-update { 
            background: #f59e0b; 
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: bold; 
            transition: 0.3s;
        }

        .btn-update:hover { 
            background: #d97706; 
            transform: translateY(-2px);
        }

        .btn-batal {
            margin-left: 15px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php" class="active">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2 style="color: #1e3a8a; margin-bottom: 20px;">Edit Paket Wisata</h2>
    
    <div class="form-card">
        <form action="paket_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="form-group">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" value="<?= $row['nama_paket'] ?>" required>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" value="<?= $row['lokasi'] ?>" required>
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" value="<?= $row['harga'] ?>" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Paket</label>
                <textarea name="deskripsi" required><?= $row['deskripsi'] ?></textarea>
            </div>

            <button type="submit" class="btn-update">Update Data Paket</button>
            <a href="paket.php" class="btn-batal">Batal</a>
        </form>
    </div>
</div>

</body>
</html>