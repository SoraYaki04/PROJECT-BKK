<?php
require_once __DIR__ . '/../config/helpers.php';

allow_role(['admin', 'alumni']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID lowongan tidak valid.");
}

$id = (int) $_GET['id'];

$query = $koneksi->prepare("
    SELECT lowker.*, perusahaan.nama AS nama_perusahaan, perusahaan.alamat, perusahaan.kota,
           jurusan.jurusan AS nama_jurusan
    FROM lowker
    JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
    JOIN jurusan ON lowker.id_jurusan = jurusan.id_jurusan
    WHERE lowker.id_lowker = ?
");
$query->bind_param("i", $id);
$query->execute();
$resultLowker = $query->get_result();

if ($resultLowker->num_rows === 0) {
    die("Lowongan tidak ditemukan.");
}

$data = $resultLowker->fetch_assoc();
$query->close();

// TODO hitung jumlah pelamar per lowongan
$stmtPelamar = $koneksi->prepare("SELECT COUNT(*) FROM lamaran WHERE id_lowker = ?");
$stmtPelamar->bind_param("i", $id);
$stmtPelamar->execute();
$stmtPelamar->bind_result($jumlahPelamarLowongan);
$stmtPelamar->fetch();
$stmtPelamar->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="detail-lowker.css?v=<?php echo time(); ?>">
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
            <a href="#">Detail Lowongan Kerja</a>
        </div>
        <main>
            <section class="detail-lowongan">
                <div class="container-detail">

                    <div class="kotak-satu">
                        <h2><?= htmlspecialchars($data['judul_lowker']) ?></h2>

                        <div class="rincian">
                            <ul>
                                <li><i class="fa-solid fa-building"></i><?= htmlspecialchars($data['nama_perusahaan']) ?></li>
                                <li><i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($data['lokasi']) ?></li>
                                <li><i class="fa-solid fa-users"></i><p>Jumlah Pelamar: <?= $jumlahPelamarLowongan ?></p>
                            </ul>
                        </div>

                        <div class="form-input">
                            <h4>Gaji :</h4>
                            <p><?= htmlspecialchars($data['gaji']) ?></p>
                        </div>

                        <div class="form-input">
                            <h4>Pendidikan :</h4>
                            <p><?= htmlspecialchars($data['pendidikan']) ?></p>
                        </div>

                        <div class="form-input">
                            <h4>Tipe pekerjaan :</h4>
                            <p><?= htmlspecialchars($data['tipe_pekerjaan']) ?></p>
                        </div>

                        <div class="form-input">
                            <h4>Tanggal exp : </h4>
                            <p><?= date('d M Y', strtotime($data['tgl_ditutup'])) ?></p>
                        </div>
                    </div>

                    <div class="kotak-dua">
                        <div class="detail-content">

                            <div class="form-input">
                                <h4>Deskripsi : </h4>
                                <p><?= nl2br(htmlspecialchars($data['deskripsi_lowker'])) ?></p>

                            </div>

                            <div class="form-input">
                                <h4>Keahlian : </h4>
                                <p><?= nl2br(htmlspecialchars($data['keahlian'])) ?></p>
                            </div>

                            <div class="form-input">
                                <h4>Waktu Bekerja :</h4>
                                <p><?= htmlspecialchars($data['waktu_bekerja']) ?></p>
                            </div>

                        </div>

                    </div>

                    <div class="kotak-tiga">

                        <div class="form-input">
                            <h4>Kualifikasi :</h4>
                            <p><?= nl2br(htmlspecialchars($data['kualifikasi'])) ?></p>
                        </div>

                        <div class="form-input">
                            <h4>Tunjangan :</h4>
                            <p><?= nl2br(htmlspecialchars($data['tunjangan'])) ?></p>
                        </div>

                        <div class="form-input" id="jurusan">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <p><?= htmlspecialchars($data['nama_jurusan']); ?></p>
                        </div>
                    </div>

                    <div class="actions">
                        <a href="persyaratan.php?id=<?= $data['id_lowker'] ?>" class="save-btn">LAMAR</a>
                        <a href="loker.php" class="apply-btn">BATAL</a>
                    </div>

                </div>
            </section>
        </main>