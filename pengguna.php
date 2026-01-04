<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pengguna</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="sidebar">
    <h2>Java Adventure</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="paket.php">🏕️ Paket Wisata</a>
    <a href="pemesanan.php">📋 Pemesanan</a>
    <a href="pengguna.php" class="active">👤 Pengguna</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2>Manajemen Pengguna</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
        </tr>

        <?php $no=1; while($u=mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $u['username'] ?></td>
            <td><?= $u['role'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
