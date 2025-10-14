<?php
require_once __DIR__ . '/../../config/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="../../partials/navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="berandautama.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Franklin+Demi+Cond&display=swap" rel="stylesheet">

</head>

<body>

  <?php include '../../partials/navbar/header.php' ?>

  <div class="container">

    <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
        include '../../partials/navbar/guest.php';
    } elseif (is_alumni()) {
        include '../../partials/navbar/alumni.php';
    } elseif (is_admin()) {
        include '../../partials/navbar/admin.php';
    }
    ?>

    <section class="hero">
      <div class="hero-content">
        <h1>Bursa Kerja Khusus <br> SMKN 1 Boyolangu</h1>
        <hr>
        <div class="tagline"></div>
        <p class="tagline">DREAM - ACTION - SUCCESS</p>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-button" target="_blank">Video Tutorial<i
            class="fa-regular fa-circle-play"></i></a>

        <?php if (!is_logged_in()): ?>
        <div class="login-options">
          <!-- <a href="../../Login/LoginAdmin/admin-login.php" class="login-card">
              <img src="../../assets/images/adminlogin.png" alt="Admin Icon" class="icon">
              <span>Admin BKK</span>
            </a> -->
          <a href="../../Login/LoginAdmin/admin-login.php" class="login-card">
            <img src="../../assets/images/managementlogin.png" alt="Management Icon" class="icon">
            <span>Management</span>
          </a>
          <a href="../../Login/LoginSiswa/siswa-alumni-login.php" class="login-card">
            <img src="../../assets/images/siswalogin.png" alt="Siswa/Alumni Icon" class="icon">
            <span>Siswa / Alumni</span>
          </a>
          <!-- <a href="../../Login/LoginUserLain/pengguna-lain-login.html" class="login-card">
              <img src="../../assets/images/personlogin.png" alt="Pengguna Lain Icon" class="icon">
              <span>Pengguna Lain</span>
            </a> -->
        </div>
        <?php endif; ?>


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