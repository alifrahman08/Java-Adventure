<?php
include 'config/database.php';
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM paket_wisata WHERE id='$id'");

if ($query) {
    header("Location: paket.php?pesan=terhapus");
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>