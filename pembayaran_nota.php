<?php
session_start();
// Memastikan hanya admin yang sudah login bisa mengakses
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

include 'config/database.php';

// Mengambil ID pembayaran dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) { 
    echo "Data tidak ditemukan!"; 
    exit; 
}

// Mengatur zona waktu agar jam otomatis sesuai dengan lokasi transaksi (WIB)
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran - <?= $data['kode_pemesanan'] ?></title>
    <style>
        /* Desain tampilan nota agar terlihat profesional saat dicetak */
        body { font-family: 'Courier New', Courier, monospace; color: #333; background: #eee; padding: 20px; }
        .nota-box { 
            background: #fff; width: 400px; margin: auto; padding: 20px; 
            border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        .header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; color: #1e3a8a; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .total { border-top: 2px dashed #333; margin-top: 15px; padding-top: 10px; font-weight: bold; font-size: 18px; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; font-style: italic; }
        
        /* Gaya tombol navigasi */
        .btn-print { 
            display: block; width: 100%; padding: 10px; background: #2563eb; 
            color: white; text-align: center; text-decoration: none; 
            margin-top: 20px; border-radius: 5px; box-sizing: border-box;
        }
        
        /* Perintah khusus saat mencetak: Sembunyikan tombol agar tidak ikut terprint */
        @media print { 
            .btn-print, .btn-back { display: none; } 
            body { background: white; padding: 0; } 
            .nota-box { box-shadow: none; border: none; width: 100%; margin: 0; } 
        }
    </style>
</head>
<body>

<div class="nota-box">
    <div class="header">
        <h2>JAVA ADVENTURE</h2>
        <small>Malang, Jawa Timur</small><br>
        <small>Tanggal: <?= date('d/m/Y H:i') ?> WIB</small>
    </div>

    <div class="info-row">
        <span>Kode Order:</span>
        <strong><?= $data['kode_pemesanan'] ?></strong>
    </div>
    <div class="info-row">
        <span>Pelanggan:</span>
        <span><?= $data['nama_pemesan'] ?></span>
    </div>
    <div class="info-row">
        <span>Metode:</span>
        <span><?= strtoupper($data['metode']) ?></span>
    </div>
    <div class="info-row">
        <span>Status:</span>
        <span style="color: green; font-weight: bold;"><?= strtoupper($data['status']) ?></span>
    </div>

    <div class="total">
        <span>TOTAL:</span>
        <span>Rp <?= number_format($data['total_harga'], 0, ',', '.') ?></span>
    </div>

    <div class="footer">
        <p>Terima kasih telah berpetualang bersama kami!</p>
        <p>Semoga Perjalanan Anda Menyenangkan, Selamata datang kembali</p>
        <p>Simpan nota ini sebagai bukti transaksi sah.</p>
    </div>

    <a href="#" class="btn-print" onclick="window.print()">Cetak / Simpan PDF</a>
    <a href="pembayaran.php" class="btn-print btn-back" style="background: #666;">Kembali</a>
</div>

</body>
</html>