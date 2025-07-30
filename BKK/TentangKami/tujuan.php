<?php
require_once __DIR__ . '/../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tujuan BKK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="tujuan.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <header>
    <div class="rectangle">
    </div>

    <div class="logo">
      <div class="logo-header">
        <img src="../logo.png" alt="BKK SMKN 1 Boyolangu Logo">
      </div>
      <div class="header-text">
        <img src="../tulisan logo.png" alt="Bursa Kerja Khusus SMKN 1 Boyolangu" id="text-img">
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
        include '../navbar/guest.php';
    } elseif (is_alumni()) {
        include '../navbar/alumni.php';
    } elseif (is_admin()) {
        include '../navbar/admin.php';
    }
    ?>

    <div class="container">
      <div class="header-bar">
        <a href="#">TENTANG KAMI / Tujuan</a>
      </div>

      <section class="tujuan">
        <h2 class="tujuan-title">TUJUAN BKK SMKN 1 BOYOLANGU</h2>
        <ol>
          <li class="tujuan-list">Sebagai wadah dalam mempertemukan alumni maupun peserta lain dengan pencari kerja.
          </li>
          <li class="tujuan-list">Memberikan layanan kepada tamatan sesuai dengan tugas dan fungsi masing-masing seksi
            yang ada dalam BKK.</li>
          <li class="tujuan-list">Sebagai wadah dalam pelatihan tamatan yang sesuai dengan permintaan pencari kerja.
          </li>
          <li class="tujuan-list">Sebagai wadah untuk menanamkan jiwa wirausaha bagi tamatan melalui pelatihan.</li>
        </ol>
      </section>

      <div class="langkah">
        <img src="cara daftar loker.jpg">
      </div>
    </div>
  </div>

  <script>
    const cards = document.querySelectorAll('.tujuan-title, .tujuan-list, .langkah img');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.1
    });

    cards.forEach(card => {
      observer.observe(card);
    });
  </script>

</body>

</html>