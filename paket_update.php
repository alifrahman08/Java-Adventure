<?php
include 'config/database.php';

$id = $_POST['id'];
$nama = $_POST['nama_paket'];
$lokasi = $_POST['lokasi'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

$query = mysqli_query($koneksi, "UPDATE paket_wisata SET 
    nama_paket='$nama', 
    lokasi='$lokasi', 
    harga='$harga', 
    deskripsi='$deskripsi' 
    WHERE id='$id'");

if ($query) {
    header("Location: paket.php?pesan=diupdate");
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>