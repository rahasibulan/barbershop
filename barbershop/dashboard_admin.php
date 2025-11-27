<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("Location: login.php?pesan=gagal");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin - BarberBro</title>
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
        padding: 20px;
    }
    .card {
        background: #1E1E1E;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th, td {
        border: 1px solid #2A2A2A;
        padding: 12px;
    }
    th {
        background: #1F3A93;
    }
    tr:hover {
        background: #1F1F1F;
    }
    .button {
        background: #3C6FFF;
        padding: 7px 12px;
        color: white;
        border-radius: 5px;
        text-decoration: none;
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
    <a href="reports.php">Laporan</a>
    <a href="settings.php">Pengaturan</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Selamat Datang, <?php echo $_SESSION['username']; ?></h1>

    <div class="card">
        <h2>Data User</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>

            <?php
            $users = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
            while ($u = mysqli_fetch_assoc($users)):
            ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= $u['level'] ?></td>
                <td>
                    <a class="button" href="edit_user.php?id=<?= $u['id'] ?>">Edit</a>
                </td>
            </tr>
            <?php endwhile ?>
        </table>
    </div>
</div>

</body>
</html>
