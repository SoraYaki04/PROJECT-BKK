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
  <link href="../partials/navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="tujuan.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <?php include '../partials/navbar/header.php' ?> 

  <div class="container">

    <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
            include '../partials/navbar/guest.php';
    } elseif (is_alumni()) {
            include '../partials/navbar/alumni.php';
    } elseif (is_admin()) {
            include '../partials/navbar/admin.php';
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