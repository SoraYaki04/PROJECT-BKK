<?php
require_once __DIR__ . '/../../config/helpers.php';
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
    <link rel="stylesheet" href="../../navbar/navbar.css" />
    <link rel="stylesheet" href="informasikegiatanbkk.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <?php include '../../navbar/header.php' ?>

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

      <div class="header-bar">
        <a href="#">Kegiatan BKK</a>
      </div>

      <div class="activity-list">
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>
        <div class="activity-card">
            <div class="activity-header">
              <h2>KUNJUNGAN INDUSTRI</h2>
            </div>
            <div class="activity-content">
                <div class="images">
                  <img src="abc 1.png" alt="">
                </div>
                <hr>
                <div class="description">
                    <p>Kegiatan rutin yang dilakukan oleh SMKN 1 Boyolangu untuk mengajak siswa mengunjungi perusahaan-perusahaan besar di sekitar wilayah Jawa Timur. Program ini bertujuan agar siswa memahami secara langsung dunia kerja dan lingkungan industri yang sebenarnya.</p>
                </div>
            </div>
        </div>

        <div class="page">
          <p>Ditampilkan <strong>6</strong> dari <strong>6</strong> dari Total <strong>30</strong> Kegiatan</p>
          <div class="page-btn">
            <a class="btn" onclick="">1</a>
            <a class="btn" onclick="">2</a>
            <a class="btn" onclick="">3</a>
            <a class="btn" onclick="">4</a>
            <a class="btn" onclick="">5</a>
            <a class="btn-next" onclick=""><button>NEXT</button></a>
          </div>
        </div>

        </div>
      </div>
    </div>

 <script>
    const content = document.querySelectorAll('.activity-card');

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
