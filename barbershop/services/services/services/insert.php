<?php
include "../config/database.php";

$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

// proses upload gambar
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp, "uploads/" . $gambar);

mysqli_query($conn, "INSERT INTO services (nama, deskripsi, harga, gambar)
VALUES ('$nama', '$deskripsi', '$harga', '$gambar')");

header("Location: index.php");
exit;
?>
