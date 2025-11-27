<?php
// about.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbershop - Tentang Kami</title>
  
  <!-- CSS About Page -->
  <style>
    /* ==========================
       Reset & Base
    ========================== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      line-height: 1.6;
      color: #333;
      background-color: #f5f5f5;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* ==========================
       Header / Navbar
    ========================== */
    .header {
      background: #111;
      color: #fff;
      padding: 15px 0;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header .container {
      width: 90%;
      margin: auto;
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

    .navbar a:hover, .navbar a.active {
      color: #e6b800;
    }

    /* ==========================
       About Page Section
    ========================== */
    .about-page {
      padding: 60px 20px;
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      text-align: center;
    }

    .about-page h2 {
      font-size: 36px;
      margin-bottom: 25px;
      color: #111;
      font-weight: 700;
    }

    .about-page p {
      font-size: 18px;
      color: #555;
      margin-bottom: 30px;
    }

    .about-page ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .about-page ul li {
      background: #e6b800;
      color: #111;
      padding: 12px 25px;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .about-page ul li:hover {
      transform: translateY(-5px);
    }

    /* ==========================
       Footer
    ========================== */
    .footer {
      text-align: center;
      padding: 30px 20px;
      margin-top: 40px;
      background: #111;
      color: #eee;
    }

    /* ==========================
       Responsive
    ========================== */
    @media(max-width:768px) {
      .about-page ul {
        flex-direction: column;
        gap: 15px;
      }

      .about-page h2 {
        font-size: 28px;
      }

      .about-page p {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>

  <!-- Header / Navbar -->
  <header class="header">
    <div class="container">
      <h1 class="logo">💈 Barber<span>Shop</span></h1>
      <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="services.php">Layanan</a>
        <a href="about.php" class="active">Tentang Kami</a>
        <a href="contact.php">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- About Section -->
  <section class="about-page">
    <h2>Tentang Kami</h2>
    <p>Barbershop kami berdiri sejak 2020, mengutamakan kualitas potongan rambut dan kenyamanan pelanggan.  
       Tim barber kami berpengalaman dan selalu menjaga kebersihan serta alat yang steril.</p>
    <ul>
      <li>Barber Berpengalaman</li>
      <li>Alat Steril & Higienis</li>
      <li>Tempat Nyaman & Modern</li>
      <li>Potongan Rambut Premium</li>
    </ul>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>© 2025 BarberShop. All rights reserved.</p>
  </footer>

</body>
</html>
