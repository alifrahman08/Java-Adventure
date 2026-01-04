<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'config/database.php';

// Ambil data pembayaran dari database
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pembayaran | Jawa Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .content {
            background: linear-gradient(rgba(248, 250, 252, 0.95), rgba(248, 250, 252, 0.95)), 
                        url('https://www.toptal.com/designers/subtlepatterns/patterns/batik.png');
            min-height: 100vh;
            padding: 20px;
            margin-left: 260px;
        }
        
        /* Gaya Kartu Tabel agar melayang */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #2563eb; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #f1f5f9; }

        /* Gaya Tombol Tambah */
        .btn-tambah {
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-tambah:hover { background: #1d4ed8; transform: translateY(-2px); }

        /* Badge Status */
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .paid { background: #dcfce7; color: #166534; }
        .pending { background: #fef9c3; color: #854d0e; }
        .failed { background: #fee2e2; color: #991b1b; }

        .btn-hapus { color: #ef4444; text-decoration: none; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="pembayaran.php" class="active">💳 Pembayaran</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2 style="color: #1e3a8a; margin-bottom: 20px;">Data Transaksi Pembayaran</h2>
    
    <a href="pembayaran_tambah.php" class="btn-tambah">+ Tambah Transaksi</a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Order</th>
                    <th>Nama Pemesan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $row['kode_pemesanan'] ?></strong></td>
                    <td><?= $row['nama_pemesan'] ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                    <td>
                        <span class="badge <?= $row['status'] ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="pembayaran_hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Hapus data transaksi ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>