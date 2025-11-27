<?php
session_start();

// Cek apakah sudah login dan level admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php?pesan=gagal");
    exit();
}

include 'koneksi.php'; // file koneksi ke database

// Ambil data user sebagai contoh
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");

// Handle hapus user
if (isset($_GET['hapus_id'])) {
    $hapus_id = intval($_GET['hapus_id']);
    mysqli_query($koneksi, "DELETE FROM users WHERE id=$hapus_id");
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Admin - Barbershop</title>
<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #0f0f0f;
    color: #fff;
}

header {
    background: #000;
    padding: 25px;
    text-align: center;
    border-bottom: 2px solid #D4AF37;
}

header h1 {
    color: #D4AF37;
    letter-spacing: 1px;
}

nav {
    background: #111;
    padding: 15px;
    display: flex;
    justify-content: center;
    gap: 20px;
    border-bottom: 1px solid #333;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px 18px;
    border: 1px solid #D4AF37;
    border-radius: 5px;
    transition: 0.3s;
}

nav a:hover {
    background: #D4AF37;
    color: #000;
}

.welcome {
    text-align: center;
    margin: 20px 0;
    font-size: 18px;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: auto;
    background: #111;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #333;
    box-shadow: 0 5px 20px rgba(0,0,0,0.4);
}

.container h2 {
    margin-bottom: 20px;
    color: #D4AF37;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #333;
}

th {
    background: #000;
    color: #D4AF37;
}

tr:hover {
    background: #1c1c1c;
}

.button-hapus {
    background: #b30000;
    color: white;
    padding: 7px 12px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
}

.button-hapus:hover {
    background: #ff1a1a;
}
</style>

</head>
<body>

<header>
    <h1>BarberBro Admin Panel</h1>
</header>

<nav>
    <a href="admin.php">Dashboard</a>
    <a href="admin.php#users">Manajemen User</a>
    <a href="admin.php#services">Manajemen Layanan</a>
    <a href="admin.php#booking">Jadwal / Booking</a>
    <a href="admin.php#reports">Laporan</a>
    <a href="admin.php#settings">Pengaturan</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="welcome">
    Halo <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>, Anda login sebagai <b><?php echo htmlspecialchars($_SESSION['level']); ?></b>.
</div>

<div class="container" id="users">
    <h2>Manajemen User</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        <?php while($user = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['level']); ?></td>
            <td>
                <a class="button-hapus" href="?hapus_id=<?php echo $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
