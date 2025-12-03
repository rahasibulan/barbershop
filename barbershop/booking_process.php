<?php
session_start();
include 'koneksi.php';

if(isset($_POST['service'], $_POST['date'], $_POST['time'])){
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user = $_SESSION['username']; // nama pelanggan dari session

    $insert = mysqli_query($koneksi, "
        INSERT INTO bookings (layanan_id, nama_customer, tanggal, jam, status)
        VALUES ('$service', '$user', '$date', '$time', 'Menunggu')
    ");

    if($insert){
        header("Location: dashboard_pelanggan.php");
        exit();
    } else {
        echo "Gagal booking: " . mysqli_error($koneksi);
    }
}
?>
