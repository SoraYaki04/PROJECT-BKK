<?php
require_once __DIR__ . '/../../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sambutan Kepala Sekolah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../../partials/navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="pengantar.css?v=<?php echo time(); ?>" rel="stylesheet">

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
    } else {
        include '../../partials/navbar/guest.php';
    }
    ?>

    <div class="header-bar">
      <a href="#">HOME / Pengantar</a>
    </div>

    <div class="content">
      <div class="left-side">
        <h1>SAMBUTAN</h1>
        <h2>KEPALA SEKOLAH</h2>
        <img src="skena.jpg" alt="Foto Kepala Sekolah">
      </div>
      <div class="right-side">
        <p>Assalamu’alaikum warahmatullahi wabarakatuh,</p>
        <p>Salam sejahtera bagi kita semua,</p><br>
        <p>Pertama-tama, marilah kita panjatkan puji syukur ke hadirat Allah SWT, Tuhan Yang Maha Esa, karena atas
          rahmat dan hidayah-Nya kita masih diberikan kesehatan dan kesempatan untuk terus berkarya dan berinovasi
          demi masa depan yang lebih baik.</p>
        <p>Selamat datang di halaman Bursa Kerja Khusus (BKK) SMKN 1 Boyolangu. Kami hadir sebagai jembatan penghubung
          antara dunia pendidikan dan dunia industri. Dalam era globalisasi ini, persaingan di dunia kerja semakin
          ketat, dan tuntutan terhadap tenaga kerja yang kompeten dan terampil semakin tinggi. Untuk itu, BKK SMKN 1
          Boyolangu berperan penting dalam mempersiapkan dan memfasilitasi lulusan kami agar siap memasuki dunia kerja
          dengan bekal pengetahuan, keterampilan, dan etika kerja yang unggul.</p>
        <p>SMKN 1 Boyolangu terus berkomitmen dalam memberikan pendidikan berkualitas yang relevan dengan kebutuhan
          industri. Melalui BKK ini, kami tidak hanya mendampingi mereka, tetapi juga menciptakan hubungan yang erat
          dengan berbagai perusahaan mitra, sehingga kami dapat menyelaraskan kompetensi yang diajarkan di sekolah
          dengan standar yang dibutuhkan oleh dunia kerja.</p>
        <p>Kami berharap, dengan adanya BKK ini, lulusan SMKN 1 Boyolangu dapat bersaing lebih baik di dunia kerja dan
          menjadi tenaga kerja yang profesional, kompeten, dan berdaya saing. BKK ini juga menjadi wadah bagi
          perusahaan-perusahaan untuk menemukan tenaga kerja yang sesuai dengan kebutuhan mereka.</p>
        <p>Akhir kata, saya mengucapkan terima kasih kepada seluruh pihak yang telah mendukung pengembangan BKK SMKN 1
          Boyolangu. Semoga kerjasama ini terus berlanjut dan semakin kuat demi terciptanya generasi penerus yang
          berkualitas dan mampu bersaing di tingkat nasional maupun internasional.</p>
        <p>Wassalamu’alaikum warahmatullahi wabarakatuh.</p>


        <div class="footer">
          <p>Boyolangu, [tanggal]</p>
          <p>Kepala Sekolah SMKN 1 Boyolangu</p>
          <p>( Trisno Wibowo S. Pd. M. M )</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
