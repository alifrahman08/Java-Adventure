<?php
session_start();
// Memastikan admin sudah login
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembayaran | Java Adventure</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .content {
            background: linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)), 
                        url('https://www.toptal.com/designers/subtlepatterns/patterns/batik.png');
            min-height: 100vh; padding: 20px; margin-left: 260px;
        }
        .form-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); max-width: 600px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #1e3a8a; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; }
        .btn-simpan { background: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
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
    <h2>Tambah Transaksi Pembayaran</h2>
    <div class="form-card">
        <form action="pembayaran_simpan.php" method="POST">
            <div class="form-group">
                <label>Kode Order</label>
                <input type="text" name="kode_pemesanan" placeholder="Contoh: ORD-007" required>
            </div>
            <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" name="nama_pemesan" required>
            </div>
            <div class="form-group">
                <label>Total Harga</label>
                <input type="number" name="total_harga" required>
            </div>
            <div class="form-group">
                <label>Referensi Pembayaran (Opsional)</label>
                <input type="text" name="payment_ref" placeholder="Contoh: TRX-003">
            </div>

            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select name="metode" required>
                    <option value="QRIS">QRIS (Gopay/OVO/Dana)</option>
                    <option value="Transfer">Transfer Bank (BCA/Mandiri)</option>
                    <option value="Tunai">Tunai / Cash</option> </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="pending">PENDING</option>
                    <option value="paid">PAID</option>
                    <option value="failed">FAILED</option>
                </select>
            </div>
            <button type="submit" class="btn-simpan">Simpan Transaksi</button>
            <a href="pembayaran.php" style="margin-left:10px; text-decoration:none; color:#666;">Batal</a>
        </form>
    </div>
</div>
</body>
</html>