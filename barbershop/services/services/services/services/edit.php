<?php
include "../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services WHERE id=$id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Layanan</title>
</head>
<body>

<h2>Edit Layanan</h2>

<form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    Nama Layanan:<br>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi" required><?= $data['deskripsi'] ?></textarea><br><br>

    Harga:<br>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br><br>

    Gambar Sekarang:<br>
    <img src="uploads/<?= $data['gambar'] ?>" width="150"><br><br>

    Ganti Gambar (opsional):<br>
    <input type="file" name="gambar"><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>
