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

/* ===== Welcome ===== */
.welcome {
  text-align: center;
  margin: 30px 20px;
}
.welcome h2 {
  font-size: 28px;
  margin-bottom: 10px;
}
.welcome p {
  font-size: 18px;
  color: #555;
}

/* ===== Services ===== */
.services {
  max-width: 1200px;
  margin: 30px auto;
  padding: 0 20px;
}
.services h3 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 25px;
  color: #111;
}
.service-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}
.service-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  text-align: center;
}
.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.service-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.service-card h4 {
  font-size: 20px;
  margin: 15px 0 10px;
}
.service-card p {
  color: #555;
  margin-bottom: 15px;
}

/* ===== Booking ===== */
.booking {
  max-width: 600px;
  margin: 40px auto;
  padding: 25px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
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

/* ===== History ===== */
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
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
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

<!-- Navbar -->
<div class="navbar">
  <h1>💈 BarberShop</h1>
  <div>
    <a href="#services">Layanan</a>
    <a href="#booking">Booking</a>
    <a href="#history">Riwayat</a>
    <a href="?logout=true" class="logout">Logout</a>
  </div>
</div>

<!-- Welcome -->
<section class="welcome">
  <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
  <p>Ini adalah dashboard pelanggan Anda.</p>
</section>

<!-- Services -->
<section class="services" id="services">
  <h3>Layanan Kami</h3>
  <div class="service-grid">
    <div class="service-card">
      <img src="hairrcut.jpg" alt="Haircut Modern">
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

<!-- Booking -->
<section class="booking" id="booking">
  <h3>Pesan Sekarang</h3>
  <form method="post" action="booking_process.php">
    <select name="service" required>
      <option value="">-- Pilih Layanan --</option>
      <?php
      include 'koneksi.php';
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

<!-- History -->
<section class="history" id="history">
  <h3>Riwayat Pesanan</h3>
  <table>
    <tr>
      <th>No</th>
      <th>Layanan</th>
      <th>Tanggal</th>
      <th>Jam</th>
    </tr>

    <?php
    include 'koneksi.php';
    $user = $_SESSION['username'];
    $no = 1;
    $query = mysqli_query($koneksi, "
        SELECT b.id, b.layanan_id, b.tanggal, b.jam, b.status, 
               s.nama AS layanan
        FROM bookings b
        JOIN services s ON b.layanan_id = s.id
        WHERE b.nama_customer = '$user'
        ORDER BY b.id DESC
    ");

    while($row = mysqli_fetch_assoc($query)):
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['layanan']; ?></td>
        <td><?php echo $row['tanggal']; ?></td>
        <td><?php echo $row['jam']; ?></td>
        <td><?php echo ucfirst($row['status']); ?></td>
        <td>
            <?php if($row['status'] == 'selesai'): ?>
                <a href="nota.php?id=<?php echo $row['id']; ?>" target="_blank"
                   style="background:#e6b800; padding:6px 10px; border-radius:6px; text-decoration:none; color:#111;">
                    Nota
                </a>
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
  </table>
</section>

</body>
</html>
