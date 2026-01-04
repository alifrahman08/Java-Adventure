<?php
include 'config/database.php';

$nama = $_POST['nama_pemesan'];
$paket = $_POST['paket'];
$tgl = $_POST['tanggal'];
$jml = $_POST['jumlah'];
$total = $_POST['total'];
$status = "Menunggu"; // Status default

$query = mysqli_query($koneksi, "INSERT INTO pemesanan (nama_pemesan, paket, tanggal, jumlah, total, status) 
VALUES ('$nama', '$paket', '$tgl', '$jml', '$total', '$status')");

if ($query) {
    header("Location: pemesanan.php?status=success");
} else {
    echo "Gagal menyimpan: " . mysqli_error($koneksi);
}
?>