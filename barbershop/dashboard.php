<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'pelanggan'){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pelanggan</title>
<style>
body { font-family: Arial; background:#f5f5f5; margin:0; padding:0; }
header { background:#111; color:#fff; padding:15px; text-align:center; }
header a { color:#111; background:#e6b800; padding:6px 15px; text-decoration:none; border-radius:5px; margin-left:10px; }
section { max-width:800px; margin:20px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,.1); }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { padding:10px; border:1px solid #ddd; text-align:center; }
th { background:#e6b800; color:#111; }
tr:nth-child(even) { background:#f9f9f9; }
</style>
</head>
<body>

<header>
    <h1>💈 BarberShop</h1>
    <a href="?logout=true">Logout</a>
</header>

<?php
// Logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<section>
<h2>Halo, <?php echo $_SESSION['username']; ?>!</h2>

<h3>Pesan Sekarang</h3>
<form method="post" action="booking_process.php">
    <select name="service" required>
        <option value="">-- Pilih Layanan --</option>
        <option value="Haircut Modern">Haircut Modern</option>
        <option value="Shaving & Beard">Shaving & Beard</option>
        <option value="Hair Coloring">Hair Coloring</option>
    </select><br><br>
    <input type="date" name="date" required>
    <input type="time" name="time" required><br><br>
    <button type="submit">Pesan</button>
</form>
</section>

<section>
<h3>Riwayat Booking</h3>
<table>
<tr>
    <th>No</th>
    <th>Layanan</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Status</th>
</tr>
<?php
$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM bookings WHERE nama_customer='$username' ORDER BY id DESC");
$no = 1;
while($row = mysqli_fetch_assoc($query)){
    echo "<tr>
            <td>".$no++."</td>
            <td>".$row['layanan']."</td>
            <td>".$row['tanggal']."</td>
            <td>".$row['jam']."</td>
            <td>".$row['status']."</td>
          </tr>";
}
?>
</table>
</section>

</body>
</html>
