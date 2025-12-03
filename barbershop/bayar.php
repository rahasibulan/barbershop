<?php
include 'koneksi.php';

$id = $_GET['id'];

$q = mysqli_query($koneksi, "
    SELECT b.id, b.nama_customer, s.nama AS layanan, s.harga
    FROM bookings b
    JOIN services s ON b.layanan_id = s.id
    WHERE b.id = $id
");

$data = mysqli_fetch_assoc($q);
?>

<h2>Pembayaran Booking #<?php echo $id; ?></h2>

<form method="post" action="proses_bayar.php">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <input type="hidden" name="total" value="<?php echo $data['harga']; ?>">

    <p>Nama: <b><?php echo $data['nama_customer']; ?></b></p>
    <p>Layanan: <b><?php echo $data['layanan']; ?></b></p>
    <p>Total Harga: <b>Rp <?php echo number_format($data['harga'],0,",","."); ?></b></p>

    <label>Metode Pembayaran:</label>
    <select name="metode" required>
        <option value="">-- Pilih --</option>
        <option value="Cash">Cash / Tunai</option>
        <option value="QRIS">QRIS</option>
        <option value="Dana">Dana</option>
        <option value="Bank Transfer">Transfer Bank</option>
    </select>

    <br><br>
    <button type="submit">Bayar</button>
</form>
