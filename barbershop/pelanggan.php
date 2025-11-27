<?php
session_start();
include 'koneksi.php';

// Pastikan login pelanggan
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'pelanggan'){
    header("Location: login.php");
    exit();
}

// Ambil id pelanggan (misal username dijadikan identitas)
$pelanggan = $_SESSION['username'];

// Handle tambah booking
if(isset($_POST['tambah_booking'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $layanan_id = intval($_POST['layanan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);

    mysqli_query($koneksi, "INSERT INTO bookings (nama_customer, layanan_id, tanggal, jam, status) 
        VALUES ('$nama','$layanan_id','$tanggal','$jam','pending')");
    header("Location: pelanggan.php");
}

// Ambil data booking pelanggan
$booking = mysqli_query($koneksi, "SELECT b.id, s.nama AS layanan, b.tanggal, b.jam, b.status 
    FROM bookings b 
    LEFT JOIN services s ON b.layanan_id = s.id
    WHERE b.nama_customer='$pelanggan' ORDER BY b.tanggal DESC");

// Ambil daftar layanan
$layanan_list = mysqli_query($koneksi, "SELECT * FROM services ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pelanggan - BarberBro</title>
<style>
body {
    margin:0;
    font-family: Arial, sans-serif;
    background:#121212;
    color:#EAEAEA;
}
nav {
    background:#0A0A0A;
    padding:15px;
    display:flex;
    justify-content:flex-start;
    gap:15px;
    border-bottom:3px solid #1F3A93;
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
h1 {
    text-align:center;
    color:#3C6FFF;
    margin:20px 0;
}
.card {
    background:#1E1E1E;
    padding:20px;
    border-radius:10px;
    margin:20px auto;
    max-width:700px;
    box-shadow:0 0 10px rgba(0,0,0,0.3);
}
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
.status-pending {color:#FFD700;} /* kuning */
.status-selesai {color:#00FF00;} /* hijau */
.status-batal {color:#FF4500;} /* oranye */
</style>
</head>
<body>

<nav>
    <a href="pelanggan.php">Dashboard</a>
    <a href="logout.php">Logout</a>
</nav>

<h1>Selamat Datang, <?php echo htmlspecialchars($pelanggan); ?></h1>

<div class="card">
    <h2>Tambah Booking Baru</h2>
    <form method="post" action="">
        <label>Nama:</label>
        <input type="text" name="nama_pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>" readonly>

        <label>Layanan:</label>
        <select name="layanan" required>
            <option value="">-- Pilih Layanan --</option>
            <?php while($l = mysqli_fetch_assoc($layanan_list)): ?>
                <option value="<?php echo $l['id']; ?>">
                    <?php echo htmlspecialchars($l['nama']) . " - Rp " . number_format($l['harga'],0,",","."); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required>

        <label>Jam:</label>
        <input type="time" name="jam" required>

        <input type="submit" name="tambah_booking" value="Booking Sekarang">
    </form>
</div>

<div class="card">
    <h2>Riwayat Booking Saya</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Layanan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($booking)): ?>
        <tr>
            <td><?php echo $b['id']; ?></td>
            <td><?php echo htmlspecialchars($b['layanan']); ?></td>
            <td><?php echo htmlspecialchars($b['tanggal']); ?></td>
            <td><?php echo htmlspecialchars($b['jam']); ?></td>
            <td class="status-<?php echo strtolower($b['status']); ?>">
                <?php echo ucfirst($b['status']); ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
