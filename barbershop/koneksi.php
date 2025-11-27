<?php
$koneksi = mysqli_connect("localhost", "root", "", "barbershop_db");
if(!$koneksi){
    die("Koneksi gagal: ".mysqli_connect_error());
}
?>
