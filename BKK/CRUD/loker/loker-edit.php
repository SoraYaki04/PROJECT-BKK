<?php
require_once __DIR__ . '/../../config/helpers.php';
validate_csrf();
allow_role(['admin', 'recruiter']);

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    $_SESSION['error'] = "ID lowker tidak valid!";
    redirect("loker.php");
}

// TODO Ambil data lama
$stmt = $koneksi->prepare("SELECT * FROM lowker WHERE id_lowker = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    $_SESSION['error'] = "Data lowker tidak ditemukan!";
    redirect("loker.php");
}

// TODO Ambil data perusahaan dan jurusan
$companies = $koneksi->query("SELECT id_perusahaan, nama FROM perusahaan");
$jurusan = $koneksi->query("SELECT id_jurusan, jurusan FROM jurusan");

// ! Handle update
if (isset($_POST['update'])) {
    $judul = trim($_POST['judul_lowker']);
    $deskripsi = trim($_POST['deskripsi_lowker']);
    $gaji = trim($_POST['gaji']);
    $pendidikan = trim($_POST['pendidikan']);
    $tipe = trim($_POST['tipe_pekerjaan']);
    $tgl_ditutup = trim($_POST['tgl_ditutup']);
    $keahlian = trim($_POST['keahlian']);
    $waktu = trim($_POST['waktu_bekerja']);
    $kualifikasi = trim($_POST['kualifikasi']);
    $tunjangan = trim($_POST['tunjangan']);
    $lokasi = trim($_POST['lokasi']);
    $id_perusahaan = intval($_POST['id_perusahaan']);
    $id_jurusan = intval($_POST['id_jurusan']);

    if (!$judul || !$deskripsi || !$id_perusahaan || !$id_jurusan || !$tgl_ditutup) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect("loker-edit.php?id=$id");
    }

    try {
        $update = $koneksi->prepare("UPDATE lowker SET judul_lowker=?, deskripsi_lowker=?, gaji=?, pendidikan=?,
            tipe_pekerjaan=?, tgl_ditutup=?, keahlian=?, waktu_bekerja=?, kualifikasi=?, tunjangan=?, lokasi=?,
            id_perusahaan=?, id_jurusan=? WHERE id_lowker=?");

        $update->bind_param(
            "sssssssssssiii",
            $judul, $deskripsi, $gaji, $pendidikan, $tipe, $tgl_ditutup,
            $keahlian, $waktu, $kualifikasi, $tunjangan, $lokasi,
            $id_perusahaan, $id_jurusan, $id
        );

        $update->execute();

        $_SESSION['success'] = "Lowongan berhasil diperbarui!";
        redirect("loker.php");
    } catch (Exception $e) {
        error_log($e->getMessage());
        $_SESSION['error'] = "Gagal memperbarui lowker.";
        redirect("loker-edit.php?id=$id");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Lowongan</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
    <link rel="stylesheet" href="loker-tambah.css?v=<?= time() ?>">
    <link rel="stylesheet" href="../../navbar/navbar.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    <?php include '../../navbar/header.php'; ?>

    <div class="container">
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
            <a href="#">Edit Lowongan Kerja</a>
        </div>

        <section class="detail-lowongan">
            <form method="POST">
                <div class="container-detail">
                    <?= csrf_field() ?>

                    <div class="kotak-satu">
                        <h2><input type="text" name="judul_lowker"
                                value="<?= htmlspecialchars($data['judul_lowker']) ?>" required></h2>

                        <div class="rincian">
                            <ul>
                                <li>
                                    <i class="fa-solid fa-building"></i>
                                    <select name="id_perusahaan" required>
                                        <?php while ($c = $companies->fetch_assoc()): ?>
                                        <option value="<?= $c['id_perusahaan'] ?>"
                                            <?= $data['id_perusahaan'] == $c['id_perusahaan'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c['nama']) ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </li>
                                <li>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>"
                                        required>
                                </li>
                            </ul>
                        </div>

                        <div class="form-input">
                            <p>Gaji :</p>
                            <input type="text" name="gaji" value="<?= htmlspecialchars($data['gaji']) ?>">
                        </div>

                        <div class="form-input">
                            <p>Pendidikan :</p>
                            <input type="text" name="pendidikan" value="<?= htmlspecialchars($data['pendidikan']) ?>">
                        </div>

                        <div class="form-input">
                            <p>Tipe pekerjaan :</p>
                            <input type="text" name="tipe_pekerjaan"
                                value="<?= htmlspecialchars($data['tipe_pekerjaan']) ?>">
                        </div>

                        <div class="form-input">
                            <p>Tanggal exp :
                                <input type="date" name="tgl_ditutup"
                                    value="<?= htmlspecialchars($data['tgl_ditutup']) ?>" required>
                            </p>
                        </div>
                    </div>

                    <div class="kotak-dua">
                        <div class="detail-content">

                            <div class="form-input">
                                <p>Deskripsi : </p>
                                <textarea name="deskripsi_lowker" placeholder="Deskripsi lengkap lowongan kerja"
                                    rows="6" required><?= htmlspecialchars($data['deskripsi_lowker']) ?></textarea>
                            </div>

                            <div class="form-input">
                                <p>Keahlian : </p>
                                <textarea name="keahlian" placeholder="Contoh: HTML, CSS, JS"
                                    rows="6" required><?= htmlspecialchars($data['keahlian']) ?></textarea>
                            </div>

                            <div class="form-input">
                                <p>Waktu Bekerja :</p>
                                <input type="text" name="waktu_bekerja" placeholder="Contoh: Senin-Jumat, Shift"
                                    value="<?= htmlspecialchars($data['waktu_bekerja']) ?>">
                            </div>




                        </div>


                    </div>

                        <div class="kotak-tiga">
                            
                            <div class="form-input">
                                <p>Kualifikasi :</p>
                                <textarea name="kualifikasi" rows="5"
                                    placeholder="Contoh: Usia < 30, Rajin, dsb"><?= htmlspecialchars($data['kualifikasi']) ?></textarea>
                            </div>
                            <div class="form-input">
                                <p>Tunjangan :</p>
                                <textarea name="tunjangan" rows="4"
                                    placeholder="Contoh: Uang Makan, Transportasi, dll"><?= htmlspecialchars($data['tunjangan']) ?></textarea>
                            </div>

                            <div class="form-input" id="jurusan">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <select name="id_jurusan" required>
                                    <?php while ($j = $jurusan->fetch_assoc()): ?>
                                    <option value="<?= $j['id_jurusan'] ?>"
                                        <?= $data['id_jurusan'] == $j['id_jurusan'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($j['jurusan']) ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>

                            </div>
                        </div>

                    <div class="actions">
                        <button type="submit" name="update" class="save-btn">UPDATE</button>
                        <a href="loker.php" class="apply-btn">BATAL</a>
                    </div>

                </div>
            </form>
        </section>

    </div>

</body>

</html>