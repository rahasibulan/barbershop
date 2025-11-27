
    <?php
session_start();
include 'koneksi.php';

// Cek login & level admin
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

// Hapus layanan
if(isset($_GET['hapus_id'])){
    $hapus_id = intval($_GET['hapus_id']);
    mysqli_query($koneksi, "DELETE FROM services WHERE id=$hapus_id");
    header("Location: manage_services.php");
    exit();
}

// Tambah layanan
if(isset($_POST['tambah'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $harga = floatval($_POST['harga']);

    // Upload gambar
    $gambar = "";
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0){
        $folder = "uploads/";
        if(!is_dir($folder)) mkdir($folder);
        $gambar = $folder . time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
    }

    mysqli_query($koneksi, "INSERT INTO services (nama, deskripsi, harga, gambar) VALUES ('$nama','$deskripsi','$harga','$gambar')");
    header("Location: manage_services.php");
    exit();
}

// Ambil data layanan
$result = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Layanan</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #121212;
        color: #EAEAEA;
    }

    /* SIDEBAR */
    .sidebar {
        width: 230px;
        height: 100vh;
        position: fixed;
        background: #0A0A0A;
        border-right: 6px solid #1F3A93;
        padding-top: 20px;
    }
    .sidebar h2 {
        text-align: center;
        color: #3C6FFF;
        margin-bottom: 30px;
    }
    .sidebar a {
        display: block;
        padding: 15px 20px;
        color: #EAEAEA;
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: 0.3s;
    }
    .sidebar a:hover {
        background: #1F1F1F;
        border-left: 3px solid #3C6FFF;
    }

    /* CONTENT */
    .content {
        margin-left: 250px;
        padding: 25px;
    }

    .card {
        background: #1E1E1E;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,.3);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th, td {
        padding: 12px;
        border: 1px solid #2A2A2A;
    }
    th {
        background: #1F3A93;
    }
    tr:hover {
        background: #1F1F1F;
    }

    img {
        width: 80px;
        border-radius: 5px;
    }

    .hapus {
        background: red;
        padding: 6px 10px;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }
    .hapus:hover {
        background: #CC0000;
    }

    form input, form textarea {
        width: 100%;
        padding: 10px;
        background: #0F0F0F;
        border: 1px solid #333;
        border-radius: 5px;
        color: #EAEAEA;
        margin-bottom: 15px;
    }

    form input[type=submit] {
        background: #3C6FFF;
        cursor: pointer;
        border: none;
    }
</style>
</head>

<body>

<div class="sidebar">
    <h2>BarberBro</h2>
    <a href="dashboard_admin.php">Dashboard</a>
    <a href="manage_users.php">Manajemen User</a>
    <a href="manage_services.php">Manajemen Layanan</a>
    <a href="manage_booking.php">Data Booking</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    
    <h1>Manajemen Layanan BarberBro</h1>

    <!-- DATA LAYANAN -->
    <div class="card">
        <h2>Daftar Layanan</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>

            <?php while($s = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['nama']) ?></td>
                <td><?= htmlspecialchars($s['deskripsi']) ?></td>
                <td>Rp <?= number_format($s['harga'], 0, ",", ".") ?></td>

                <td>
                    <?php if($s['gambar']): ?>
                        <img src="<?= $s['gambar'] ?>" alt="gambar">
                    <?php else: ?>
                        <i style="color:#777">Tidak ada</i>
                    <?php endif ?>
                </td>

                <td>
                    <a class="hapus" href="?hapus_id=<?= $s['id'] ?>" onclick="return confirm('Hapus layanan ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile ?>
        </table>
    </div>

    <!-- FORM TAMBAH -->
    <div class="card">
        <h2>Tambah Layanan Baru</h2>

        <form method="post" enctype="multipart/form-data">
            <label>Nama Layanan:</label>
            <input type="text" name="nama" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" required></textarea>

            <label>Harga (Rp):</label>
            <input type="number" name="harga" required>

            <label>Gambar:</label>
            <input type="file" name="gambar" accept="image/*">

            <input type="submit" name="tambah" value="Tambah Layanan">
        </form>
    </div>
</div>

</body>
</html>
