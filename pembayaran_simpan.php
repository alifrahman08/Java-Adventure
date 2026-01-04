<?php
session_start();
// Proteksi agar hanya admin yang login yang bisa menambah transaksi
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}

include 'config/database.php';

// Menangkap data dari form pembayaran_tambah.php
$kode   = $_POST['kode_pemesanan'];
$nama   = $_POST['nama_pemesan'];
$total  = $_POST['total_harga'];
$ref    = $_POST['payment_ref'];
$status = $_POST['status'];
$metode = $_POST['metode']; // Menangkap metode baru: QRIS atau Transfer

// Query Insert ke tabel pembayaran sesuai struktur database
$query = mysqli_query($koneksi, "INSERT INTO pembayaran 
    (kode_pemesanan, nama_pemesan, total_harga, status, payment_ref, metode) 
    VALUES ('$kode', '$nama', '$total', '$status', '$ref', '$metode')");

if ($query) {
    // Mengambil ID yang baru saja dibuat untuk ditampilkan di halaman detail
    $last_id = mysqli_insert_id($koneksi);
    
    // Alihkan ke halaman detail pembayaran untuk menunjukkan QRIS/No Rekening
    header("Location: pembayaran_detail.php?id=$last_id");
} else {
    // Jika gagal, tampilkan error database
    echo "Gagal menambah data: " . mysqli_error($koneksi);
}
?>