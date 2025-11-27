<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin'){
    header("Location: login.php?pesan=gagal");
    exit();
}

$id = intval($_GET['id']);
mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
header("Location: dashboard_admin.php");
exit();
