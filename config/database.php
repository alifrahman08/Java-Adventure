<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jawa_adventure";

$koneksi = mysqli_connect($host, $user, $pass, $db);
$koneksi = mysqli_connect("localhost","root","","jawa_adventure");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>