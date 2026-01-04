<?php
session_start();
// Pastikan hanya admin yang login yang bisa menghapus
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config/database.php';

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data pemesanan berdasarkan ID
    $query = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id = '$id'");

    if ($query) {
        // Jika berhasil, kembali ke halaman pemesanan dengan pesan sukses
        header("Location: pemesanan.php?hapus=berhasil");
    } else {
        // Jika gagal, tampilkan pesan error database
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada ID di URL, kembali ke halaman utama
    header("Location: pemesanan.php");
}
?>