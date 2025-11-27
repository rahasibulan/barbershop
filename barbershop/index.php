<?php
// index.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbershop - Home</title>

  <!-- CSS Internal -->
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
      background: #f5f5f5;
      color: #333;
      line-height: 1.6;
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
       Hero Section
    ========================== */
    .hero {
      position: relative;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      overflow: hidden;
    }

    .hero::after {
      content: '';
      position: absolute;
      top:0; left:0;
      width:100%; height:100%;
      background: rgba(0,0,0,0.5);
      z-index:1;
    }

    .hero-img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      top: 0;
      left: 0;
      z-index: 0;
      background: url('baground.png') center/cover no-repeat;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 700px;
    }

    .hero-content h2 {
      font-size: 48px;
      margin-bottom: 15px;
    }

    .hero-content p {
      font-size: 20px;
      margin-bottom: 25px;
    }

    .hero-content .btn {
      background: #e6b800;
      color: #111;
      padding: 12px 25px;
      border-radius: 8px;
      font-weight: bold;
      transition: 0.3s;
      
    }

    .hero-content .btn:hover {
      opacity: 0.8;
      background: url('baground.png') center/cover no-repeat;
    }

    /* ==========================
       Services Preview
    ========================== */
    .services-preview {
      padding: 60px 20px;
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
    }

    .services-preview h3 {
      font-size: 36px;
      margin-bottom: 40px;
      color: #111;
    }

    .service-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
      gap: 30px;
    }

    .service-item {
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      transition: transform 0.4s, box-shadow 0.4s;
    }

    .service-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .service-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 15px;
    }

    .service-item h4 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #111;
    }

    .service-item p {
      font-size: 16px;
      color: #555;
    }

    /* ==========================
       Footer
    ========================== */
    .footer {
      background: #111;
      color: #eee;
      text-align: center;
      padding: 30px 20px;
      margin-top: 60px;
    }

    .footer p {
      color: #aaa;
    }

    /* ==========================
       Responsive
    ========================== */
    @media(max-width:768px){
      .hero-content h2 {
        font-size: 32px;
      }

      .hero-content p {
        font-size: 16px;
      }

      .service-item img {
        height: 180px;
      }
    }

  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <h1 class="logo">💈 Barber<span>Shop</span></h1>
      <nav class="navbar">
        <a href="index.php" class="active">Home</a>
        <a href="services.php">Layanan</a>
        <a href="about.php">Tentang Kami</a>
        <a href="contact.php">Kontak</a>
        <a href="login.php">login</a>
        <a href="logout.php">logout</a>

      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <img src="img/hero.jpg" alt="Hero Image" class="hero-img">
    <div class="hero-content">
      <h2>Gaya Rambut, Gaya Hidup</h2>
      <p>Potongan terbaik untuk pria yang tahu gaya. Profesional, bersih, dan elegan.</p>
      <a href="services.php" class="btn">Lihat Layanan</a>
    </div>
  </section>

  <!-- Services Preview -->
  <section class="services-preview">
    <h3>Layanan Unggulan Kami</h3>
    <div class="service-list">
      <div class="service-item">
        <img src="foto.png" alt="Haircut Modern">
        <h4>Haircut Modern</h4>
        <p>Gaya rambut klasik hingga kekinian.</p>
      </div>
      <div class="service-item">
        <img src="shaving.jpg" alt="Shaving & Beard">
        <h4>Shaving & Beard</h4>
        <p>Perawatan jenggot & kumis agar tampil rapi.</p>
      </div>
      <div class="service-item">
        <img src="poto.png" alt="Hair Coloring">
        <h4>Hair Coloring</h4>
        <p>Ganti warna rambut sesuai karakter kamu.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>© 2025 BarberShop. All rights reserved.</p>
  </footer>

</body>
</html>
