<?php
session_start();

// 1. Proteksi Halaman: Pastikan user login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// 2. Koneksi Database
include 'config/database.php'; 

// 3. Statistik Dashboard: Mengambil jumlah data dari setiap tabel
$q_paket      = mysqli_query($koneksi, "SELECT id FROM paket_wisata");
$q_pemesanan  = mysqli_query($koneksi, "SELECT id FROM pemesanan");
$q_users      = mysqli_query($koneksi, "SELECT id FROM users");
$q_pembayaran = mysqli_query($koneksi, "SELECT id FROM pembayaran");

$paket      = mysqli_num_rows($q_paket);
$pemesanan  = mysqli_num_rows($q_pemesanan);
$users      = mysqli_num_rows($q_users);
$pembayaran = mysqli_num_rows($q_pembayaran);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f1f5f9; margin: 0; }
        .sidebar { width: 220px; background: #1e293b; position: fixed; top: 0; bottom: 0; padding: 20px; }
        .sidebar h2 { color: #fff; text-align: center; letter-spacing: 1px; margin-bottom: 30px; }
        .sidebar a { display: block; color: #cbd5e1; padding: 12px; text-decoration: none; border-radius: 6px; margin-bottom: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #2563eb; color: #fff; }
        .content { margin-left: 260px; padding: 25px; }
        .topbar { background: #fff; padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 2px 6px rgba(0,0,0,.05); display: flex; justify-content: space-between; align-items: center; }
        .cards-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .card-stat { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,.05); cursor: pointer; transition: .3s; border-left: 5px solid #2563eb; }
        .card-stat:hover { transform: translateY(-5px); background: #eff6ff; }
        .card-stat h3 { margin: 0; color: #64748b; font-size: 13px; text-transform: uppercase; }
        .card-stat h1 { font-size: 32px; margin: 10px 0; color: #1e293b; }
        .card-stat p { color: #94a3b8; font-size: 12px; margin: 0; }
        .photo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .photo-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: 0.3s; }
        .photo-card:hover { transform: translateY(-8px); }
        .photo-card img { width: 100%; height: 180px; object-fit: cover; }
        .no-image { height: 180px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; text-align: center; }
        .photo-info { padding: 15px; }
        .photo-info h4 { margin: 0; color: #1e3a8a; font-size: 18px; }
        .photo-info p { margin: 5px 0; color: #64748b; font-size: 14px; }
        .price { color: #2563eb; font-weight: bold; font-size: 16px; display: block; margin-top: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php" class="active">🏠 Dashboard</a>
    <a href="paket.php">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="pembayaran.php">💳 Pembayaran</a>
    <a href="pengguna.php">👤 Pengguna</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <div class="topbar">
        <span>Selamat datang, <b><?= htmlspecialchars($_SESSION['username']); ?></b></span>
        <span style="font-size: 12px; color: #94a3b8;"><?= date('d F Y'); ?></span>
    </div>

    <h2 style="color: #1e293b; margin-bottom: 20px;">Dashboard Overview</h2>

    <div class="cards-stats">
        <div class="card-stat" onclick="location.href='pembayaran.php'">
            <h3>Pembayaran</h3>
            <h1><?= $pembayaran ?></h1>
            <p>Total transaksi masuk</p>
        </div>
        <div class="card-stat" onclick="location.href='paket.php'">
            <h3>Paket Wisata</h3>
            <h1><?= $paket ?></h1>
            <p>Destinasi tersedia</p>
        </div>
        <div class="card-stat" onclick="location.href='pemesanan.php'">
            <h3>Pemesanan</h3>
            <h1><?= $pemesanan ?></h1>
            <p>Booking aktif</p>
        </div>
        <div class="card-stat" onclick="location.href='pengguna.php'">
            <h3>Pengguna</h3>
            <h1><?= $users ?></h1>
            <p>Akun terdaftar</p>
        </div>
    </div>

    <h3 style="color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">📸 Destinasi Terpopuler</h3>
    <div class="photo-grid">
        <?php
        // Mengambil data paket wisata
        $query_wisata = mysqli_query($koneksi, "SELECT * FROM paket_wisata LIMIT 6");
        while($wisata = mysqli_fetch_assoc($query_wisata)) :
            // Path gambar sesuai struktur assets/img/paket/
            $file_gambar = "assets/img/paket/" . $wisata['gambar'];
        ?>
        <div class="photo-card">
            <?php if (!empty($wisata['gambar']) && file_exists($file_gambar)): ?>
                <img src="<?= $file_gambar ?>" alt="<?= htmlspecialchars($wisata['nama_paket']) ?>">
            <?php else: ?>
                <div class="no-image">
                    <div>
                        <span style="font-size: 24px;">🌅</span><br>
                        Foto Belum Tersedia
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="photo-info">
                <h4><?= htmlspecialchars($wisata['nama_paket']) ?></h4>
                <p>📍 <?= htmlspecialchars($wisata['lokasi']) ?></p>
                <span class="price">Rp <?= number_format($wisata['harga'], 0, ',', '.') ?></span>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>