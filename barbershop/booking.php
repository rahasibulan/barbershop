<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking - BarberShop</title>
<style>
/* ===== Reset ===== */
* {
  margin: 0; padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
body {
  background: #f0f2f5;
  color: #333;
  line-height: 1.6;
}

/* ===== Navbar ===== */
.navbar {
  background: #111;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
}
.navbar h1 {
  font-size: 24px;
}
.navbar a {
  color: #fff;
  text-decoration: none;
  margin-left: 15px;
  font-weight: bold;
}
.navbar a.logout {
  background: #e6b800;
  color: #111;
  padding: 6px 12px;
  border-radius: 5px;
}
.navbar a.logout:hover {
  opacity: 0.8;
}

/* ===== Booking Section ===== */
.booking {
  max-width: 600px;
  margin: 50px auto;
  padding: 25px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}
.booking h3 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 28px;
  color: #111;
}
.booking form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.booking select, .booking input {
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 16px;
  outline: none;
  transition: 0.3s;
}
.booking select:focus, .booking input:focus {
  border-color: #1e90ff;
}
.booking button {
  background: #e6b800;
  color: #111;
  padding: 12px;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}
.booking button:hover {
  opacity: 0.8;
}

/* ===== Responsive ===== */
@media(max-width:768px){
  .booking {
    margin: 20px;
  }
}
</style>
</head>
<body>

<div class="navbar">
  <h1>💈 BarberShop</h1>
  <div>
    <a href="services.php">Layanan</a>
    <a href="booking.php">Booking</a>
    <a href="history.php">Riwayat</a>
    <a href="?logout=true" class="logout">Logout</a>
  </div>
</div>

<section class="booking">
  <h3>Pesan Sekarang</h3>
  <form method="post" action="booking_process.php">
    <select name="service" required>
      <option value="">-- Pilih Layanan --</option>
      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM services ORDER BY nama ASC");
      while($row = mysqli_fetch_assoc($query)){
          echo "<option value='".$row['id']."'>".$row['nama']."</option>";
      }
      ?>
    </select>
    <input type="date" name="date" required>
    <input type="time" name="time" required>
    <button type="submit">Pesan</button>
  </form>
</section>

</body>
</html>
