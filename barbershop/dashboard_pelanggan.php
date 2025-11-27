<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

// Logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pelanggan</title>
<style>
/* ===== Reset ===== */
* {
  margin: 0; padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
body {
  background: #f5f5f5;
  color: #333;
  line-height: 1.6;
}

/* ===== Header ===== */
header {
  background: #111;
  color: #fff;
  padding: 15px 0;
  text-align: center;
}
header h1 {
  font-size: 28px;
}
header .logout {
  margin-top: 5px;
  display: inline-block;
  background: #e6b800;
  color: #111;
  padding: 6px 15px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
}
header .logout:hover {
  opacity: 0.8;
}

/* ===== Welcome ===== */
.welcome {
  text-align: center;
  margin: 30px 0;
}
.welcome h2 {
  font-size: 28px;
  margin-bottom: 10px;
}
.welcome p {
  font-size: 18px;
  color: #555;
}

/* ===== Layanan Grid ===== */
.services {
  max-width: 1200px;
  margin: auto;
  padding: 30px 20px;
}
.services h3 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 30px;
}
.service-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
  gap: 25px;
}
.service-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  text-align: center;
}
.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.service-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.service-card h4 {
  font-size: 20px;
  margin: 15px 0 10px 0;
}
.service-card p {
  color: #555;
  margin-bottom: 15px;
}

/* ===== Booking Form ===== */
.booking {
  max-width: 600px;
  margin: 40px auto;
  padding: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.booking h3 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
}
.booking form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.booking select, .booking input {
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 16px;
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

/* ===== Riwayat Booking ===== */
.history {
  max-width: 900px;
  margin: 40px auto;
  padding: 20px;
}
.history h3 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
}
.history table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.history th, .history td {
  padding: 12px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}
.history th {
  background: #e6b800;
  color: #111;
}

/* ===== Responsive ===== */
@media(max-width:768px){
  .service-grid {
    grid-template-columns: 1fr;
  }
  .booking, .history {
    margin: 20px;
  }
}
</style>
</head>
<body>

<header>
  <h1>💈 BarberShop</h1>
  <a href="?logout=true" class="logout">Logout</a>
</header>

<section class="welcome">
  <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
  <p>Ini adalah dashboard pelanggan Anda.</p>
</section>

<section class="services">
  <h3>Layanan Kami</h3>
  <div class="service-grid">
    <div class="service-card">
      <img src="haircut.jpg" alt="Haircut Modern">
      <h4>Haircut Modern</h4>
      <p>Gaya rambut klasik hingga kekinian.</p>
    </div>
    <div class="service-card">
      <img src="shaving.jpg" alt="Shaving & Beard">
      <h4>Shaving & Beard</h4>
      <p>Perawatan jenggot & kumis agar tampil rapi.</p>
    </div>
    <div class="service-card">
      <img src="coloring.jpg" alt="Hair Coloring">
      <h4>Hair Coloring</h4>
      <p>Ganti warna rambut sesuai karakter kamu.</p>
    </div>
  </div>
</section>

<section class="booking">
  <h3>Pesan Sekarang</h3>
  <form method="post" action="booking_process.php">
    <select name="service" required>
      <option value="">-- Pilih Layanan --</option>
      <option value="haircut">Haircut Modern</option>
      <option value="shaving">Shaving & Beard</option>
      <option value="coloring">Hair Coloring</option>
    </select>
    <input type="date" name="date" required>
    <input type="time" name="time" required>
    <button type="submit">Pesan</button>
  </form>
</section>

<section class="history">
  <h3>Riwayat Pesanan</h3>
  <table>
    <tr>
      <th>No</th>
      <th>Layanan</th>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Status</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Haircut Modern</td>
      <td>2025-12-01</td>
      <td>10:00</td>
      <td>Selesai</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Shaving & Beard</td>
      <td>2025-12-05</td>
      <td>14:00</td>
      <td>Menunggu</td>
    </tr>
  </table>
</section>

</body>
</html>
