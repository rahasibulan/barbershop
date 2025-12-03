<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['level'] != 'pegawai') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['hapus_id'])) {
    $hapus_id = intval($_GET['hapus_id']);
    $q = "DELETE FROM booking WHERE id = $hapus_id";
    if (mysqli_query($koneksi, $q)) {
        header("Location: pegawai.php");
        exit();
    } else {
        echo "Hapus gagal: " . mysqli_error($koneksi);
    }
}
// — EDIT: load data jika ada edit_id
$edit_mode = false;
$edit_data = ['id'=>'','nama_pelanggan'=>'','layanan'=>'','tanggal'=>'','jam'=>''];

if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $res = mysqli_query($koneksi, "SELECT * FROM booking WHERE id = $id");
    if ($res && mysqli_num_rows($res) > 0) {
        $edit_mode = true;
        $edit_data = mysqli_fetch_assoc($res);
    }
}

// — SIMPAN booking: insert atau update
if (isset($_POST['tambah_booking']) || isset($_POST['update_booking'])) {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $layanan= mysqli_real_escape_string($koneksi, $_POST['layanan']);
    $tanggal= mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam    = mysqli_real_escape_string($koneksi, $_POST['jam']);

    if (isset($_POST['update_booking'])) {
        $id = intval($_POST['id']);
        mysqli_query($koneksi, "
            UPDATE booking SET 
              nama_pelanggan = '$nama',
              layanan = '$layanan',
              tanggal = '$tanggal',
              jam = '$jam'
            WHERE id = $id
        ");
    } else {
        mysqli_query($koneksi, "
            INSERT INTO booking (nama_pelanggan, layanan, tanggal, jam) 
            VALUES ('$nama','$layanan','$tanggal','$jam')
        ");
    }
    header("Location: pegawai.php");
    exit();
}

// Ambil data booking
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
a.action {
    margin-right:8px;
    color:#3C6FFF;
    text-decoration:none;
}
a.action:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<nav>
    <a href="pegawai.php">Home</a>
    <a href="logout.php">Logout</a>
</nav>

<h1>Dashboard Pegawai - Barbershop</h1>

<div class="card">
    <h2><?= $edit_mode ? 'Edit Booking' : 'Tambah Booking Baru' ?></h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" required value="<?= htmlspecialchars($edit_data['nama_pelanggan']) ?>">

        <label>Layanan:</label>
        <select name="layanan" required>
            <option value="">-- Pilih Layanan --</option>
            <?php
            $list = [
                "Potong Rambut Pria - Rp 50.000",
                "Cukur Kumis & Jenggot - Rp 25.000",
                "Hair Wash + Creambath - Rp 30.000",
                "Potong Anak-Anak - Rp 40.000",
                "Coloring Rambut Pria - Rp 100.000",
                "Creambath Rambut Panjang - Rp 50.000",
                "Grooming Paket Full - Rp 120.000"
            ];
            foreach($list as $l){
                $sel = ($edit_data['layanan'] === $l) ? 'selected' : '';
                echo "<option value=\"".htmlspecialchars($l)."\" $sel>$l</option>";
            }
            ?>
        </select>

        <label>Tanggal:</label>
        <input type="date" name="tanggal" required value="<?= htmlspecialchars($edit_data['tanggal']) ?>">

        <label>Jam:</label>
        <input type="time" name="jam" required value="<?= htmlspecialchars($edit_data['jam']) ?>">

        <input type="submit" name="<?= $edit_mode ? 'update_booking' : 'tambah_booking' ?>"
               value="<?= $edit_mode ? 'Update Booking' : 'Tambah Booking' ?>">
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
            <th>Aksi</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($booking)): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= htmlspecialchars($b['nama_pelanggan']) ?></td>
            <td><?= htmlspecialchars($b['layanan']) ?></td>
            <td><?= htmlspecialchars($b['tanggal']) ?></td>
            <td><?= htmlspecialchars($b['jam']) ?></td>
            <td>
                <a class="action" href="pegawai.php?edit_id=<?= $b['id'] ?>">Edit</a>
                <a class="action" href="pegawai.php?hapus_id=<?= $b['id'] ?>"
                   onclick="return confirm('Yakin hapus booking ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
