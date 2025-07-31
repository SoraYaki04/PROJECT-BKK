<?php
require_once __DIR__ . '/../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Kerja BKK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="proker.css?v=<?php echo time(); ?>" rel="stylesheet">
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
        <a href="#">TENTANG KAMI / Program Kerja</a>
      </div>

      <section class="proker">
        <h2 class="proker-h2">PROGRAM KERJA BKK SMKN 1 BOYOLANGU</h2>
        <ol>
          <li class="proker-list">Sosialisasi Program BKK Kepada siswa-siswi SMKN 1 Boyolangu bertujuan Agar siswa
            tingkat ankhir XII/XIII mengetahui tentang kegiatan pelatihan, open rekrutmen dan lain sebagainya.</li>
          <li class="proker-list">Pendataan DUDI industri baik untuk penempatan kerja dalam negeri bertujuan Mengetahui
            perusahaan yang memungkinkan menjalin kerja sama.</li>
          <li class="proker-list">Melakukan kunjungan ke pengguna tenaga kerja /perusahaan untuk melakukan penawaran
            mengenai ketersediaan tenaga kerja bertujuan Untuk menghimpun informasi tentang kebutuhan tenaga kerja di
            perusahaan dan dikhusukan untuk tingkat akhir / kelas XII dan Kelas XIII.</li>
          <li class="proker-list">Pendataan dan Pembuatan data base canaker tamatan TA 2021-2022 Mengetahui canaker /
            tamatan yang belum bekerja.</li>
          <li class="proker-list">Pelatihan “Basic Mentality Learning” bertujuan Pembekalan (kognitif dan afektif) untuk
            menyiapkan canaker menempuh proses rekruitment dan ketika bekerja pada DUDI.</li>
          <li class="proker-list">Pelatihan Ketrampilan dan Uji sertifikasi bertujuan Calon tenaga kerja dan petugas BKK
            mendapatkan bekal pelatihan serta uji sertifikasi.</li>
          <li class="proker-list">Pelatihan Kewirausahaan bertujuan Menambah kompetensi dan pengetahuan tentang
            kewirausahaan bidang makan & minum.</li>
          <li class="proker-list">Proses rekruitmen kerja agar Alumni dapat terserap di DUDI.</li>
          <li class="proker-list">Mengikuti seminar / workshop/ latihan petugas BKK dan program magang bagi guru
            produktif bertujuan Untuk meningkatkan ketrampilan dan pengetahuan petugas BKK.</li>
        </ol>
      </section>
    </div>
  </div>

  <script>
    const cards = document.querySelectorAll('.proker-h2, .proker-list');

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