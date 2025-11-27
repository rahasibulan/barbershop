<?php
// services.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Kami - Barbershop</title>
  <style>
    /* ==========================
       Reset & Base
    =========================== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background: #f5f5f5;
      color: #333;
      line-height: 1.6;
    }
    a {
      text-decoration: none;
      color: inherit;
    }

    /* ==========================
       Header
    =========================== */
    .header {
      background: #111;
      color: #fff;
      padding: 15px 20px;
      position: sticky;
      top: 0;
      z-index: 100;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header .logo {
      font-size: 28px;
    }
    .header .logo span {
      color: #e6b800;
    }
    .navbar a {
      color: #fff;
      margin-left: 20px;
      transition: 0.3s;
    }
    .navbar a:hover {
      color: #e6b800;
    }

    /* ==========================
       Services Section
    =========================== */
    .services-page {
      padding: 60px 20px;
      max-width: 1200px;
      margin: auto;
      background: linear-gradient(135deg, #fdf6f0, #f0f0f5);
      border-radius: 15px;
    }
    .services-page h2 {
      text-align: center;
      font-size: 36px;
      margin-bottom: 50px;
      color: #222;
    }
    .service-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
    }
    .service-card {
      display: flex;
      background: #fff;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    .service-img {
      flex: 1 1 40%;
      overflow: hidden;
    }
    .service-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .service-card:hover .service-img img {
      transform: scale(1.05);
    }
    .service-info {
      flex: 1 1 60%;
      padding: 20px 25px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .service-info h4 {
      font-size: 22px;
      color: #111;
      margin-bottom: 12px;
      font-weight: 600;
    }
    .service-info p {
      color: #555;
      font-size: 16px;
      flex-grow: 1;
    }
    .service-info .price {
      font-weight: bold;
      color: #e6b800;
      margin-top: 10px;
      font-size: 18px;
    }

    /* ==========================
       Footer
    =========================== */
    .footer {
      text-align: center;
      padding: 30px 20px;
      margin-top: 40px;
      background: #111;
      color: #eee;
    }

    /* ==========================
       Responsive
    =========================== */
    @media(max-width: 992px) {
      .service-card {
        flex-direction: column;
      }
      .service-img, .service-info {
        flex: unset;
      }
      .service-img {
        height: 220px;
      }
    }
    @media(max-width: 576px) {
      .services-page {
        padding: 40px 10px;
      }
    }
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

  <!-- Services Section -->
  <section class="services-page">
    <h2>Layanan Kami</h2>
    <div class="service-grid">
      <div class="service-card">
        <div class="service-img">
          <img src="haircut.jpg" alt="Haircut Modern">
        </div>
        <div class="service-info">
          <h4>Haircut Modern</h4>
          <p>Gaya rambut klasik hingga kekinian.</p>
          <span class="price">Rp 50.000</span>
        </div>
      </div>

      <div class="service-card">
        <div class="service-img">
          <img src="shaving.jpg" alt="Shaving & Beard">
        </div>
        <div class="service-info">
          <h4>Shaving & Beard</h4>
          <p>Perawatan jenggot & kumis agar tampil rapi.</p>
          <span class="price">Rp 30.000</span>
        </div>
      </div>

      <div class="service-card">
        <div class="service-img">
          <img src="coloring.jpg" alt="Hair Coloring">
        </div>
        <div class="service-info">
          <h4>Hair Coloring</h4>
          <p>Ganti warna rambut sesuai karakter kamu.</p>
          <span class="price">Rp 70.000</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>© 2025 Barbershop. All rights reserved.</p>
  </footer>

</body>
</html>
