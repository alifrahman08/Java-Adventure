<?php
// Menghubungkan ke database
include 'config/database.php';

// Menangkap data dari form signup
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];

// 1. Validasi: Pastikan password dan konfirmasi password sama
if ($password !== $confirm) {
    echo "<script>alert('Password tidak sama!'); window.location='signup.php';</script>";
    exit;
}

// 2. Cek apakah username sudah ada di tabel users
// Kita menggunakan tabel 'users' karena tabel 'admin' tidak ditemukan di database Anda
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah digunakan! Silakan gunakan nama lain.'); window.location='signup.php';</script>";
} else {
    // 3. Simpan ke database menggunakan enkripsi MD5 sesuai standar tabel Anda
    // Menambahkan kolom 'role' secara otomatis sebagai 'admin'
    $password_enkripsi = md5($password);
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password_enkripsi', 'admin')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Berhasil Daftar! Silakan Login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>