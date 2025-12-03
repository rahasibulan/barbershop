
    <?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

// Hapus user
if(isset($_GET['hapus_id'])){
    $id = intval($_GET['hapus_id']);
    mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
    header("Location: manage_users.php");
    exit();
}

// Tambah user
if(isset($_POST['tambah'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $level = $_POST['level'];

    mysqli_query($koneksi,"INSERT INTO users(username,password,level) VALUES('$username','$password','$level')");
}
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Manajemen User</title>

<style>
    body { margin:0; font-family:Arial; background:#121212; color:#EAEAEA; }

    /* sidebar sama */
    .sidebar {
        width:230px; height:100vh; position:fixed;
        background:#0A0A0A; border-right:6px solid #1F3A93;
        padding-top:20px;
    }
    .sidebar h2 { text-align:center; color:#3C6FFF; margin-bottom:30px; }
    .sidebar a {
        display:block; padding:15px 20px; color:#EAEAEA;
        text-decoration:none; border-left:3px solid transparent;
        transition:.3s;
    }
    .sidebar a:hover {
        background:#1F1F1F; border-left:3px solid #3C6FFF;
    }

    /* content */
    .content { margin-left:250px; padding:25px; }
    .card {
        background:#1E1E1E; padding:20px; border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,.3); margin-bottom:30px;
    }

    table { width:100%; border-collapse:collapse; margin-top:15px; }
    th,td { border:1px solid #2A2A2A; padding:12px; }
    th { background:#1F3A93; }
    tr:hover { background:#1F1F1F; }

    /* form */
    form input,form select {
        width:100%; padding:10px; border-radius:5px;
        border:1px solid #333; background:#0F0F0F; color:#EAEAEA;
    }
    input[type=submit] {
        background:#3C6FFF; margin-top:10px; border:none; cursor:pointer;
    }

    .hapus { background:red; padding:6px 10px; color:white; border-radius:5px; text-decoration:none; }
</style>
</head>

<body>

<div class="sidebar">
    <h2>Barbershop</h2>
    <a href="dashboard_admin.php">Dashboard</a>
    <a href="manage_users.php">Manajemen User</a>
    <a href="manage_services.php">Manajemen Layanan</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h1>Manajemen User</h1>

    <div class="card">
        <h2>Daftar User</h2>
        <table>
            <tr><th>ID</th><th>Username</th><th>Level</th><th>Aksi</th></tr>
            <?php while($u=mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['level'] ?></td>
                <td>
                    <a class="hapus" href="?hapus_id=<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile ?>
        </table>
    </div>

    <div class="card">
        <h2>Tambah User Baru</h2>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Level:</label>
            <select name="level">
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
                <option value="kasir">Kasir</option>
            </select>

            <input type="submit" name="tambah" value="Tambah User">
        </form>
    </div>
</div>

</body>
</html>
