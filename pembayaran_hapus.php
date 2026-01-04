<?php
session_start();
// Memastikan hanya admin yang login yang bisa menghapus data
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config/database.php';

// Mengambil ID pembayaran dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data dari tabel pembayaran berdasarkan ID
    $query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id = '$id'");

    if ($query) {
        // Jika berhasil, kembali ke halaman pembayaran dengan notifikasi
        header("Location: pembayaran.php?pesan=hapus_berhasil");
    } else {
        // Jika gagal, tampilkan pesan error dari database
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada ID yang dikirim, kembali ke halaman pembayaran
    header("Location: pembayaran.php");
}
?>