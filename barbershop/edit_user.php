<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM users WHERE id=$id"));

if(isset($_POST['update'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $level = $_POST['level'];

    mysqli_query($koneksi,"UPDATE users SET username='$username', password='$password', level='$level' WHERE id=$id");
    header("Location: dashboard_admin.php");
    exit();
}
?>

<h2>Edit User</h2>
<form method="post">
    Username: <input type="text" name="username" value="<?php echo $data['username']; ?>" required><br>
    Password: <input type="text" name="password" value="<?php echo $data['password']; ?>" required><br>
    Level:
    <select name="level" required>
        <option value="admin" <?php if($data['level']=='admin') echo 'selected'; ?>>Admin</option>
        <option value="pegawai" <?php if($data['level']=='pegawai') echo 'selected'; ?>>Pegawai</option>
        <option value="kasir" <?php if($data['level']=='kasir') echo 'selected'; ?>>Kasir</option>
    </select><br>
    <button type="submit" name="update">Update</button>
</form>
