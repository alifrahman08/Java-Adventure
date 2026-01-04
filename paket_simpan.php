<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config/database.php';

$nama = $_POST['nama'];
$lokasi = $_POST['lokasi'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

$query = mysqli_query($koneksi, "
    INSERT INTO paket_wisata (nama_paket, lokasi, harga, deskripsi)
    VALUES ('$nama', '$lokasi', '$harga', '$deskripsi')
");

if ($query) {
    header("Location: paket.php?status=success");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
