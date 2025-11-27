<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['username']) || $_SESSION['level'] != 'pelanggan'){
    header("Location: login.php");
    exit();
}

if(isset($_POST['service'], $_POST['date'], $_POST['time'])){
    $nama = $_SESSION['username'];
    $layanan = mysqli_real_escape_string($koneksi, $_POST['service']);
    $tanggal = $_POST['date'];
    $jam = $_POST['time'];

    mysqli_query($koneksi, "INSERT INTO bookings (nama_pelanggan, layanan, tanggal, jam, status)
                            VALUES ('$nama','$layanan','$tanggal','$jam','Menunggu')");

    header("Location: dashboard.php");
    exit();
}else{
    echo "Data tidak lengkap!";
}
?>
