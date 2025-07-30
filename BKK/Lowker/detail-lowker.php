<?php
require_once __DIR__ . '/../config/helpers.php';

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
$result = $query->get_result();


if ($result->num_rows === 0) {
    die("Lowongan tidak ditemukan.");
}

$data = $result->fetch_assoc();

$keahlianList = isset($data['keahlian']) ? explode(',', $data['keahlian']) : [];
$kualifikasiList = isset($data['kualifikasi']) ? explode(',', $data['kualifikasi']) : [];
$tunjanganList = isset($data['tunjangan']) ? explode(',', $data['tunjangan']) : [];
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

        <!--  NAVBAR -->
        <?php
        if (!is_logged_in()) {
            include 'navbar/guest.php';
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
                                <li><i class="fa-solid fa-building"></i><?= htmlspecialchars($data['id_perusahaan']) ?></li>
                                <li><i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($data['lokasi']) ?></li>
                                <li><i class="fa-solid fa-users"></i><?= htmlspecialchars($data['jumlah_pelamar']) ?> pelamar</li>
                            </ul>
                        </div>

                        <p><?= htmlspecialchars($data['deskripsi_lowker']) ?></p>

                        <div class="gaji">
                            <p>Gaji :</p>
                            <p><?= htmlspecialchars($data['gaji']) ?></p>
                        </div>

                        <div class="pendidikan">
                            <p>Pendidikan :</p>
                            <p><?= htmlspecialchars($data['pendidikan']) ?></p>
                        </div>

                        <div class="tipe">
                            <p>Tipe pekerjaan :</p>
                            <p><?= htmlspecialchars($data['tipe_pekerjaan']) ?></p>
                        </div>

                        <div class="tanggal">
                            <p><strong>Tanggal posting : <?= date('l, d M Y', strtotime($data['tgl_posting'])) ?></strong></p>
                            <p><strong>Tanggal exp : <?= date('l, d M Y', strtotime($data['tgl_ditutup'])) ?></strong></p>
                        </div>
                    </div>

                    <div class="kotak-dua">
                        <div class="detail-content">
                            <div class="info">
                                <h3>Keahlian:</h3>
                                <ul>
                                    <?php foreach ($keahlianList as $item_keahlian): ?>
                                    <li><?= htmlspecialchars(trim($item_keahlian)) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                                <h3>Waktu Bekerja:</h3>
                                <p><?= htmlspecialchars($data['waktu_bekerja']) ?></p>
                            </div>

                            <div class="requirements">
                                <h3>Kualifikasi:</h3>
                                <ul>
                                    <?php foreach ($kualifikasiList as $item_kualifikasi): ?>
                                    <li><?= htmlspecialchars(trim($item_kualifikasi)) ?></li>
                                    <?php endforeach; ?>
                                </ul>


                                <h3>Tunjangan:</h3>
                                <ul>
                                    <?php foreach ($tunjanganList as $item_tunjangan): ?>
                                    <li><?= htmlspecialchars(trim($item_tunjangan)) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="actions">
                        <button class="save-btn">SIMPAN</button>
                        <button class="apply-btn">LAMAR</button>
                    </div>
                </div>
            </section>
        </main>