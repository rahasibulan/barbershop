<?php
include "../config/database.php";
$result = mysqli_query($conn, "SELECT * FROM services");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Layanan</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #999; }
        img { width: 120px; border-radius: 8px; }
        a.btn { padding: 10px 12px; background: black; color: white; text-decoration: none; border-radius: 6px; }
    </style>
</head>
<body>

<h2>Kelola Layanan Barbershop</h2>

<a href="add.php" class="btn">+ Tambah Layanan</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td>Rp <?= number_format($row['harga']) ?></td>
        <td><img src="uploads/<?= $row['gambar'] ?>" alt=""></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
