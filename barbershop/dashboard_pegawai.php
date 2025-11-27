<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'pegawai'){
    header("Location: login.php");
    exit();
}

// Handle tambah booking
if(isset($_POST['tambah_booking'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $layanan = mysqli_real_escape_string($koneksi, $_POST['layanan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);

    mysqli_query($koneksi, "INSERT INTO booking (nama_pelanggan, layanan, tanggal, jam) VALUES ('$nama','$layanan','$tanggal','$jam')");
    // redirect untuk mencegah form resubmission
    header("Location: pegawai.php");
    exit();
}

// Ambil data booking terbaru
$booking = mysqli_query($koneksi, "SELECT * FROM booking ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pegawai - Barbershop</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin:0;
    background:#121212;
    color:#EAEAEA;
}

/* Navbar */
nav {
    background:#0A0A0A;
    padding:15px;
    display:flex;
    justify-content:flex-start;
    gap:15px;
    border-bottom:3px solid #161616ff;
}
nav a {
    text-decoration:none;
    color:#EAEAEA;
    padding:8px 12px;
    border-radius:5px;
    background:#1F3A93;
    transition:0.3s;
}
nav a:hover {
    background:#3C6FFF;
}

/* Header */
h1 {
    text-align:center;
    color:#3C6FFF;
    margin:20px 0;
}

/* Cards */
.card {
    background:#1E1E1E;
    padding:20px;
    border-radius:10px;
    margin:20px auto;
    box-shadow:0 0 10px rgba(0,0,0,0.3);
    max-width:900px;
}

/* Form */
form label {
    display:block;
    margin:10px 0 5px;
}
form input, form select {
    width:100%;
    padding:10px;
    border-radius:5px;
    border:1px solid #2A2A2A;
    background:#121212;
    color:#EAEAEA;
}
form input[type="submit"] {
    background:#3C6FFF;
    color:white;
    border:none;
    cursor:pointer;
    margin-top:10px;
    transition:0.3s;
}
form input[type="submit"]:hover {
    background:#2A5FD0;
}

/* Table */
table {
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}
th, td {
    padding:12px;
    border:1px solid #2A2A2A;
    text-align:left;
}
th {
    background:#1F3A93;
    color:#EAEAEA;
}
tr:hover {
    background:#1F1F1F;
}
</style>
</head>
<body>

<nav>
    <a href="pegawai.php">Home</a>
    <a href="logout.php">Logout</a>
    <a href="cetak1.php" target="_BLANK">TES PRINT</a>

</nav>

<h1>Dashboard Pegawai - Barbershop</h1>

<div class="card">
    <h2>Tambah Booking Baru</h2>
    <form method="post" action="">
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Layanan:</label>
        <select name="layanan" required>
            <option value="">-- Pilih Layanan --</option>
            <option value="Potong Rambut Pria - Rp 50.000">Potong Rambut Pria - Rp 50.000</option>
            <option value="Cukur Kumis & Jenggot - Rp 25.000">Cukur Kumis & Jenggot - Rp 25.000</option>
            <option value="Hair Wash + Creambath - Rp 30.000">Hair Wash + Creambath - Rp 30.000</option>
            <option value="Potong Anak-Anak - Rp 40.000">Potong Anak-Anak - Rp 40.000</option>
            <option value="Coloring Rambut Pria - Rp 100.000">Coloring Rambut Pria - Rp 100.000</option>
            <option value="Creambath Rambut Panjang - Rp 50.000">Creambath Rambut Panjang - Rp 50.000</option>
            <option value="Grooming Paket Full - Rp 120.000">Grooming Paket Full - Rp 120.000</option>
        </select>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label>Jam:</label>
        <input type="time" name="jam" required>

        <input type="submit" name="tambah_booking" value="Tambah Booking">
    </form>
</div>

<div class="card">
    <h2>Data Booking Pelanggan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Layanan</th>
            <th>Tanggal</th>
            <th>Jam</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($booking)): ?>
        <tr>
            <td><?php echo $b['id'];?></td>
            <td><?php echo htmlspecialchars($b['nama_pelanggan']);?></td>
            <td><?php echo htmlspecialchars($b['layanan']);?></td>
            <td><?php echo htmlspecialchars($b['tanggal']);?></td>
            <td><?php echo htmlspecialchars($b['jam']);?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
