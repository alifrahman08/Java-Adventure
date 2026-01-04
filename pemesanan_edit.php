<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'config/database.php';
$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id = '$id'"));
$query_paket = mysqli_query($koneksi, "SELECT * FROM paket_wisata");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pemesanan</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: sans-serif; background: #f1f5f9; margin: 0; }
        .content { margin-left: 260px; padding: 30px; }
        .form-card { background: white; padding: 25px; border-radius: 10px; max-width: 500px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .btn-save { background: #f59e0b; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
<div class="content">
    <h2>Edit Data Pemesanan</h2>
    <div class="form-card">
        <form action="pemesanan_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pemesan" value="<?= $p['nama_pemesan'] ?>" required>
            </div>
            <div class="form-group">
                <label>Paket Wisata</label>
                <select name="paket" required>
                    <?php while($rp = mysqli_fetch_assoc($query_paket)) { ?>
                        <option value="<?= $rp['nama_paket'] ?>" <?= ($p['paket'] == $rp['nama_paket']) ? 'selected' : '' ?>>
                            <?= $rp['nama_paket'] ?> (Rp <?= number_format($rp['harga']) ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= $p['tanggal'] ?>" required>
            </div>
            <div class="form-group">
                <label>Jumlah Orang</label>
                <input type="number" name="jumlah" value="<?= $p['jumlah'] ?>" required>
            </div>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="pemesanan.php" style="margin-left: 10px; text-decoration: none; color: gray;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>