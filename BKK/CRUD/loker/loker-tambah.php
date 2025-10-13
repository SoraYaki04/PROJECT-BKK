<?php
require_once __DIR__ . '/../../config/helpers.php';
validate_csrf();
allow_role(['admin', 'recruiter']);

if (isset($_POST['add'])) {
    $judul_lowker     = trim($_POST['judul_lowker'] ?? '');
    $deskripsi_lowker = trim($_POST['deskripsi_lowker'] ?? '');
    $gaji             = trim($_POST['gaji'] ?? '');
    $pendidikan       = trim($_POST['pendidikan'] ?? '');
    $tipe_pekerjaan   = trim($_POST['tipe_pekerjaan'] ?? '');
    $tgl_ditutup      = trim($_POST['tgl_ditutup'] ?? '');
    $keahlian         = trim($_POST['keahlian'] ?? '');
    $waktu_bekerja    = trim($_POST['waktu_bekerja'] ?? '');
    $kualifikasi      = trim($_POST['kualifikasi'] ?? '');
    $tunjangan        = trim($_POST['tunjangan'] ?? '');
    $lokasi           = trim($_POST['lokasi'] ?? '');
    $id_perusahaan    = intval($_POST['id_perusahaan'] ?? 0);
    $id_jurusan       = intval($_POST['id_jurusan'] ?? 0);
    $tgl_posting      = date('Y-m-d');

    if (!$judul_lowker || !$deskripsi_lowker || !$id_perusahaan || !$id_jurusan) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect("loker-tambah.php");
    }

    if (!DateTime::createFromFormat('Y-m-d', $tgl_ditutup)) {
        $_SESSION['error'] = "Format tanggal tidak valid!";
        redirect("loker-tambah.php");
    }

    try {
        $sql = $koneksi->prepare("INSERT INTO lowker (
            judul_lowker, deskripsi_lowker, gaji, pendidikan,
            tipe_pekerjaan, tgl_ditutup, keahlian, waktu_bekerja,
            kualifikasi, tunjangan, lokasi, tgl_posting,
            id_perusahaan, id_jurusan
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $sql->bind_param("ssssssssssssii",
            $judul_lowker, $deskripsi_lowker, $gaji, $pendidikan,
            $tipe_pekerjaan, $tgl_ditutup, $keahlian, $waktu_bekerja,
            $kualifikasi, $tunjangan, $lokasi, $tgl_posting,
            $id_perusahaan, $id_jurusan
        );

        $sql->execute();
        $_SESSION['success'] = "Lowongan kerja berhasil ditambahkan!";
        redirect("loker.php");
    } catch (Exception $e) {
        error_log("Tambah Lowker Gagal: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan lowongan.";
        redirect("loker-tambah.php");
    }
}

$companies = $koneksi->query("SELECT id_perusahaan, nama FROM perusahaan");
$jurusan = $koneksi->query("SELECT id_jurusan, jurusan FROM jurusan");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Lowongan Kerja</title>
    <link rel="stylesheet" href="../../partials/navbar/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="loker-tambah.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div class="floating-notif <?= isset($_SESSION['success']) ? 'success' : 'error' ?>">
        <?= htmlspecialchars($_SESSION['success'] ?? $_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['success'], $_SESSION['error']); ?>
    <?php endif; ?>

    <?php include '../../partials/navbar/header.php'; ?>

    <div class="container">
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
            <a href="#">Tambah Lowongan Kerja</a>
        </div>

        <section class="detail-lowongan">
            <form method="POST">
                <div class="container-detail">
                    <?= csrf_field() ?>

                    <div class="kotak-satu">
                        <h2><input type="text" name="judul_lowker" placeholder="Masukkan Judul Lowongan" required></h2>

                        <div class="rincian">
                            <ul>
                                <li><i class="fa-solid fa-building"></i>
                                    <select name="id_perusahaan" required>
                                        <option value="">-- Pilih Perusahaan --</option>
                                        <?php while ($c = $companies->fetch_assoc()): ?>
                                        <option value="<?= $c['id_perusahaan'] ?>">
                                            <?= htmlspecialchars($c['nama']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </li>
                                <li><i class="fa-solid fa-location-dot"></i>
                                    <input type="text" name="lokasi" placeholder="Lokasi" required>
                                </li>
                            </ul>
                        </div>

                        <div class="form-input">
                            <p>Gaji :</p>
                            <input type="text" name="gaji" placeholder="Masukkan Gaji">
                        </div>

                        <div class="form-input">
                            <p>Pendidikan :</p>
                            <input type="text" name="pendidikan" placeholder="Contoh: SMA/SMK, D3, dll">
                        </div>

                        <div class="form-input">
                            <p>Tipe pekerjaan :</p>
                            <input type="text" name="tipe_pekerjaan" placeholder="Contoh: Fulltime, Parttime">
                        </div>

                        <div class="form-input">
                            <p>Tanggal Exp : </p>
                            <input type="date" name="tgl_ditutup" required>
                        </div>
                    </div>

                    <div class="kotak-dua">
                        <div class="detail-content">

                            <div class="form-input">
                                <p>Deskripsi : </p>
                                <textarea name="deskripsi_lowker" placeholder="Deskripsi lengkap lowongan kerja"
                                    rows="6" required></textarea>
                            </div>


                            <div class="form-input">
                                <p>Keahlian : </p>
                                <textarea name="keahlian" placeholder="Contoh: HTML, CSS, js"
                                    rows="6" required></textarea>
                            </div>

                            <div class="forn-input">
                                <p>Waktu Bekerja :</p>
                                <input type="text" name="waktu_bekerja" placeholder="Contoh: Senin-Jumat, Shift">
                            </div>

                        </div>
                    </div>

                    <div class="kotak-tiga">
                        <div class="form-input">
                            <p>Kualifikasi :</p>
                            <textarea name="kualifikasi" rows="5"
                                placeholder="Contoh: Usia < 30, Rajin, dsb"></textarea>
                        </div>
                        <div class="form-input">
                            <p>Tunjangan :</p>
                            <textarea name="tunjangan" rows="4"
                                placeholder="Contoh: Uang Makan, Transportasi, dll"></textarea>
                        </div>

                        <div class="form-input" id="jurusan">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <select name="id_jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <?php while ($j = $jurusan->fetch_assoc()): ?>
                                <option value="<?= $j['id_jurusan'] ?>">
                                    <?= htmlspecialchars($j['jurusan']) ?></option>
                                <?php endwhile; ?>
                            </select>

                        </div>

                    </div>

                </div>
                <div class="actions">
                    <button type="submit" name="add" class="save-btn">SIMPAN</button>
                    <a href="loker.php" class="apply-btn">BATAL</a>
                </div>
            </form>
        </section>
    </div>

</body>

</html>