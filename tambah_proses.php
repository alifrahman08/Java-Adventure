<?php
include 'config/database.php';

// Menangkap data dari form
$nama_pemesan  = $_POST['nama_pemesan'];
$paket_pilihan = $_POST['paket'];
$tanggal       = $_POST['tanggal'];
$jumlah        = $_POST['jumlah'];

// 1. Ambil harga paket secara otomatis dari database
$query_paket = mysqli_query($koneksi, "SELECT harga FROM paket_wisata WHERE nama_paket = '$paket_pilihan'");
$data_paket  = mysqli_fetch_assoc($query_paket);
$harga_satuan = ($data_paket) ? $data_paket['harga'] : 0;

// 2. Hitung total harga (Harga Paket x Jumlah Orang)
$total_harga = $harga_satuan * $jumlah;

// 3. Simpan ke database
$query_simpan = "INSERT INTO pemesanan (nama_pemesan, paket, tanggal, jumlah, total, status) 
                 VALUES ('$nama_pemesan', '$paket_pilihan', '$tanggal', '$jumlah', '$total_harga', 'Pending')";

$proses = mysqli_query($koneksi, $query_simpan);

if ($proses) {
    header("Location: pemesanan.php?pesan=berhasil");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>