<?php
session_start();
include 'koneksi.php';

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

            if($data['level']=='admin') header("Location: dashboard_admin.php");
            elseif($data['level']=='pegawai') header("Location: dashboard_pegawai.php");
            elseif($data['level']=='kasir') header("Location: dashboard_kasir.php");
            }elseif($data['level']=='pelanggan') {header("Location: dashboard.php");
            exit();
        } else {
            echo "Password salah!";
        }
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
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #ffecd2, #fcb69f);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .login-container {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 350px;
        text-align: center;
    }
    h2 { margin-bottom: 20px; color: #ff5c5c; }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
    button {
        background: #ff5c5c;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
    }
    button:hover {
        background: #ff1a1a;
    }
    .error {
        color: red;
        margin-bottom: 10px;
    }
</style>
</head>
<body>
<div class="login-container">
    <h2>Login Barbershop</h2>
    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>
</body>
</html>

