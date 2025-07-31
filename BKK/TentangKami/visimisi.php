<?php
require_once __DIR__ . '/../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visi Misi BKK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="visimisi.css?v=<?php echo time(); ?>" rel="stylesheet">

</head>

<body>

  <?php include '../navbar/header.php' ?>

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
        <a href="#">TENTANG KAMI / Visi Misi</a>
      </div>

      <section class="visi-misi">
        <h2>VISI BKK SMKN 1 BOYOLANGU</h2>
        <p>Terwujudnya Bursa Kerja Khusus (BKK) yang mampu menjembatani pencari dan pemberi kerja serta menyalurkan
          tamatan yang dapat memenuhi tuntutan kebutuhan Usaha dan Industri memasuki Era Global.</p>

        <h2>MISI BKK SMKN 1 BOYOLANGU</h2>
        <ol>
          <li>Menjadi pusat informasi lowongan pekerjaan yang aktual bagi siswa dan alumni SMKN 1 Boyolangu.</li>
          <li>Menjalin kerjasama dengan Dunia Usaha/Industri untuk mengadakan pelatihan dan rekrutmen tenaga kerja bagi
            siswa dan alumni.</li>
        </ol>
      </section>
    </div>
  </div>

  <script>
    const cards = document.querySelectorAll('.visi-misi');

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