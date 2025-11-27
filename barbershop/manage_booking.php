<?php
session_start();
include 'koneksi.php';

// Cek login & level admin
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php");
    exit();
}

// Hapus booking jika diminta
if(isset($_GET['hapus_id'])){
    $id = intval($_GET['hapus_id']);
    mysqli_query($koneksi,"DELETE FROM bookings WHERE id=$id");
    header("Location: manage_booking.php");
    exit();
}

// Ambil semua data booking
$result = mysqli_query($koneksi, "SELECT * FROM bookings ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Booking Admin</title>
<style>
/* ===== Reset & Body ===== */
body {
    margin:0;
    font-family: Arial, sans-serif;
    background:#0b0c10; /* hitam gelap */
    color:#fff;
}

/* ===== Sidebar ===== */
.sidebar {
    width:230px;
    height:100vh;
    position:fixed;
    background:#1f2833; /* biru navy gelap */
    padding-top:20px;
}
.sidebar h2 {
    text-align:center;
    color:#66fcf1; /* biru terang */
    margin-bottom:30px;
}
.sidebar a {
    display:block;
    padding:15px 20px;
    color:#fff;
    text-decoration:none;
    border-left:3px solid transparent;
    transition:0.3s;
}
.sidebar a:hover {
    background:#0b0c10;
    border-left:3px solid rgba(27, 26, 27, 0.93);
}

/* ===== Content ===== */
.content {
    margin-left:250px;
    padding:25px;
}
.content h1 {
    color:#66fcf1;
}

/* ===== Card Table ===== */
.card {
    background:#1c1c1c; /* hitam lebih terang */
    padding:20px;
    border-radius:10px;
    margin-top:20px;
    box-shadow:0 0 10px rgba(0,0,0,.5);
}
table {
    width:100%;
    border-collapse:collapse;
}
th, td {
    padding:12px;
    border:1px solid #111010ff;
    text-align:center;
}
th {
    background:#0b3d91; /* biru navy */
}
tr:hover {
    background:#0b0c10;
}

/* ===== Buttons ===== */
.button {
    padding:6px 12px;
    border-radius:5px;
    text-decoration:none;
    color:white;
    font-weight:bold;
    transition:0.3s;
}
.edit {
    background:#1f3a93;
}
.edit:hover {
    background:#3b59c5;
}
.hapus {
    background:#c70039;
}
.hapus:hover {
    background:#ff073a;
}
</style>
</head>
<body>

<div class="sidebar">
    <h2>Barbershop Admin</h2>
    <a href="dashboard_admin.php">Dashboard</a>
    <a href="manage_users.php">Manajemen User</a>
    <a href="manage_services.php">Manajemen Layanan</a>
    <a href="manage_booking.php">Data Booking</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Data Booking</h1>

    <div class="card">
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Customer</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while($b = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $b['id'] ?></td>
                <td><?= htmlspecialchars($b['nama_customer']) ?></td>
                <td><?= htmlspecialchars($b['layanan']) ?></td>
                <td><?= $b['tanggal'] ?></td>
                <td><?= $b['jam'] ?></td>
                <td><?= ucfirst($b['status']) ?></td>
                <td>
                    <a class="button edit" href="edit_booking.php?id=<?= $b['id'] ?>">Edit</a>
                    <a class="button hapus" href="?hapus_id=<?= $b['id'] ?>" onclick="return confirm('Hapus booking ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile ?>
        </table>
    </div>
</div>

</body>
</html>
