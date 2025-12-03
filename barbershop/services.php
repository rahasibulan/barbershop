<?php
include "config/database.php";

// Ambil semua layanan dari database
$query = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Kami - Barbershop</title>

  <!-- CSS sama seperti versi kamu -->
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI', Tahoma;}
    body{background:#f5f5f5;color:#333;line-height:1.6;}
    .header{background:#111;color:#fff;padding:15px 20px;display:flex;justify-content:space-between;align-items:center;}
    .header .logo{font-size:28px;}
    .header .logo span{color:#e6b800;}
    .navbar a{color:#fff;margin-left:20px;}
    .navbar a:hover{color:#e6b800;}

    .services-page{padding:60px 20px;max-width:1200px;margin:auto;background:#fefefe;border-radius:15px;}
    .services-page h2{text-align:center;font-size:36px;margin-bottom:50px;color:#222;}

    .service-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:30px;}
    .service-card{display:flex;background:#fff;border-radius:15px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,0.08);}
    .service-img img{width:100%;height:100%;object-fit:cover;}
    .service-info{padding:20px;display:flex;flex-direction:column;justify-content:center;}
    .service-info h4{font-size:22px;margin-bottom:10px;}
    .price{color:#e6b800;font-weight:bold;margin-top:10px;font-size:18px;}

    .admin-btn{
      display:inline-block;
      padding:10px 15px;
      background:#111;
      color:white;
      text-decoration:none;
      border-radius:8px;
      margin-bottom:20px;
    }
    .admin-btn:hover{background:#e6b800;color:#111;}

    .footer{text-align:center;padding:30px;background:#111;color:#eee;margin-top:40px;}
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo">💈 Barber<span>Shop</span></div>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="services.php">Layanan</a>
      <a href="about.php">Tentang Kami</a>
      <a href="contact.php">Kontak</a>
    </nav>
  </header>

  <section class="services-page">

    <h2>Layanan Kami</h2>

    <!-- Tombol menuju CRUD Admin -->
    <a href="services/index.php" class="admin-btn">Kelola Layanan (CRUD Admin)</a>

    <div class="service-grid">

      <?php while($row = mysqli_fetch_assoc($query)): ?>
      <div class="service-card">
        <div class="service-img">
          <img src="img/<?= $row['image'] ?? 'default.jpg' ?>" alt="gambar layanan">
        </div>
        <div class="service-info">
          <h4><?= $row['name'] ?></h4>
          <p>Durasi: <?= $row['duration'] ?> menit</p>
          <span class="price">Rp <?= number_format($row['price']) ?></span>
        </div>
      </div>
      <?php endwhile; ?>

    </div>
  </section>

  <footer class="footer">
    <p>© 2025 Barbershop. All rights reserved.</p>
  </footer>

</body>
</html>
