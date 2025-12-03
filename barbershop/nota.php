<?php
include 'koneksi.php';

$id = $_GET['id'];
$q = mysqli_query($koneksi, "
    SELECT b.id, b.nama_customer, s.nama AS layanan, s.harga, b.metode_pembayaran, b.total_harga, b.tanggal, b.jam
    FROM bookings b
    JOIN services s ON b.layanan_id = s.id
    WHERE b.id=$id
");
$data = mysqli_fetch_assoc($q);
?>

<h2>💈 Nota Pembayaran</h2>
<p>ID Booking: <?php echo $data['id']; ?></p>
<p>Nama Pelanggan: <?php echo $data['nama_customer']; ?></p>
<p>Layanan: <?php echo $data['layanan']; ?></p>
<p>Total Harga: Rp <?php echo number_format($data['total_harga'],0,",","."); ?></p>
<p>Metode Pembayaran: <?php echo $data['metode_pembayaran']; ?></p>
<p>Tanggal: <?php echo $data['tanggal']; ?></p>
<p>Jam: <?php echo $data['jam']; ?></p>

<?php if($data['metode_pembayaran'] == 'QRIS'): ?>
    <p>Scan QRIS untuk pembayaran:</p>
    <img src="qris.png" width="200">
<?php endif; ?>

<button onclick="window.print()">Cetak Nota</button>
