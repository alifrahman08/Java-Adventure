<?php
session_start();
// Cek login agar keamanan terjaga
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config/database.php';
// Mengambil data dari tabel paket_wisata
$data = mysqli_query($koneksi, "SELECT * FROM paket_wisata");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Paket Wisata | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Tambahan style agar tombol aksi terlihat lebih rapi */
        .btn-edit {
            background-color: #f59e0b;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }
        .btn-hapus {
            background-color: #ef4444;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #2563eb;
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php" class="active">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="pembayaran.php">💳 Pembayaran</a> <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <div class="topbar" style="background: white; padding: 15px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <b style="font-size: 1.2em; color: #1e3a8a;">Data Paket Wisata</b>
    </div>

    <a href="tambah_paket.php" class="btn" style="background: #2563eb; color: white; padding: 10px 15px; text-decoration: none; border-radius: 6px; display: inline-block; margin-bottom: 20px; font-weight: bold;">+ Tambah Paket</a>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Lokasi</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                // Perulangan data membungkus seluruh baris <tr>
                while($row = mysqli_fetch_assoc($data)) { 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_paket'] ?></td>
                    <td><?= $row['lokasi'] ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td>
                        <a href="paket_edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a> 
                        <a href="paket_hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>