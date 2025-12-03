<?php
include 'koneksi.php';

$id     = $_POST['id'];
$metode = $_POST['metode'];
$total  = $_POST['total'];

// Update status booking menjadi 'selesai' dan simpan metode pembayaran
mysqli_query($koneksi, "
    UPDATE bookings 
    SET status='selesai', metode_pembayaran='$metode', total_harga='$total'
    WHERE id=$id
");

// Redirect ke nota
header("Location: nota.php?id=$id");
exit();
?>
