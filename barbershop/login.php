<?php
session_start();
include 'koneksi.php';

$error = ''; // inisialisasi error

if(isset($_POST['username'], $_POST['password'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data){ 
        // Jika password di DB plain text
        if($password === $data['password']){
            $_SESSION['username'] = $data['username'];
            $_SESSION['level'] = $data['level'];

            // Redirect berdasarkan level
            if($data['level'] == 'admin') {
                header("Location: dashboard_admin.php");
                exit();
            } elseif($data['level'] == 'pegawai') {
                header("Location: dashboard_pegawai.php");
                exit();
            } elseif($data['level'] == 'kasir') {
                header("Location: dashboard_kasir.php");
                exit();
            } elseif($data['level'] == 'pelanggan') {
                header("Location: dashboard_pelanggan.php");
                exit();
            }
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Barbershop</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #0a0f24, #0d1b2a, #1b263b);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background: rgba(0, 0, 0, 0.6);
        padding: 35px;
        border-radius: 15px;
        width: 350px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.7);
        text-align: center;
        backdrop-filter: blur(4px);
    }

    h2 {
        color: #4da8da;
        margin-bottom: 25px;
        font-weight: bold;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid #1b263b;
        background: #0d1b2a;
        color: #e0e0e0;
        font-size: 14px;
    }

    input::placeholder {
        color: #8fa3bf;
    }

    button {
        background: #1e90ff;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
        font-size: 15px;
        transition: 0.3s ease;
    }

    button:hover {
        background: #187bcd;
        transform: translateY(-2px);
    }

    .error {
        color: #ff4d4d;
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-container">
    <h2>Login Barbershop</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>
</body>
</html>
