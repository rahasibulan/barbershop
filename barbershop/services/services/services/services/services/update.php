<?php
include "../config/database.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

if (!empty($_FILES['gambar']['name'])) {
    // upload gambar baru
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $gambar);

    mysqli_query($conn, "UPDATE services SET
        nama='$nama',
        deskripsi='$deskripsi',
        harga='$harga',
        gambar='$gambar'
        WHERE id=$id
    ");
} else {
    // tanpa ubah gambar
    mysqli_query($conn, "UPDATE services SET
        nama='$nama',
        deskripsi='$deskripsi',
        harga='$harga'
        WHERE id=$id
    ");
}

header("Location: index.php");
exit;
?>
