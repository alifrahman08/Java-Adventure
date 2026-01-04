<?php
session_start();
// Proteksi halaman
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}
include 'config/database.php';

// Ambil data paket untuk pilihan dropdown termasuk deskripsi
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
        .sidebar h2 { color:white; text-align:center; margin-bottom: 30px; }
        .sidebar a { display: block; color: #cbd5e1; padding: 12px; text-decoration: none; border-radius: 6px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: #2563eb; color: #fff; }
        .content { margin-left: 260px; padding: 30px; }
        .form-card { background: white; padding: 25px; border-radius: 10px; max-width: 600px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 8px; color: #1e293b; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        
        /* Gaya untuk kotak info deskripsi */
        .info-box { background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px dashed #2563eb; margin-top: 10px; }
        .info-box label { color: #2563eb; font-size: 14px; display: flex; align-items: center; gap: 5px; }
        #info_deskripsi { color: #475569; font-size: 13.5px; line-height: 1.5; margin-top: 5px; }
        
        .btn-submit { background: #22c55e; color: white; padding: 12px 25px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .btn-submit:hover { background: #16a34a; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php">🏕️ Paket Wisata</a>
    <a href="pemesanan.php" class="active">📋 Pemesanan</a>
    <a href="pembayaran.php">💳 Pembayaran</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2 style="color: #1e293b;">Form Tambah Pemesanan</h2>
    
    <div class="form-card">
        <form action="tambah_proses.php" method="POST">
            <div class="form-group">
                <label>Nama Pemesan:</label>
                <input type="text" name="nama_pemesan" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label>Pilih Paket Wisata:</label>
                <select name="paket" id="pilih_paket" onchange="updateDetail()" required>
                    <option value="">-- Pilih Paket --</option>
                    <?php while($row = mysqli_fetch_assoc($query_paket)) : ?>
                        <option value="<?= $row['nama_paket']; ?>" 
                                data-deskripsi="<?= htmlspecialchars($row['deskripsi']); ?>" 
                                data-harga="<?= number_format($row['harga'], 0, ',', '.'); ?>">
                            <?= $row['nama_paket']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <div class="info-box">
                    <label>📝 Detail Fasilitas & Harga:</label>
                    <div id="info_deskripsi">
                        <i>Pilih paket untuk melihat detail informasi...</i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Tanggal Keberangkatan:</label>
                <input type="date" name="tanggal" required>
            </div>

            <div class="form-group">
                <label>Jumlah Peserta (Orang):</label>
                <input type="number" name="jumlah" min="1" placeholder="0" required>
            </div>
            
            <div style="margin-top: 30px;">
                <button type="submit" class="btn-submit">✅ Simpan Pesanan</button>
                <a href="pemesanan.php" style="margin-left:15px; color:#64748b; text-decoration:none; font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function updateDetail() {
    var select = document.getElementById("pilih_paket");
    var infoBox = document.getElementById("info_deskripsi");
    
    // Ambil data dari atribut option yang dipilih
    var selectedOption = select.options[select.selectedIndex];
    var deskripsi = selectedOption.getAttribute("data-deskripsi");
    var harga = selectedOption.getAttribute("data-harga");
    
    if (deskripsi) {
        infoBox.innerHTML = "<strong>Harga:</strong> Rp " + harga + "<br><br>" + 
                            "<strong>Fasilitas:</strong><br>" + deskripsi;
    } else {
        infoBox.innerHTML = "<i>Pilih paket untuk melihat detail informasi...</i>";
    }
}
</script>

</body>
</html>