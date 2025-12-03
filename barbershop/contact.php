<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbershop - Kontak Kami</title>

  <!-- CSS Contact Page -->
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
       Contact Page Section
    ========================== */
    .contact-page {
      padding: 60px 20px;
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      text-align: center;
    }

    .contact-page h2 {
      font-size: 36px;
      margin-bottom: 25px;
      color: #111;
      font-weight: 700;
    }

    .contact-page p {
      font-size: 18px;
      color: #555;
      margin-bottom: 15px;
    }

    .contact-page a.btn {
      display: inline-block;
      margin-top: 15px;
      background: #e6b800;
      padding: 12px 25px;
      border-radius: 10px;
      color: #111;
      font-weight: bold;
      transition: 0.3s;
    }

    .contact-page a.btn:hover {
      opacity: 0.8;
    }

    .contact-page iframe {
      margin-top: 20px;
      border-radius: 10px;
      width: 100%;
      height: 350px;
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
      .contact-page h2 {
        font-size: 28px;
      }

      .contact-page p {
        font-size: 16px;
      }

      .contact-page iframe {
        height: 250px;
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
        <a href="about.php">Tentang Kami</a>
        <a href="contact.php" class="active">Kontak</a>
      </nav>
    </div>
  </header>

  <!-- Contact Section -->
  <section class="contact-page">
    <h2>Kontak Kami</h2>
    <p>📍 Alamat: Jl. samarang No. 12</p>
    <p>📞 WhatsApp: <a href="https://wa.me/628123456789" class="btn">Klik untuk chat</a></p>
    <p>🕒 Jam Operasional: 09.00 - 21.00</p>

    <iframe src=
