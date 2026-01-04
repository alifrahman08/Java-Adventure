<?php
include 'config/database.php';

// Mengambil data dari form edit
$id             = $_POST['id'];
$nama_pemesan   = $_POST['nama_pemesan'];
$paket_pilihan  = $_POST['paket'];
$tanggal        = $_POST['tanggal'];
$jumlah         = $_POST['jumlah'];

// 1. Ambil harga paket dari tabel paket_wisata secara otomatis
// Kita mencari kolom 'harga' berdasarkan nama paket yang dipilih admin.
$query_paket = mysqli_query($koneksi, "SELECT harga FROM paket_wisata WHERE nama_paket = '$paket_pilihan'");
$data_paket  = mysqli_fetch_assoc($query_paket);

// Validasi jika paket ditemukan, ambil harganya. Jika tidak, set ke 0.
if ($data_paket) {
    $harga_satuan = $data_paket['harga'];
} else {
    $harga_satuan = 0;
}

// 2. Hitung Total Harga secara otomatis (Harga Paket x Jumlah Orang)
$total_harga = $harga_satuan * $jumlah;

// 3. Jalankan query UPDATE ke database
// Variabel $total_harga hasil hitungan di atas digunakan untuk mengisi kolom 'total'.
$query_update = "UPDATE pemesanan SET 
                 nama_pemesan = '$nama_pemesan',
                 paket        = '$paket_pilihan',
                 tanggal      = '$tanggal',
                 jumlah       = '$jumlah',
                 total        = '$total_harga' 
                 WHERE id     = '$id'"; 
// Pastikan tidak ada koma setelah '$total_harga' sebelum kata WHERE

$simpan = mysqli_query($koneksi, $query_update);

// Cek keberhasilan proses update
if ($simpan) {
    // Jika berhasil, kembali ke halaman daftar pemesanan
    header("Location: pemesanan.php?pesan=update_berhasil");
} else {
    // Jika gagal, tampilkan pesan error dari database
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}
?>