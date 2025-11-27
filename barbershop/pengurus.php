<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'pengurus'){
    header("Location: login.php");
    exit();
}

// Handle tambah pegawai
if(isset($_POST['tambah_pegawai'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah ada!";
    } else {
        mysqli_query($koneksi, "INSERT INTO users (username, password, level) VALUES ('$username','$password','pegawai')");
        header("Location: pengurus.php");
    }
}

// Handle hapus pegawai
if(isset($_GET['hapus_id'])){
    $id = intval($_GET['hapus_id']);
    mysqli_query($koneksi, "DELETE FROM users WHERE id=$id AND level='pegawai'");
    header("Location: pengurus.php");
}

// Ambil data pegawai
$pegawai = mysqli_query($koneksi, "SELECT * FROM users WHERE level='pegawai' ORDER BY id DESC");

// Ambil data booking untuk laporan
$booking = mysqli_query($koneksi, "SELECT * FROM booking ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pengurus - BarberBro</title>
<style>
body { font-family: Arial; background:#f0f0f0; padding:20px;}
h1 { color:#ff8c42; text-align:center;}
nav a { margin-right:15px; text-decoration:none; background:#ff8c42; color:white; padding:8px 12px; border-radius:6px;}
nav a:hover { background:#e65c00;}
table { width:100%; border-collapse:collapse; margin-top:20px;}
th, td { padding:10px; border-bottom:1px solid #ffd699; text-align:left;}
th { background:#ffd699;}
button, input[type="submit"] { background:#ff8c42; color:white; border:none; padding:8px 12px; border-radius:6px; cursor:pointer;}
button:hover, input[type="submit"]:hover { background:#e65c00;}
form { margin-top:20px; background:#fff3e6; padding:15px; border-radius:10px; max-width:400px;}
.error { color:red; font-weight:bold; text-align:center;}
</style>
</head>
<body>

<h1>Dashboard Pengurus Barbershop</h1>
<nav>
    <a href="pengurus.php">Home</a>
    <a href="logout.php">Logout</a>
</nav>

<h2>Tambah Pegawai Baru</h2>
<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
<form method="post" action="">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" name="tambah_pegawai" value="Tambah Pegawai">
</form>

<h2>Daftar Pegawai</h2>
<table>
<tr><th>ID</th><th>Username</th><th>Aksi</th></tr>
<?php while($p = mysqli_fetch_assoc($pegawai)): ?>
<tr>
    <td><?php echo $p['id'];?></td>
    <td><?php echo htmlspecialchars($p['username']);?></td>
    <td><a href="?hapus_id=<?php echo $p['id'];?>" onclick="return confirm('Yakin hapus pegawai ini?')">Hapus</a></td>
</tr>
<?php endwhile; ?>
</table>

<h2>Laporan Booking Pelanggan</h2>
<table>
<tr><th>ID</th><th>Nama Pelanggan</th><th>Layanan</th><th>Tanggal</th><th>Jam</th></tr>
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

</body>
</html>
