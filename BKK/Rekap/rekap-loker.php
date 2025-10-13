<?php
require_once __DIR__ . '/../config/helpers.php';

allow_role(['admin', 'alumni', 'siswa']);

// Filters
$perusahaan_filter = isset($_GET['perusahaan']) ? trim($_GET['perusahaan']) : '';
$lokasi_filter = isset($_GET['lokasi']) ? trim($_GET['lokasi']) : '';
$waktu_filter = isset($_GET['waktu']) ? trim($_GET['waktu']) : '';

// Dropdown data
$perusahaan_list = [];
$lokasi_list = [];

// Perusahaan list
$q_perusahaan = $koneksi->query("SELECT id_perusahaan, nama FROM perusahaan ORDER BY nama ASC");
if ($q_perusahaan) {
  while ($row = $q_perusahaan->fetch_assoc()) {
    $perusahaan_list[] = $row;
  }
}

// Lokasi list from lowker
$q_lokasi = $koneksi->query("SELECT DISTINCT lokasi FROM lowker WHERE lokasi IS NOT NULL AND lokasi <> '' ORDER BY lokasi ASC");
if ($q_lokasi) {
  while ($row = $q_lokasi->fetch_assoc()) {
    $lokasi_list[] = $row['lokasi'];
  }
}

// Build WHERE for totals and ON for rekap by jurusan (to keep zero counts)
$where = "WHERE 1"; // used for totals
$on = "lowker.id_jurusan = jurusan.id_jurusan"; // used for LEFT JOIN rekap by jurusan
$params = [];
$types = '';

if ($perusahaan_filter !== '') {
  $where .= " AND lowker.id_perusahaan = ?";
  $on   .= " AND lowker.id_perusahaan = ?";
  $params[] = (int)$perusahaan_filter;
  $types .= 'i';
}
if ($lokasi_filter !== '') {
  $where .= " AND lowker.lokasi LIKE ?";
  $on   .= " AND lowker.lokasi LIKE ?";
  $params[] = "%$lokasi_filter%";
  $types .= 's';
}
if ($waktu_filter !== '') {
  if ($waktu_filter === 'today') {
    $where .= " AND DATE(lowker.tgl_posting) = CURDATE()";
    $on   .= " AND DATE(lowker.tgl_posting) = CURDATE()";
  } elseif ($waktu_filter === '3days') {
    $where .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
    $on   .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
  } elseif ($waktu_filter === '1week') {
    $where .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
    $on   .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
  } elseif ($waktu_filter === '1month') {
    $where .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    $on   .= " AND lowker.tgl_posting >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
  }
}

// Rekap by jurusan
$rekap_jurusan = [];
$stmt_rekap = $koneksi->prepare(
  "SELECT jurusan.jurusan AS nama_jurusan, COUNT(lowker.id_lowker) AS jumlah
   FROM jurusan
   LEFT JOIN lowker ON $on
   GROUP BY jurusan.id_jurusan, jurusan.jurusan
   ORDER BY jurusan.jurusan ASC"
);
if ($types !== '') { $stmt_rekap->bind_param($types, ...$params); }
$stmt_rekap->execute();
$res_rekap = $stmt_rekap->get_result();
while ($row = $res_rekap->fetch_assoc()) { $rekap_jurusan[] = $row; }
$stmt_rekap->close();

// Totals
$total_lowongan = 0;
$total_perusahaan = 0;
$stmt_total = $koneksi->prepare(
  "SELECT COUNT(*) AS total, COUNT(DISTINCT lowker.id_perusahaan) AS perusahaan
   FROM lowker
   $where"
);
if ($types !== '') { $stmt_total->bind_param($types, ...$params); }
$stmt_total->execute();
$res_total = $stmt_total->get_result();
if ($res_total && $res_total->num_rows) {
  $row = $res_total->fetch_assoc();
  $total_lowongan = (int)$row['total'];
  $total_perusahaan = (int)$row['perusahaan'];
}
$stmt_total->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../partials/navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="rekap-loker.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <div class="header-bar">
      <a href="#">Rekap Lowongan Kerja</a>
    </div>

    <div class="rekap-container">
        <div class="filter-container">
            <h2>REKAPITULASI DATA LOWONGAN KERJA</h2>
            <form class="filter-box" method="get" action="">
              <select name="perusahaan">
                <option value="" <?= $perusahaan_filter === '' ? 'selected' : '' ?>>perusahaan</option>
                <?php foreach ($perusahaan_list as $p): ?>
                  <option value="<?= (int)$p['id_perusahaan'] ?>" <?= ($perusahaan_filter !== '' && (int)$perusahaan_filter === (int)$p['id_perusahaan']) ? 'selected' : '' ?>><?= htmlspecialchars($p['nama']) ?></option>
                <?php endforeach; ?>
              </select>
              
              <select name="lokasi">
                <option value="" <?= $lokasi_filter === '' ? 'selected' : '' ?>>lokasi</option>
                <?php foreach ($lokasi_list as $lok): ?>
                  <option value="<?= htmlspecialchars($lok) ?>" <?= ($lokasi_filter !== '' && $lokasi_filter === $lok) ? 'selected' : '' ?>><?= htmlspecialchars($lok) ?></option>
                <?php endforeach; ?>
              </select>
              
              <select name="waktu">
                <option value="" <?= $waktu_filter === '' ? 'selected' : '' ?>>terdaftar kapan saja</option>
                <option value="today" <?= $waktu_filter === 'today' ? 'selected' : '' ?>>Hari ini</option>
                <option value="3days" <?= $waktu_filter === '3days' ? 'selected' : '' ?>>3 hari lalu</option>
                <option value="1week" <?= $waktu_filter === '1week' ? 'selected' : '' ?>>1 minggu lalu</option>
                <option value="1month" <?= $waktu_filter === '1month' ? 'selected' : '' ?>>1 bulan lalu</option>
              </select>
              
              <button type="submit">Cari</button>
            </form>
          </div>
          
        <h2>REKAPITULASI</h2>
        <div class="rekap-grid">
          <?php if (!empty($rekap_jurusan)): ?>
            <?php foreach ($rekap_jurusan as $r): ?>
              <div class="rekap-item"><span class="jurusan"><?= htmlspecialchars($r['nama_jurusan']) ?></span><br><span class="rekap"><?= (int)$r['jumlah'] ?> lowongan</span></div>
            <?php endforeach; ?>
          <?php else: ?>
            <p style="grid-column: 1/-1; text-align:center; color:#666;">Tidak ada data untuk filter yang dipilih.</p>
          <?php endif; ?>
        </div>
        <div class="rekap-total">
          <p>Jumlah lowongan terdaftar : <strong><?= $total_lowongan ?></strong></p>
          <p>Jumlah perusahaan terdaftar : <strong><?= $total_perusahaan ?></strong></p>
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
