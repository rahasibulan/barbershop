<!DOCTYPE html>
<html>
<head>
    <title>Tambah Layanan</title>
</head>
<body>

<h2>Tambah Layanan</h2>

<form action="insert.php" method="POST" enctype="multipart/form-data">

    Nama Layanan:<br>
    <input type="text" name="nama" required><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi" required></textarea><br><br>

    Harga:<br>
    <input type="number" name="harga" required><br><br>

    Gambar:<br>
    <input type="file" name="gambar" required><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>
