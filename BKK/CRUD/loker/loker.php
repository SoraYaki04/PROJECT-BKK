<?php
require_once __DIR__ . '/../../config/helpers.php';

allow_role(['admin', 'alumni']);


// TODO Ambil nilai filter
$jurusan_filter = isset($_GET['jurusan']) ? trim($_GET['jurusan']) : '';
$lokasi_filter = isset($_GET['lokasi']) ? trim($_GET['lokasi']) : '';

// TODO Pagination
$limit = 6; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// TODO Mengambil input pengguna
$where = "WHERE 1";
$params = [];
if ($jurusan_filter !== '') {
    $where .= " AND jurusan.jurusan LIKE ?";
    $params[] = "%$jurusan_filter%";
}
if ($lokasi_filter !== '') {
    $where .= " AND lowker.lokasi LIKE ?";
    $params[] = "%$lokasi_filter%";
}

// TODO hitung data yang muncul
$count_stmt = $koneksi->prepare("
    SELECT COUNT(*) AS total
    FROM lowker
    JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
    JOIN jurusan ON lowker.id_jurusan = jurusan.id_jurusan
    $where
");
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $count_stmt->bind_param($types, ...$params);
}
$count_stmt->execute();
$total_result = $count_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// TODO Ambil data lowongan
$sql = "
    SELECT lowker.*, 
           perusahaan.nama AS nama_perusahaan, 
           jurusan.jurusan AS nama_jurusan
    FROM lowker
    JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
    JOIN jurusan ON lowker.id_jurusan = jurusan.id_jurusan
    $where
    ORDER BY lowker.tgl_posting DESC
    LIMIT ? OFFSET ?
";

$stmt = $koneksi->prepare($sql);
$types = str_repeat('s', count($params)) . 'ii';
$params[] = $limit;
$params[] = $offset;
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../../partials/navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="loker.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

<?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
  <div class="floating-notif <?= isset($_SESSION['success']) ? 'success' : 'error' ?>">
    <?= htmlspecialchars($_SESSION['success'] ?? $_SESSION['error']) ?>
  </div>
  <?php unset($_SESSION['success'], $_SESSION['error']); ?>
<?php endif; ?>


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
    }
    ?>
  

    <div class="header-bar">
      <a href="#">Lowongan Kerja</a>
    </div>

  <div class="search-container">
    <form method="GET" class="search">
      <label for="jurusan">Pencarian:</label>
      <select id="jurusan" name="jurusan" class="search-select">
        <option value="">SEMUA KATEGORI/JURUSAN</option>
        <?php
        $jurusan_list = 
        [ 'Akuntansi',
          'Animasi',
          'Bisnis Digital',
          'Desain Komunikasi Visual',
          'Manajemen Perkantoran',
          'Progam Siaran Penyiaran Televisi',
          'Rekayasa Perangkat Lunak',
          'Teknik kimia Industri',
          'Teknik Komputer Jaringan',
          'Usaha Layanan Wisata'];
        foreach ($jurusan_list as $j):
        ?>
        <option value="<?= $j ?>" <?= $jurusan_filter == $j ? 'selected' : '' ?>><?= $j ?></option>
        <?php endforeach; ?>
      </select>
      <input type="text" class="search-input" name="lokasi" placeholder="Masukkan Lokasi" value="<?= htmlspecialchars($lokasi_filter) ?>">
      <button class="search-button" type="submit">Cari</button>
    </form>
  </div>

 <div class="job-list">
  <div class="job-card" id="tambah-loker">
    <div class="tambah-btn">
    <a href="loker-tambah.php">
      <i class="fa-solid fa-plus fa-2xl"></i>
      <p>Tambahkan Lowongan Kerja</p>
    </a>
    </div>

  </div>

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
        <a href="loker-hapus.php?id=<?= $row['id_lowker'] ?>" onclick="return confirm('Yakin ingin menghapus lowongan ini?');" >
          <button class="delete-button"><i class="fas fa-trash"></i> HAPUS</button>
        </a>
        <a href="loker-edit.php?id=<?= $row['id_lowker'] ?>" >
          <button class="edit-button"><i class="fas fa-plus"></i> EDIT</button>
        </a>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="no-data" style="text-align:center; font-weight:bold; color:#666;">Tidak ada lowongan kerja yang tersedia.</p>
  <?php endif; ?>
  </div>


    <?php
      $start = $offset + 1;
      $end = $offset + $result->num_rows;
      $total = $total_row['total'];
      ?>

    <div class="pagination-container">
      <div class="pagination-info">
        <p>Ditampilkan <strong><?= $start ?></strong>  sampai <strong><?= $end ?></strong> dari total <strong><?= $total ?></strong> lowongan</p>
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