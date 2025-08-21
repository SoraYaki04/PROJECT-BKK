<?php
require_once __DIR__ . '/../config/helpers.php';


// TODO Pagination setup
$limit = 6; // ! Jumlah perusahaan per halaman
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;


// TODO Filter search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$kategori_filter = $_GET['kategori'] ?? '';

$sql_count = "SELECT COUNT(*) AS total FROM perusahaan WHERE 1=1";

if ($search !== '') {
  $sql_count .= " AND (nama LIKE '%" . $koneksi->real_escape_string($search) . "%'
                 OR alamat LIKE '%" . $koneksi->real_escape_string($search) . "%'
                 OR kota LIKE '%" . $koneksi->real_escape_string($search) . "%')";
}
if ($kategori_filter !== '') {
  $sql_count .= " AND kategori = '" . $koneksi->real_escape_string($kategori_filter) . "'";
}

// TODO Hitung total data
$total_result = $koneksi->query($sql_count);
$total_row = $total_result->fetch_assoc();
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// ? Query data perusahaan
$sql = "SELECT * FROM perusahaan WHERE 1=1";

if ($search !== '') {
  $sql .= " AND (nama LIKE '%" . $koneksi->real_escape_string($search) . "%'
           OR alamat LIKE '%" . $koneksi->real_escape_string($search) . "%'
           OR kota LIKE '%" . $koneksi->real_escape_string($search) . "%')";
}

// TODO Filter kategori
if ($kategori_filter !== '') {
  $sql .= " AND kategori = '" . $koneksi->real_escape_string($kategori_filter) . "'";
}


// TODO Urutkan & pagination
$sql .= " ORDER BY id_perusahaan DESC LIMIT $limit OFFSET $offset";

$result = $koneksi->query($sql);

$start = $offset + 1;
$end = $offset + $result->num_rows;


// TODO Fungsi ambil enum dari kolom
function getEnumValues($conn, $table, $column)
{
  $enum = [];
  $query = "SHOW COLUMNS FROM $table LIKE '$column'";
  $result = $conn->query($query);
  if ($result) {
    $row = $result->fetch_assoc();
    if (preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches)) {
      $enum = explode("','", $matches[1]);
    }
  }
  return $enum;
}

// TODO Ambil enum standar
$standar_list = getEnumValues($koneksi, 'perusahaan', 'standar');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="perusahaan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <div class="header-bar">
      <a href="#">Perusahaan</a>
    </div>



    <div class="search-container">
      <form method="GET" action="">
        <div class="search">
          <label for="search">Pencarian:</label>
          <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />

          <label for="category">Kategori:</label>
          <select name="kategori" id="category" class="search-select">
            <option value="">-- Semua Kategori --</option>
            <?php
            // Ambil daftar enum kategori langsung dari DB
            $q = $koneksi->query("SHOW COLUMNS FROM perusahaan LIKE 'kategori'");
            $row = $q->fetch_assoc();
            preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches);
            $kategori_list = explode("','", $matches[1]);

            $kategori_filter = $_GET['kategori'] ?? '';
            foreach ($kategori_list as $k):
            ?>
              <option value="<?= $k ?>" <?= $kategori_filter == $k ? 'selected' : '' ?>><?= $k ?></option>
            <?php endforeach; ?>
          </select>

          <button class="search-button" type="submit">Cari</button>
        </div>
      </form>
    </div>

    <?php
    // setelah $result = $koneksi->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    ?>

    <div class="company-container"
      <?php if (count($data) < 5) echo 'style="display:none;"'; ?>>

      <div class="company-list">
        <?php foreach ($data as $row): ?>
          <?php $popup_id = "popup-" . $row['id_perusahaan']; ?>
          <div class="company-item" data-index="<?= $row['id_perusahaan'] ?>">
            <img src="<?= base_url('uploads/perusahaan/' . htmlspecialchars($row['gambar'])) ?>" alt="tidak tersedia">

            <div class="company-detail">
              <h2><?= htmlspecialchars($row['nama']) ?></h2>
              <button class="detail-btn" onclick="togglePopup('popup-<?= $row['id_perusahaan'] ?>')">
                <i class="fa-solid fa-list"></i> Detail Penelusuran
              </button>


              </button>
            </div>
          </div>

        <?php endforeach; ?>
      </div>


      <div class="company-controls"
        <?php if (count($data) < 5) echo 'style="display:none;"'; ?>>
      </div>

    </div>

    <div class="search-result-container">
      <div class="search-result-list">
        <?php if (count($data) > 0): ?>

          <?php
          $no = 1;
          foreach ($data as $row):
            $popup_id = "popup-" . $row['id_perusahaan'];
          ?>
            <div class="perusahaan-card">
              <div class="perusahaan-img">
                <div class="image-overlay"></div>
                <img src="<?= base_url('uploads/perusahaan/' . htmlspecialchars($row['gambar'])) ?>" alt="tidak tersedia">
              </div>
              <div class="perusahaan-content">
                <div class="perusahaan-info">
                  <h1 class="perusahaan-nama"><?php echo htmlspecialchars($row['nama']); ?></h1>
                  <div class="perusahaan-detail">
                    <span class="detail-item"><i class="fas fa-map-marker-alt"></i>
                      <?php echo htmlspecialchars($row['alamat']); ?>, <?php echo htmlspecialchars($row['kota']); ?>
                    </span>
                    <span class="detail-item"><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($row['kategori']); ?></span>
                    <span class="detail-item"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($row['email']); ?></span>
                  </div>
                </div>
                <div class="perusahaan-actions">
                  <button class="detail-btn-search-result edit-btn" onclick="togglePopup('<?= $popup_id ?>')">
                    <i class="fas fa-list"></i> DETAIL
                  </button>
                </div>
              </div>
              <div class="desc-overlay"></div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="no-data" style="text-align:center; font-weight:bold; color:#666;">Tidak ada perusahaan yang tersedia.</p>
        <?php endif; ?>
      </div>
    </div>



    <!-- // ? PAGINATION -->
    <div class="pagination-container">
      <div class="pagination-info">
        <p>Ditampilkan <strong><?= $start ?></strong> sampai <strong><?= $end ?></strong> dari total <strong><?= $total ?></strong> perusahaan</p>
      </div>
      <div class="pagination">
        <?php if ($page > 1): ?>
          <a class="navigate" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori_filter) ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori_filter) ?>"
            class="<?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
          </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
          <a class="navigate" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori_filter) ?>">Next &raquo;</a>
        <?php endif; ?>
      </div>
    </div>

    <!-- // ? POPUP -->
    <?php foreach ($data as $row): ?>
      <div class="popup" id="popup-<?= $row['id_perusahaan'] ?>">
        <div class="overlay" onclick="togglePopup('popup-<?= $row['id_perusahaan'] ?>')"></div>
        <div class="company-popup">
          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-<?= $row['id_perusahaan'] ?>')">&times;</button>
          </div>
          <div class="popup-content">
            <div class="company-header-popup">
              <h1><?= htmlspecialchars($row['nama']) ?></h1>
              <p><?= htmlspecialchars($row['deskripsi_perusahaan']); ?></p>
            </div>

            <hr>

            <div class="company-detail-popup">
              <table>
                <tr>
                  <td>Nama</td>
                  <td>: <?= htmlspecialchars($row['nama']); ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>: <?= htmlspecialchars($row['alamat']); ?></td>
                </tr>
                <tr>
                  <td>Kota</td>
                  <td>: <?= htmlspecialchars($row['kota']); ?></td>
                </tr>
                <tr>
                  <td>Kontak</td>
                  <td>: <?= htmlspecialchars($row['kontak']); ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: <?= htmlspecialchars($row['email']); ?></td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>: <?= htmlspecialchars($row['kategori']); ?></td>
                </tr>
                <tr>
                  <td>Standar</td>
                  <td>: <?= htmlspecialchars($row['standar']); ?></td>
                </tr>
              </table>
            </div>

            <div class="company-table-popup">
              <table>
                <tr>
                  <th>No</th>
                  <th>Kerjasama</th>
                </tr>
                <?php
                $kerjaList = preg_split("/[\r\n]+/", $row['kerja_sama']);
                $kerjaNo = 1;
                foreach ($kerjaList as $item) {
                  $item = trim($item);
                  if (!empty($item)) {
                    echo "<tr><td>{$kerjaNo}</td><td>{$item}</td></tr>";
                    $kerjaNo++;
                  }
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>


  </div>



  <script>
    //  TODO SMOOTH ANIMATION
    const content = document.querySelectorAll(".perusahaan-card");
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("show");
          }
        });
      }, {
        threshold: 0.1,
      }
    );

    content.forEach((content) => {
      observer.observe(content);
    });
  </script>

  <script src="perusahaan.js"></script>

</body>

</html>