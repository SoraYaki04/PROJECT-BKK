<?php
require_once __DIR__ . '/../../config/helpers.php';

allow_role(['admin']);

// ? Pagination setup
$limit = 6; // ! Jumlah perusahaan per halaman
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// ? Ambil input filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$kategori_filter = $_GET['kategori'] ?? '';

// ? Base query hitung total
$sql_count = "SELECT COUNT(*) AS total FROM perusahaan WHERE 1=1";

// Filter search
if ($search !== '') {
  $sql_count .= " AND (nama LIKE '%" . $koneksi->real_escape_string($search) . "%'
                 OR alamat LIKE '%" . $koneksi->real_escape_string($search) . "%'
                 OR kota LIKE '%" . $koneksi->real_escape_string($search) . "%')";
}

// Filter kategori
if ($kategori_filter !== '') {
  $sql_count .= " AND kategori = '" . $koneksi->real_escape_string($kategori_filter) . "'";
}

// Hitung total data
$total_result = $koneksi->query($sql_count);
$total_row = $total_result->fetch_assoc();
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// ? Query data perusahaan
$sql = "SELECT * FROM perusahaan WHERE 1=1";

// Filter search
if ($search !== '') {
  $sql .= " AND (nama LIKE '%" . $koneksi->real_escape_string($search) . "%'
           OR alamat LIKE '%" . $koneksi->real_escape_string($search) . "%'
           OR kota LIKE '%" . $koneksi->real_escape_string($search) . "%')";
}

// Filter kategori
if ($kategori_filter !== '') {
  $sql .= " AND kategori = '" . $koneksi->real_escape_string($kategori_filter) . "'";
}

// Urutkan & pagination
$sql .= " ORDER BY id_perusahaan DESC LIMIT $limit OFFSET $offset";

$result = $koneksi->query($sql);

$start = $offset + 1;
$end = $offset + $result->num_rows;


// Fungsi ambil enum dari kolom
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

// Ambil enum standar
$standar_list = getEnumValues($koneksi, 'perusahaan', 'standar');

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../../navbar/navbar.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="perusahaan.css?v=<?php echo time(); ?>" />
  <link
    href="https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <?php include '../../navbar/header.php' ?>

  <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div
      class="floating-notif <?= isset($_SESSION['success']) ? 'success' : 'error' ?>">
      <?= htmlspecialchars($_SESSION['success'] ?? $_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['success'], $_SESSION['error']); ?>
  <?php endif; ?>

  <div class="container">
    <!--  // ? NAVBAR -->
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
      <a href="#">CRUD Perusahaan</a>
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


    <div class="perusahaan-list">

      <div class="perusahaan-card" id="tambah-perusahaan">
        <div class="tambah-btn" onclick="togglePopup('popup-tambah')" style="cursor: pointer;">
          <a>
            <i class="fa-solid fa-plus fa-2xl"></i>
            <p>Tambahkan Perusahaan</p>
          </a>
        </div>

      </div>

      <?php
      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
          $id = $row['id_perusahaan'];
          $nama = htmlspecialchars($row['nama']);
          $alamat = htmlspecialchars($row['alamat']);
          $kota = htmlspecialchars($row['kota']);
          $deskripsi_perusahaan = htmlspecialchars($row['deskripsi_perusahaan']);
          $kontak = htmlspecialchars($row['kontak']);
          $email = htmlspecialchars($row['email']);
          $gambar = base64_encode($row['gambar']);
          $standar = htmlspecialchars($row['standar']);
          $kategori = htmlspecialchars($row['kategori']);
          $kerja_sama = htmlspecialchars($row['kerja_sama']);
      ?>

          <div class="perusahaan-card">
            <div class="perusahaan-img">
              <div class="image-overlay"></div>
              <img src="<?= base_url('uploads/perusahaan/' . htmlspecialchars($row['gambar'])) ?>" alt="tidak tersedia">
            </div>
            <div class="perusahaan-content">
              <div class="perusahaan-info">
                <h1 class="perusahaan-nama"><?= $nama ?></h1>
                <div class="perusahaan-detail">
                  <span class="detail-item"><i class="fas fa-map-marker-alt"></i> <?= $alamat ?>, <?= $kota ?></span>
                  <span class="detail-item"><i class="fas fa-briefcase"></i><?= $kategori ?></span>
                  <span class="detail-item"><i class="fas fa-envelope"></i> <?= $email ?></span>
                </div>
              </div>
              <div class="perusahaan-actions">
                <button class="detail-btn edit-btn" data-perusahaan='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>' onclick='openEditPopup(this)'>
                  <i class="fas fa-pen-to-square"></i> EDIT
                </button>
                <a href="perusahaan-hapus.php?id=<?= $row['id_perusahaan'] ?>" onclick="return confirm('Yakin ingin menghapus perusahaan ini?');">
                  <button class="detail-btn hapus-btn"><i class="fas fa-trash"></i> HAPUS</button>
                </a>
              </div>
            </div>
            <div class="desc-overlay"></div>
          </div>

        <?php endwhile; ?>
      <?php else: ?>
        <p class="no-data" style="text-align:center; font-weight:bold; color:#666;">Tidak ada perusahaan yang tersedia.</p>
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


  <!-- // ? POP UP TAMBAH -->
  <div class="popup" id="popup-tambah">
    <div class="overlay" onclick="togglePopup('popup-tambah')"></div>
    <div class="company-popup">
      <form action="perusahaan-simpan.php" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="company-header-popup">
          <div class="company-title-popup">
            <h2>Tambah Perusahaan</h2>
          </div>

          <div class="popup-imgbox">
            <div class="img-preview" onclick="document.getElementById('gambar-input').click()">
              <div class="img-placeholder">
                <i class="fa-solid fa-plus fa-2xl"></i>
                <p>Tambah Foto Kegiatan</p>
              </div>
              <img id="preview" src="#" style="display: none;" alt="Preview">
            </div>

            <input type="file" id="gambar-input" name="gambar" accept="image/*" style="display: none;" onchange="previewGambar(event)">

          </div>

        </div>

        <hr>

        <div class="company-detail-popup">
          <table>
            <tr>
              <td class="company-deta il-left">Nama Perusahaan</td>
              <td class="company-detail-rigth" <p><input type="text" name="nama" placeholder="Masukkan Nama Perusahaan" required></td>
            </tr>
            <tr>
              <td class="company-detail-left">Deskripsi Perusahaan</td>
              <td class="company-detail-right">
                <textarea name="deskripsi_perusahaan" rows="5" placeholder="Masukkan Deskripsi Perusahaan" required></textarea>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Alamat</td>
              <td class="company-detail-right">
                <p><input type="text" name="alamat" placeholder="Masukkan Alamat Perusahaan" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kota</td>
              <td class="company-detail-right">
                <p><input type="text" name="kota" placeholder="Masukkan Kota" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kontak</td>
              <td class="company-detail-right">
                <p><input type="text" name="kontak" placeholder="Masukkan Kontak" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Email</td>
              <td class="company-detail-right">
                <p><input type="text" name="email" placeholder="Masukkan Email" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kategori</td>
              <td class="company-detail-right">
                <div class="form-input" id="perusahaan">
                  <select name="kategori" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori_list as $k): ?>
                      <option value="<?= $k ?>" <?= (isset($row_data['kategori']) && $row_data['kategori'] == $k) ? 'selected' : '' ?>>
                        <?= $k ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                </div>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Standar</td>
              <td class="company-detail-right">
                <div class="form-input" id="perusahaan">
                  <select name="standar" id="standar" required>
                    <option value="">-- Pilih Standar --</option>
                    <?php foreach ($standar_list as $s): ?>
                      <option value="<?= $s ?>" <?= (isset($row_data['standar']) && $row_data['standar'] == $s) ? 'selected' : '' ?>>
                        <?= $s ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </td>
            </tr>

            <tr>
              <td class="company-detail-left">Kerja Sama</td>
              <td class="company-detail-right">
                <textarea name="kerja_sama" rows="4" placeholder="Masukkan Kerja Sama Perusahaan" required></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="popup-footer">
          <button type="submit" class="save-btn">SIMPAN</button>
          <button type="button" class="close-btn" onclick="togglePopup('popup-tambah')">BATAL</button>
        </div>
      </form>
    </div>
  </div>


  <!-- // ? POP UP EDIT -->
  <div class="popup" id="popup-edit">
    <div class="overlay" onclick="togglePopup('popup-edit')"></div>
    <div class="company-popup">
      <form action="perusahaan-simpan.php" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id_perusahaan" id="edit-id">


        <div class="company-header-popup">
          <div class="company-title-popup">
            <h2>Edit Perusahaan</h2>
          </div>

          <div class="popup-imgbox">
            <div class="img-preview" onclick="document.getElementById('edit-gambar-input').click()">
              <div class="img-placeholder" id="edit-placeholder">
                <i class="fa-solid fa-plus fa-2xl"></i>
                <p>Tambah Foto Kegiatan</p>
              </div>
              <img id="edit-preview" src="#" style="display: none;" alt="Preview">
            </div>

            <input type="file" id="edit-gambar-input" name="gambar" accept="image/*" style="display: none;" onchange="previewEditGambar(event)">

          </div>

        </div>

        <hr>

        <div class="company-detail-popup">
          <table>
            <tr>
              <td class="company-deta il-left">Nama Perusahaan</td>
              <td class="company-detail-rigth" <p><input type="text" name="nama" id="edit-nama" placeholder="Masukkan Nama Perusahaan" required></td>
            </tr>
            <tr>
              <td class="company-detail-left">Deskripsi Perusahaan</td>
              <td class="company-detail-right">
                <textarea name="deskripsi_perusahaan" id="edit-deskripsi_perusahaan" rows="5" placeholder="Masukkan Deskripsi Perusahaan" required></textarea>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Alamat</td>
              <td class="company-detail-right">
                <p><input type="text" name="alamat" id="edit-alamat" placeholder="Masukkan Alamat Perusahaan" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kota</td>
              <td class="company-detail-right">
                <p><input type="text" name="kota" id="edit-kota" placeholder="Masukkan Kota" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kontak</td>
              <td class="company-detail-right">
                <p><input type="text" name="kontak" id="edit-kontak" placeholder="Masukkan Kontak" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Email</td>
              <td class="company-detail-right">
                <p><input type="text" name="email" id="edit-email" placeholder="Masukkan Email" required>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Kategori</td>
              <td class="company-detail-right">
                <div class="form-input" id="perusahaan">
                  <select name="kategori" id="edit-kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori_list as $k): ?>
                      <option value="<?= $k ?>" <?= ($row_data['kategori'] ?? '') === $k ? 'selected' : '' ?>>
                        <?= $k ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                </div>
              </td>
            </tr>
            <tr>
              <td class="company-detail-left">Standar</td>
              <td class="company-detail-right">
                <div class="form-input" id="perusahaan">
                  <select name="standar" id="edit-standar" required>
                    <option value="">-- Pilih Standar --</option>
                    <?php foreach ($standar_list as $s): ?>
                      <option value="<?= $s ?>" <?= ($row_data['standar'] ?? '') === $s ? 'selected' : '' ?>>
                        <?= $s ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                </div>
              </td>
            </tr>

            <tr>
              <td class="company-detail-left">Kerja Sama</td>
              <td class="company-detail-right">
                <textarea name="kerja_sama" id="edit-kerja_sama" rows="4" placeholder="Masukkan Kerja Sama Perusahaan" required></textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="popup-footer">
          <button type="submit" class="save-btn">SIMPAN</button>
          <button type="button" class="close-btn" onclick="togglePopup('popup-edit')">BATAL</button>
        </div>
      </form>
    </div>
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

    // TODO POPUP
    function togglePopup(popupId) {
      document.getElementById(popupId).classList.toggle("active");
    }


    // TODO EDIT POPUP
    function openEditPopup(element) {
      // ! Parse data dari attribute
      const data = JSON.parse(element.getAttribute('data-perusahaan'));

      // ! Validasi data
      if (!data) {
        console.error('Data perusahaan tidak valid');
        return;
      }

      // ! Isi form edit
      document.getElementById('edit-id').value = data.id_perusahaan || '';
      document.getElementById('edit-nama').value = data.nama || '';
      document.getElementById('edit-deskripsi_perusahaan').value = data.deskripsi_perusahaan || '';
      document.getElementById('edit-alamat').value = data.alamat || '';
      document.getElementById('edit-kota').value = data.kota || '';
      document.getElementById('edit-kontak').value = data.kontak || '';
      document.getElementById('edit-email').value = data.email || '';
      document.getElementById('edit-standar').value = data.standar || '';
      document.getElementById('edit-kategori').value = data.kategori || '';
      document.getElementById('edit-kerja_sama').value = data.kerja_sama || '';

      // ! Handle gambar
      const preview = document.getElementById('edit-preview');
      const placeholder = document.getElementById('edit-placeholder');

      if (data.gambar) {
        preview.src = '<?= base_url("uploads/perusahaan/") ?>' + data.gambar;
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
      } else {
        preview.style.display = 'none';
        if (placeholder) placeholder.style.display = 'flex';
      }

      // ! Tampilkan popup
      togglePopup('popup-edit');
    }

    // TODO MUNCULKAN GAMBAR DI POPUP UNTUK PREVIEW
    function previewGambar(event) {
      const input = event.target;
      const preview = document.getElementById('preview');
      const placeholder = document.querySelector('.img-preview .img-placeholder');

      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
          if (placeholder) placeholder.style.display = 'none';
        };

        reader.readAsDataURL(input.files[0]);
      }
    }


    function previewEditGambar(event) {
      const input = event.target;
      const preview = document.getElementById('edit-preview');
      const placeholder = document.getElementById('edit-placeholder');

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
          if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>