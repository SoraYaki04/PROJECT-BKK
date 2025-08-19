<?php
require_once __DIR__ . '/../../config/helpers.php';

allow_role(['admin']);


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
    <link rel="stylesheet" href="infokegbkk.css" />
    <link href="https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <?php include '../../navbar/header.php' ?>

    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div class="floating-notif <?= isset($_SESSION['success']) ? 'success' : 'error' ?>">
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
            <a href="#">CRUD Kegiatan BKK</a>
        </div>

        <div class="activity-list">

            <div class="activity-card" id="tambah-kegiatan">
                <div class="tambah-btn" onclick="togglePopup('popup-tambah')" style="cursor: pointer;">
                    <a>
                        <i class="fa-solid fa-plus fa-2xl"></i>
                        <p>Tambahkan Kegiatan</p>
                    </a>
                </div>

            </div>

            <?php
            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $judul = htmlspecialchars($row['judul']);
                    $tanggal = htmlspecialchars($row['tanggal']);
                    $jml_peserta = htmlspecialchars($row['jml_peserta']);
                    $lokasi = htmlspecialchars($row['lokasi']);
                    $deskripsi = htmlspecialchars($row['deskripsi']);
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
                            <a href="infokegbkk-hapus.php?id=<?= $row['id_berita'] ?>" onclick="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                <button class="delete-button"><i class="fas fa-trash"></i> HAPUS</button>
                            </a>
                            <button class="edit-button" data-kegiatan='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>' onclick='openEditPopup(this)'>
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



    <!-- // ? POPUP TAMBAH -->
    <div class="popup" id="popup-tambah">
        <div class="overlay" onclick="togglePopup('popup-tambah')"></div>
        <div class="card-popup">
            <?= csrf_field() ?>
            <form action="infokegbkk-simpan.php" method="POST" enctype="multipart/form-data">
                <div class="popup-header">
                    <h1><input type="text" name="judul" placeholder="Masukkan Judul Kegiatan" required></h1>
                </div>
                <div class="popup-content">
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
                    <div class="popup-detail">
                        <div class="popup-info">
                            <div class="icon">
                                <i class="fa-regular fa-clock fa-xl"></i>
                            </div>
                            <div class="teks">
                                <h5>Tanggal Kegiatan</h5>
                                <input type="date" name="tanggal" placeholder="Masukkan Tanggal" required>
                            </div>
                        </div>
                        <div class="popup-info">
                            <div class="icon">
                                <i class="fa-solid fa-users fa-xl"></i>
                            </div>
                            <div class="teks">
                                <h5>Jumlah Peserta</h5>
                                <input type="text" name="jml_peserta" placeholder="Masukkan Jumlah Peserta" required>
                            </div>
                        </div>
                        <div class="popup-info">
                            <div class="icon">
                                <i class="fa-solid fa-location-dot fa-xl"></i>
                            </div>
                            <div class="teks">
                                <h5>Lokasi</h5>
                                <input type="text" name="lokasi" placeholder="Masukkan Lokasi" required>
                            </div>
                        </div>

                        <div class="popup-description">
                            <h4>Deskripsi Kegiatan</h4>
                            <textarea name="deskripsi" rows="5" placeholder="Masukkan Deskripsi Kegiatan" required></textarea>
                        </div>
                    </div>


                    <div class="popup-footer">
                        <button type="submit" class="save-btn">SIMPAN</button>
                        <button type="button" class="close-btn" onclick="togglePopup('popup-tambah')">BATAL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- // ? POPUP EDIT -->
    <div class="popup" id="popup-edit">
        <div class="overlay" onclick="togglePopup('popup-edit')"></div>
        <div class="card-popup">
            <form action="infokegbkk-edit.php" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id_berita" id="edit-id">

                <div class="popup-header">
                    <h1><input type="text" name="judul" id="edit-judul" required></h1>
                </div>

                <div class="popup-content">
                    <div class="popup-imgbox">
                        <div class="img-preview" onclick="document.getElementById('edit-gambar-input').click()">
                            <div class="img-placeholder" id="edit-placeholder">
                                <i class="fa-solid fa-plus fa-2xl"></i>
                                <p>Ubah Foto</p>
                            </div>
                            <img id="edit-preview" src="#" style="display: none;" alt="Preview">
                        </div>
                        <input type="file" id="edit-gambar-input" name="gambar" accept="image/*" style="display: none;" onchange="previewEditGambar(event)">
                    </div>

                    <div class="popup-detail">
                        <div class="popup-info">
                            <div class="icon"><i class="fa-regular fa-clock fa-xl"></i></div>
                            <div class="teks">
                                <h5>Tanggal Kegiatan</h5>
                                <input type="date" name="tanggal" id="edit-tanggal" required>
                            </div>
                        </div>
                        <div class="popup-info">
                            <div class="icon"><i class="fa-solid fa-users fa-xl"></i></div>
                            <div class="teks">
                                <h5>Jumlah Peserta</h5>
                                <input type="text" name="jml_peserta" id="edit-jml_peserta" required>
                            </div>
                        </div>
                        <div class="popup-info">
                            <div class="icon"><i class="fa-solid fa-location-dot fa-xl"></i></div>
                            <div class="teks">
                                <h5>Lokasi</h5>
                                <input type="text" name="lokasi" id="edit-lokasi" required>
                            </div>
                        </div>

                        <div class="popup-description">
                            <h4>Deskripsi Kegiatan</h4>
                            <textarea name="deskripsi" id="edit-deskripsi" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="popup-footer">
                        <button type="submit" class="save-btn">SIMPAN PERUBAHAN</button>
                        <button type="button" class="close-btn" onclick="togglePopup('popup-edit')">BATAL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        //  TODO SMOOTH ANIMATION
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



        // TODO POPUP
        function togglePopup(popupId) {
            document.getElementById(popupId).classList.toggle("active");
        }

        // TODO EDIT POPUP
        function openEditPopup(element) {
            // ! Parse data dari attribute
            const data = JSON.parse(element.getAttribute('data-kegiatan'));

            // ! Validasi data
            if (!data) {
                console.error('Data kegiatan tidak valid');
                return;
            }

            // ! Isi form edit
            document.getElementById('edit-id').value = data.id_berita || '';
            document.getElementById('edit-judul').value = data.judul || '';
            document.getElementById('edit-tanggal').value = data.tanggal || '';
            document.getElementById('edit-jml_peserta').value = data.jml_peserta || '';
            document.getElementById('edit-lokasi').value = data.lokasi || '';
            document.getElementById('edit-deskripsi').value = data.deskripsi || '';

            // ! Handle gambar
            const preview = document.getElementById('edit-preview');
            const placeholder = document.getElementById('edit-placeholder');

            if (data.gambar) {
                preview.src = '<?= base_url("uploads/kegiatan/") ?>' + data.gambar;
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
