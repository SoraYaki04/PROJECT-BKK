<?php
require_once __DIR__ . '/../../config/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Franklin+Demi+Cond&display=swap" rel="stylesheet">
  <link href="../../navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="berandautama.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <header>
    <div class="rectangle">
    </div>

    <div class="logo">
      <div class="logo-header">
        <img src="../../logo.png" alt="BKK SMKN 1 Boyolangu Logo">
      </div>
      <div class="header-text">
        <img src="../../tulisan logo.png" alt="Bursa Kerja Khusus SMKN 1 Boyolangu" id="text-img">
      </div>
    </div>

    <div class="contact-info">
      <div class="contact-phone">
        <i class="fas fa-phone-alt"></i>
        <div class="contact-ket">
          <p>Call Us</p>
          <p>+6281-xxx-xxx-xxx</p>
        </div>
      </div>
      <div class="contact-email">
        <i class="fas fa-envelope"></i>
        <div class="contact-ket">
          <p>Email Us</p>
          <p>bkk@smkn1boyolangu@gmail.com</p>
        </div>

      </div>
      <div class="contact-map">
        <i class="fas fa-map-marker-alt"></i>
        <div class="contact-ket">
          <p>Located Us</p>
          <p>Jl. Ki Mangun Sarkoro No.VI/3, Beji, Boyolangu</p>
        </div>

      </div>
    </div>
  </header>

  <div class="container">

    <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
        include '../../navbar/guest.php';
    } elseif (is_alumni()) {
        include '../../navbar/alumni.php';
    } elseif (is_admin()) {
        include '../../navbar/admin.php';
    }
    ?>

    <section class="hero">
      <div class="hero-content">
        <h1>Bursa Kerja Khusus <br> SMKN 1 Boyolangu</h1>
        <hr>
        <div class="tagline"></div>
        <p class="tagline">DREAM - ACTION - SUCCES</p>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-button" target="_blank">Video Tutorial<i
            class="fa-regular fa-circle-play"></i></a>

        <div class="login-options">
          <a href="../../Login/Login Siswa/siswa-alumni-login.php" class="login-card">
            <img src="../../adminlogin.png" alt="Admin Icon" class="icon">
            <span>Admin BKK</span>
          </a>
          <a href="../../Login/management-login.html" class="login-card">
            <img src="../../managementlogin.png" alt="Management Icon" class="icon">
            <span>Management</span>
          </a>
          <a href="../../Login/siswa-alumni-login.html" class="login-card">
            <img src="../../siswalogin.png" alt="Siswa/Alumni Icon" class="icon">
            <span>Siswa / Alumni</span>
          </a>
          <a href="../../Login/pengguna-lain-login.html" class="login-card">
            <img src="../../personlogin.png" alt="Pengguna Lain Icon" class="icon">
            <span>Pengguna Lain</span>
          </a>
        </div>

      </div>
    </section>

    <footer>
      <p>&copy; 2024 Bursa Kerja Khusus SMKN 1 Boyolangu. All Rights Reserved.</p>
    </footer>
  </div>

  <script>
    const content = document.querySelectorAll('.hero-content');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.1
    });

    content.forEach(content => {
      observer.observe(content);
    });
  </script>

</body>

</html>