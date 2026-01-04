<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

include 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: pembayaran.php");
    exit;
}

// Mengambil data pembayaran spesifik berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instruksi Pembayaran | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .content { 
            background: linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)), 
                        url('https://www.toptal.com/designers/subtlepatterns/patterns/batik.png');
            margin-left: 260px; padding: 40px; text-align: center; min-height: 100vh;
        }
        .pay-card { 
            background: white; padding: 30px; border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: inline-block;
            max-width: 500px; width: 100%;
        }
        .qris-img { 
            width: 300px; margin: 20px 0; border: 1px solid #ddd; 
            padding: 10px; background: #fff;
        }
        .bank-info { 
            background: #f1f5f9; padding: 20px; border-radius: 10px; 
            margin-top: 15px; text-align: left; border-left: 5px solid #2563eb;
        }
        .cash-info { 
            background: #fff9db; padding: 20px; border-radius: 10px; 
            margin-top: 15px; text-align: left; border-left: 5px solid #fcc419;
        }
        .order-info { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #ddd; text-align: left; }
        .btn-finish {
            background: #2563eb; color: white; padding: 12px 25px; 
            text-decoration: none; border-radius: 8px; font-weight: bold; 
            display: block; transition: 0.3s; margin-bottom: 10px;
        }
        .btn-finish:hover { background: #1e40af; }
        
        .btn-nota {
            color: #2563eb; text-decoration: none; font-size: 0.9em; font-weight: bold;
        }
        .btn-nota:hover { text-decoration: underline; }
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
        <div class="pay-card">
            <h2 style="color: #1e3a8a; margin-top: 0;">Instruksi Pembayaran</h2>
            
            <div class="order-info">
                <p>Kode Order: <strong><?= $data['kode_pemesanan'] ?></strong></p>
                <p>Nama Pelanggan: <strong><?= $data['nama_pemesan'] ?></strong></p>
                <p>Total Tagihan: <strong style="color: #2563eb; font-size: 1.2em;">Rp <?= number_format($data['total_harga'], 0, ',', '.') ?></strong></p>
                <p>Metode: <strong><?= strtoupper($data['metode']) ?></strong></p>
            </div>
            
            <?php 
            $metode = strtoupper($data['metode']); // Memastikan perbandingan teks akurat
            
            if($metode == 'QRIS'): ?>
                <h3 style="margin-bottom: 5px;">Scan QRIS di Bawah Ini:</h3>
                <?php 
                $path_qris = "assets/img/qris-coilrakyat.jpg";
                if (file_exists($path_qris)): ?>
                    <img src="<?= $path_qris ?>" class="qris-img" alt="QRIS Coilrakyat Malang">
                <?php else: ?>
                    <div style="color: red; padding: 20px; border: 1px dashed red; margin: 10px;">
                        ⚠️ File gambar QRIS tidak ditemukan di folder assets/img/.
                    </div>
                <?php endif; ?>
                <p style="font-size: 0.9em; color: #64748b;">Mendukung: Dana, OVO, Gopay, LinkAja, & Mobile Banking</p>

            <?php elseif($metode == 'TUNAI'): ?>
                <div class="cash-info">
                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #856404;">💵 Instruksi Bayar Tunai:</p>
                    <p>Silakan melakukan pembayaran langsung secara tunai (cash) kepada petugas di kantor <strong>Java Adventure</strong> atau melalui pemandu wisata Anda.</p>
                    <p>Pastikan Anda menerima nota bukti pembayaran fisik setelah transaksi selesai.</p>
                </div>

            <?php else: ?>
                <div class="bank-info">
                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #1e3a8a;">Transfer Bank Manual:</p>
                    <strong>SEA BANK</strong><br>
                    No. Rekening: <span style="font-size: 1.1em; color: #2563eb;">901714025032</span><br>
                    Atas Nama: <strong>Java Adventure Indonesia</strong>
                </div>
            <?php endif; ?>

            <div style="margin-top: 30px;">
                <a href="pembayaran.php" class="btn-finish">Selesai & Cek Status</a>
                
                <a href="pembayaran_nota.php?id=<?= $data['id'] ?>" target="_blank" class="btn-nota">
                   📄 Lihat Nota Bukti Pembayaran
                </a>
            </div>
        </div>
    </div>
</body>
</html>