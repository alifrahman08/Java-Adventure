<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'config/database.php';

// Ambil data paket untuk pilihan dropdown
$query_paket = mysqli_query($koneksi, "SELECT * FROM paket_wisata");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemesanan | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f1f5f9; margin: 0; }
        .sidebar { width: 220px; background: #1e293b; position: fixed; top: 0; bottom: 0; padding: 20px; }
        .sidebar a { display: block; color: #cbd5e1; padding: 12px; text-decoration: none; border-radius: 6px; }
        .sidebar a.active { background: #2563eb; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        .form-card { background: white; padding: 25px; border-radius: 10px; max-width: 600px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { background: #22c55e; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 style="color:white; text-align:center;">Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php">🏕️ Paket Wisata</a>
    <a href="pemesanan.php" class="active">📋 Pemesanan</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2>Form Tambah Pemesanan</h2>
    <div class="form-card">
        <form action="tambah_proses.php" method="POST">
            <div class="form-group">
                <label>Nama Pemesan:</label>
                <input type="text" name="nama_pemesan" required>
            </div>
            <div class="form-group">
                <label>Paket Wisata:</label>
                <select name="paket" required>
                    <option value="">-- Pilih Paket --</option>
                    <?php while($row = mysqli_fetch_assoc($query_paket)) : ?>
                        <option value="<?= $row['nama_paket']; ?>">
                            <?= $row['nama_paket']; ?> (Rp <?= number_format($row['harga']); ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>Jumlah Orang:</label>
                <input type="number" name="jumlah" required>
            </div>
            
            <button type="submit" class="btn-submit">Simpan Pesanan</button>
            <a href="pemesanan.php" style="margin-left:10px; color:gray; text-decoration:none;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>