<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

if(isset($_POST['tambah'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // teks biasa
    $level = $_POST['level'];

    // cek username
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah ada!";
    } else {
        mysqli_query($koneksi, "INSERT INTO users (username, password, level) VALUES ('$username','$password','$level')");
        header("Location: dashboard_admin.php");
        exit();
    }
}
?>

<h2>Tambah User</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="text" name="password" required><br>
    Level:
    <select name="level" required>
        <option value="">--Pilih Level--</option>
        <option value="admin">Admin</option>
        <option value="pegawai">Pegawai</option>
        <option value="kasir">Kasir</option>
    </select><br>
    <button type="submit" name="tambah">Tambah</button>
</form>
