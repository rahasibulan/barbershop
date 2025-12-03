<?php
include "../config/database.php";

$id = $_GET['id'];

// hapus file gambar juga
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM services WHERE id=$id"));
unlink("uploads/" . $data['gambar']);

mysqli_query($conn, "DELETE FROM services WHERE id=$id");

header("Location: index.php");
exit;
?>
