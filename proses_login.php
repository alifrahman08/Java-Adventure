<?php
session_start();
// Menghubungkan ke database
include 'config/database.php';

// Pastikan data dikirim melalui metode POST dari form login
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

// Ambil dan bersihkan data input untuk keamanan
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
// Menggunakan MD5 sesuai dengan skema yang ada di HeidiSQL Anda
$password = md5($_POST['password']);

// Query mencari user di tabel 'users'
$query = mysqli_query($koneksi,
    "SELECT * FROM users 
     WHERE username='$username' 
     AND password='$password'"
);

// Cek apakah data ditemukan
if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    // Set session untuk keamanan akses halaman admin
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id']; // Menyimpan ID user dari database
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role']; // Mengambil role (admin) dari database

    // Jika berhasil, arahkan ke halaman dashboard
    header("Location: admin.php");
    exit;
} else {
    // Jika gagal, munculkan peringatan dan kembali ke login
    echo "<script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>";
}
?>