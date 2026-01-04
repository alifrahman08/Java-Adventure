<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'config/database.php';
$data = mysqli_query($koneksi, "SELECT * FROM pemesanan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemesanan | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f1f5f9; margin: 0; }
        .sidebar { width: 220px; background: #1e293b; position: fixed; top: 0; bottom: 0; padding: 20px; }
        .sidebar a { display: block; color: #cbd5e1; padding: 12px; text-decoration: none; border-radius: 6px; }
        .sidebar a.active { background: #2563eb; color: #fff; }
        .content { margin-left: 260px; padding: 25px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th { background: #2563eb; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .btn-edit { background: #f59e0b; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
        .btn-hapus { background: #ef4444; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
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
    <h2>Data Pemesanan</h2>
    <a href="tambah_pemesanan.php" style="background: #2563eb; color: white; padding: 10px; text-decoration: none; border-radius: 6px; display: inline-block; margin-bottom: 20px;">+ Tambah Pesanan</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Paket Wisata</th> 
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while($p = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><b><?= $p['nama_pemesan'] ?></b></td>
                <td><?= $p['paket'] ?></td>
                <td><?= $p['tanggal'] ?></td>
                <td><?= $p['jumlah'] ?> Orang</td>
                <td><?= $p['status'] ?></td>
                <td>
                    <a href="pemesanan_edit.php?id=<?= $p['id'] ?>" class="btn-edit">Edit</a>
                    <a href="pemesanan_hapus.php?id=<?= $p['id'] ?>" class="btn-hapus" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>