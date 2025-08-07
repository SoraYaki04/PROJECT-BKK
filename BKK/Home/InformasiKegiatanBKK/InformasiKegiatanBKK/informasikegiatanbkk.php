<?php
require_once __DIR__ . '/../../config/helpers.php';

allow_role(['admin', 'alumni']);

// ? Pagination setup
$limit = 6; // ! Jumlah kegiatan per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// TODO Hitung total kegiatan
$total_result = $koneksi->query("SELECT COUNT(*) AS total FROM berita");
$total_row = $total_result->fetch_assoc();
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// TODO Ambil data kegiatan
$result = $koneksi->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT $limit OFFSET $offset");
$start = $offset + 1;
$end = $offset + $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../../navbar/navbar.css" />
  <link rel="stylesheet" href="informasikegiatanbkk.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>

  <?php include '../../navbar/header.php' ?>

  <div class="container">

    <!-- // ?  NAVBAR -->
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

      <?php
      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
          $id = $row['id_berita'];
          $judul = htmlspecialchars($row['judul']);
          $tanggal = htmlspecialchars($row['tanggal']);
          $jml_peserta = htmlspecialchars($row['jml_peserta']);
          $lokasi = htmlspecialchars($row['lokasi']);
          $deskripsi = htmlspecialchars($row['deskripsi']);
          $gambar = htmlspecialchars($row['gambar']);
      ?>
          <div class="activity-card">
            <div class="activity-header">
              <h2><?= $judul ?></h2>
            </div>
            <div class="activity-content">
              <div class="images">
                <img src="<?= base_url('uploads/kegiatan/' . htmlspecialchars($row['gambar'])) ?>" alt="tidak tersedia">
              </div>
              <hr>
              <div class="description">
                <?= $deskripsi ?>
              </div>
            </div>
            <div class="activity-footer">
<button class="detail-button" onclick="openPopup(<?= htmlspecialchars(json_encode([
  'id' => $id,
  'judul' => $judul,
  'tanggal' => $tanggal,
  'jml_peserta' => $jml_peserta,
  'lokasi' => $lokasi,
  'deskripsi' => $deskripsi,
  'gambar' => htmlspecialchars($row['gambar']),
])) ?>)">
  <i class="fas fa-list"></i> DETAIL
</button>
            </div>
          </div>

        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-data" style="text-align:center; font-weight:bold; color:#666;">Tidak ada lowongan kerja yang tersedia.</p>
      <?php endif; ?>
    </div>





    <!-- // ? PAGINATION -->
    <div class="pagination-container">
      <div class="pagination-info">
        <p>Ditampilkan <strong><?= $start ?></strong> sampai <strong><?= $end ?></strong> dari total <strong><?= $total ?></strong> kegiatan</p>
      </div>
      <div class="pagination">
        <?php if ($page > 1): ?>
          <a class="navigate" href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a class="navigate" href="?page=<?= $page + 1 ?>">Next &raquo;</a>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <!-- // ? POPUP DETAIL -->
  <div class="popup" id="popup-detail">
    <div class="overlay" onclick="togglePopup('popup-detail')"></div>
    <div class="card-popup">
      <input type="hidden" name="id_berita" id="popup-id">

      <div class="popup-header">
        <h1 id="popup-judul"></h1>
      </div>

      <div class="popup-content">
        <div class="popup-imgbox">
          <div class="img-container">
            <img id="popup-gambar" src="#" alt="Gambar Tidak Tersedia">
          </div>
        </div>

        <div class="popup-detail">
          <div class="popup-info">
            <div class="icon"><i class="fa-regular fa-clock fa-xl"></i></div>
            <div class="teks">
              <h5>Tanggal Kegiatan</h5>
              <p id="popup-tanggal"></p>
            </div>
          </div>
          <div class="popup-info">
            <div class="icon"><i class="fa-solid fa-users fa-xl"></i></div>
            <div class="teks">
              <h5>Jumlah Peserta</h5>
              <p id="popup-jml_peserta"></p>
            </div>
          </div>
          <div class="popup-info">
            <div class="icon"><i class="fa-solid fa-location-dot fa-xl"></i></div>
            <div class="teks">
              <h5>Lokasi</h5>
              <p id="popup-lokasi"></p>
            </div>
          </div>

          <div class="popup-description">
            <h4>Deskripsi Kegiatan</h4>
            <div id="popup-deskripsi"></div>
          </div>
        </div>

      </div>
    </div>
  </div>


<script>

    // ? POPUP
    function openPopup(data) {
        // ! Isi data ke dalam popup
        document.getElementById('popup-id').value = data.id;
        document.getElementById('popup-judul').textContent = data.judul;
        document.getElementById('popup-tanggal').textContent = data.tanggal;
        document.getElementById('popup-jml_peserta').textContent = data.jml_peserta;
        document.getElementById('popup-lokasi').textContent = data.lokasi;
        document.getElementById('popup-deskripsi').innerHTML = data.deskripsi;
        
        const gambar = document.getElementById('popup-gambar');
        if (data.gambar) {
            gambar.src = '<?= base_url("uploads/kegiatan/") ?>' + data.gambar;
            gambar.style.display = 'block';
        } else {
            gambar.style.display = 'none';
        }
        
        // ! Tampilkan popup
        togglePopup('popup-detail');
    }
    function togglePopup(popupId) {
        document.getElementById(popupId).classList.toggle("active");
    }


    // ? SMOOTH ANIMATION
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