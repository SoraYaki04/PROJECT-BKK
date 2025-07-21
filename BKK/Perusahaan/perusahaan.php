<?php
include '../koneksi.php';

$result = $koneksi->query("SELECT * FROM perusahaan");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="perusahaan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
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
    <nav class="navbar">
      <!-- data-feather="chevron-down"> -->
      <ul class="navbar-container">
        <li>
          <a href="../Home/Halaman Utama/berandautama.html" class="">HOME<i class="fa-solid fa-chevron-down"></i></a>
          <ul class="dropdown">
            <li><a href="../Home/Halaman Utama/berandautama.html">Halaman Utama</a></li>
            <li><a href="../Home/Pengantar/pengantar.html">Pengantar</a></li>
            <li><a href="../Home/Informasi Kegiatan BKK/informasikegiatanbkk.html">Informasi Kegiatan BKK</a></li>
            <li><a href="../Home/Halaman Utama/rekapitulasi.html">Rekapitulasi</a></li>
          </ul>
        </li>

        <li><a href="#">TENTANG KAMI<i class="fa-solid fa-chevron-down"></i></a>
          <ul class="dropdown">
            <li><a href="../Tentang Kami/visimisi.php">Visi Misi</a></li>
            <li><a href="../Tentang Kami/proker.php">Progam Kerja BKK</a></li>
            <li><a href="../Tentang Kami/tujuan.php">Tujuan</a></li>
            <li><a href="../Tentang Kami/strukturorganisasi.php">Struktur Organisasi</a></li>
          </ul>
        </li>

        <li><a href="#">LOGIN<i class="fa-solid fa-chevron-down"></i></a>
          <ul class="dropdown">
            <li><a href="../Login/admin-login.html">Admin BKK</a></li>
            <li><a href="../Login/management-login.html">Management</a></li>
            <li><a href="../Login/siswa-alumni-login.html">Siswa / Alumni</a></li>
            <li><a href="../Login/pengguna-lain-login.html">Partisipan Lain</a></li>
          </ul>
        </li>

        <li><a href="../Informasi Jurusan/informasiJurusan.php">INFORMASI JURUSAN</a></li>
        <li><a href="#" class="active">PERUSAHAAN</a></li>
        <li><a href="../Lowker/loker.php">LOWONGAN KERJA</a></li>
      </ul>


    </nav>

    <section>
      <div class="header-bar">
        <a href="#">Perusahaan</a>
      </div>
      <div class="search-container">

        <div class="search">
          <label for="category">Pencarian:</label>
          <input type="input" name="search">
          <button class="search-button">Cari</button>

          <label for="category">Kategori:</label>
          <select id="category" class="search-select">
            <option value="UMKN">UMKM</option>
            <option value="MOU">MOU</option>
            <option value="START-UP">START UP</option>
            <option value="PERSEROAN-TERBATAS">PERSEROAN TERBATAS</option>
          </select>

          <button class="search-button">Cari</button>
        </div>

      </div>
      <div class="company-container">

        <div class="company-list">

          <?php 
      $no = 1;
      while($row = $result->fetch_assoc()):
        $imgData = base64_encode($row['gambar']);
        $popup_id = "popup-" . $no;
      ?>

          <div class="company-item company-item-<?= $no ?>" data-index="<?= $no ?>">
            <img src="data:image/png;base64,<?= $imgData ?>" alt="<?= htmlspecialchars($row['nama']) ?>" />

            <div class="company-detail company-detail-<?= $no ?>" data-index="<?= $no ?>">
              <h2><?= htmlspecialchars($row['nama']) ?></h2>
              <button onclick="togglePopup('<?= $popup_id ?>')" class="detail-btn">
                <i class="fa-solid fa-list"></i> Detail Penelusuran
              </button>
            </div>
          </div>


          <!-- POPUP -->
          <div class="popup" id="<?php echo $popup_id; ?>">
            <div class="company-popup">
              <div class="close-popup">
                <button class="close-btn" onclick="togglePopup('<?php echo $popup_id; ?>')">&times;</button>
              </div>
              <div class="company-header-popup">
                <div class="company-title-popup">
                  <h1><?php echo $row['nama']; ?></h1>
                </div>
                <div class="company-desc-popup">
                  <p><?php echo $row['deskripsi_perusahaan']; ?></p>
                </div>
              </div>

              <hr>

              <div class="company-detail-popup">
                <table>
                  <tr>
                    <td class="company-detail-left">Nama Perusahaan</td>
                    <td class="company-detail-rigth">: <?php echo $row['nama']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Alamat</td>
                    <td class="company-detail-rigth">: <?php echo $row['alamat']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kota</td>
                    <td class="company-detail-rigth">: <?php echo $row['kota']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kontak</td>
                    <td class="company-detail-rigth">: <?php echo $row['kontak']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Email</td>
                    <td class="company-detail-rigth">: <?php echo $row['email']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kategori</td>
                    <td class="company-detail-rigth">: <?php echo $row['kategori']; ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Standar</td>
                    <td class="company-detail-rigth">: <?php echo $row['standar']; ?></td>
                  </tr>
                </table>
              </div>

              <div class="company-table-popup">
                <table>
                  <tr>
                    <th class="table-number">No</th>
                    <th width="970px">Kerjasama</th>
                  </tr>

                  <?php
            $kerjaList = preg_split("/[\r\n]+/", $row['kerja_sama']); 
            $kerjaNo = 1;
            foreach ($kerjaList as $item) {
                $item = trim($item);
                if (!empty($item)) {
                    echo "<tr>
                            <td class='table-number'>{$kerjaNo}</td>
                            <td>{$item}</td>
                          </tr>";
                    $kerjaNo++;
                }
            }
            ?>
                </table>
              </div>
            </div>
          </div>

          <?php 
    $no++;
    endwhile; 
?>

        </div>

        <div class="company-controls">

        </div>

      </div>
    </section>

  </div>

  <script src="perusahaan.js"></script>

</body>

</html>
