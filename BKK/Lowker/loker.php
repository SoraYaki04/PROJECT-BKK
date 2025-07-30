<?php
require_once __DIR__ . '/../config/helpers.php';


// Hanya izinkan alumni
if (!is_alumni()) {
    echo "<h2 style='text-align:center; color:red;'>Akses ditolak. Halaman ini hanya untuk alumni.</h2>";
    exit;
}


$result = $koneksi->query("
  SELECT lowker.*, 
         perusahaan.nama AS nama_perusahaan, 
         jurusan.jurusan AS nama_jurusan
  FROM lowker
  JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
  JOIN jurusan ON lowker.id_jurusan = jurusan.id_jurusan
");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="loker.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        include 'navbar/guest.php';
    } elseif (is_alumni()) {
        include '../navbar/alumni.php';
    } elseif (is_admin()) {
        include '../navbar/admin.php';
    }
    ?>
  

    <div class="header-bar">
      <a href="#">Lowongan Kerja</a>
    </div>
    <div class="search-container">
      <div class="search">
        <label for="category">Pencarian:</label>
        <select id="category" class="search-select">
          <option value="">SEMUA KATEGORI/JURUSAN</option>
          <option value="TKJ">Teknik Komputer dan Jaringan</option>
          <option value="TKI">Teknik Kimia Industri</option>
          <option value="RPL">Rekayasa Perangkat Lunak</option>
          <option value="PM">Pemasaran</option>
          <option value="AKL">Akuntansi</option>
          <option value="MP">Manajemen Perkantoran</option>
          <option value="AN">Animasi</option>
          <option value="BP">Broadcasting</option>
          <option value="DKV">Desain Komunikasi Visual</option>
          <option value="ULW">Usaha Layanan Wisata</option>
        </select>
        <input type="text" class="search-input" placeholder="Masukkan Lokasi">
        <button class="search-button">Cari</button>
      </div>

    </div>

 <div class="job-list">
    <?php
  if ($result->num_rows > 0): 
    while ($row = $result->fetch_assoc()):
      $judul = htmlspecialchars($row['judul_lowker']);
      $perusahaan = htmlspecialchars($row['nama_perusahaan']);
      $jurusan = htmlspecialchars($row['nama_jurusan']);
      $lokasi = htmlspecialchars($row['lokasi']);
      $tgl_post = date('l, d M Y', strtotime($row['tgl_posting']));
      $tgl_exp = date('l, d M Y', strtotime($row['tgl_ditutup']));
    ?>
    <div class="job-card">
      <div class="job-header">
        <h3><?= $perusahaan ?></h3>
      </div>
      <div class="job-detail">
        <ul>
          <li><i class="fa-solid fa-building"></i><?= $perusahaan ?></li>
          <li><i class="fa-solid fa-location-dot"></i><?= $lokasi ?></li>
          <li><i class="fa-regular fa-clock"></i><?= $tgl_post ?></li>
          <li style="color: red;">exp date: <?= $tgl_exp ?></li>
        </ul>

        <p class="job-role"><?= htmlspecialchars($row['judul_lowker']) ?></p>
        <div class="line"></div>

        <div class="job-tags">
          <p><?= $jurusan ?></p>
        </div>
      </div>

      <div class="job-footer">
        <a href="detail-lowker.php?id=<?= $row['id_lowker'] ?>">
          <button class="detail-button"><i class="fas fa-info-circle"></i> DETAIL</button>
        </a>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="no-data" style="text-align:center; font-weight:bold; color:#666;">Tidak ada lowongan kerja yang tersedia.</p>
  <?php endif; ?>
  </div>
</div>


    <script>
      const cards = document.querySelectorAll('.job-card');

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