<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT b.id, b.nama_customer, b.tanggal, b.jam, b.status,
           s.nama AS layanan, s.harga
    FROM bookings b
    JOIN services s ON b.layanan_id = s.id
    WHERE b.status = 'pending'
");
?>

<h2>Transaksi Pembayaran</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Layanan</th>
    <th>Harga</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nama_customer']; ?></td>
    <td><?php echo $row['layanan']; ?></td>
    <td>Rp <?php echo number_format($row['harga'],0,",","."); ?></td>
    <td><?php echo $row['tanggal']; ?></td>
    <td><?php echo $row['jam']; ?></td>
    <td>
        <a href="bayar.php?id=<?php echo $row['id']; ?>">
            Proses Pembayaran
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
