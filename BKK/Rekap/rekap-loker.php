<?php
require_once __DIR__ . '/../config/helpers.php';


allow_role(['admin']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="rekap-loker.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

  <?php include '../navbar/header.php' ?>

  <div class="container"> 

      <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
        include 'navbar/guest.php';
    } elseif (is_alumni()) {
        include '../navbar/alumni.php';
    } elseif (is_admin()) {
        include '../navbar/admin.php';
    }
    ?>

    <div class="header-bar">
      <a href="#">Rekap Lowongan Kerja</a>
    </div>

    <div class="rekap-container">
        <div class="filter-container">
            <h2>REKAPITULASI DATA LOWONGAN KERJA</h2>
            <div class="filter-box">
              
              <select name="perusahaan">
                <option disabled selected>perusahaan</option>
                <option>UD. Bintang</option>
                <option>PT. Maju Jaya</option>
                <option>CV. Karya Abadi</option>
                <option>PT. Sejahtera</option>
              </select>
              
              <select name="lokasi">
                <option disabled selected>lokasi</option>
                <option>Tulungagung</option>
                <option>Blitar</option>
                <option>Malang</option>
                <option>Surabaya</option>
              </select>
              
              <select name="jenis">
                <option disabled selected>jenis</option>
                <option>Kontrak</option>
                <option>Full Time</option>
                <option>Part Time</option>
                <option>Magang</option>
              </select>
              
              <select name="waktu">
                <option disabled selected>terdaftar kapan saja</option>
                <option>Hari ini</option>
                <option>3 hari lalu</option>
                <option>1 minggu lalu</option>
                <option>1 bulan lalu</option>
              </select>
              
              <button>Cari</button>
            </div>
          </div>
          
        <h2>REKAPITULASI</h2>
        <div class="rekap-grid">
          <div class="rekap-item"><span class="jurusan">TKI</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">RPL</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">TKJ</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">BD</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">MP</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">AK</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">ULW</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">DKV</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">PSPT</span><br><span class="rekap">100 lowongan</span></div>
          <div class="rekap-item"><span class="jurusan">ANM</span><br><span class="rekap">100 lowongan</span></div>
        </div>
        <div class="rekap-total">
          <p>Jumlah lowongan terdaftar : <strong>1000</strong></p>
          <p>Jumlah perusahaan terdaftar : <strong>500</strong></p>
        </div>
      </div>
      
  <script>
    const content = document.querySelectorAll('.rekap-container');

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
