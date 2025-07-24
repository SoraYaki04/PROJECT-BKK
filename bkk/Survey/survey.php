<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../koneksi.php'; 
if (!isset($conn)) {
    die("Database connection not established.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = $_POST['survey-choice'] ?? '';
    $description = $_POST['description'] ?? '';

    $choice = mysqli_real_escape_string($conn, $choice);
    $description = mysqli_real_escape_string($conn, $description);

    $sql = "INSERT INTO survey (pilihan_survey, kritiksaran, tgl_dibuat) VALUES ('$choice', '$description', NOW())";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../css/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="survey.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>

<header>
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
    <nav class="navbar">
        <ul>
            <li>
                <div onclick="" class="profile-icon"> 
                    <i class="fa-solid fa-user fa-sm student-profile" style="color: #5135FA;"></i>
                </div>
            </li>
            <li>
                <a href="#">HOME<i class="fa-solid fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="../berandautama.php">Halaman Utama</a></li>
                    <li><a href="../Home/pengantar.php">Pengantar</a></li>
                    <li><a href="../Informasi Kegiatan BKK/informasi_kegiatan.html">Informasi Kegiatan BKK</a></li>
                    <li><a href="">Rekapitulasi</a></li>
                </ul>
            </li>
            <li><a href="#">TENTANG KAMI<i class="fa-solid fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="../Tentang Kami/visimisi.php">Visi Misi</a></li>
                    <li><a href="../Tentang Kami/proker.php">Program Kerja BKK</a></li>
                    <li><a href="../Tentang Kami/tujuan.php">Tujuan</a></li>
                    <li><a href="../Tentang Kami/strukturorganisasi.php">Struktur Organisasi</a></li>
                </ul>
            </li>
            <li><a href="#">LOGIN<i class="fa-solid fa-chevron-down"></i></a>
                <ul class="dropdown">
                    <li><a href="../Login/Login Admin/admin-login.php">Admin BKK</a></li>
                    <li><a href="../Login/Login Management/management-login.php">Management</a></li>
                    <li><a href="../Login/Login Siswa/siswa-alumni-login.php">Siswa / Alumni</a></li>
                    <li><a href="../Login/Login User Lain/pengguna-lain-login.html">Partisipan Lain</a></li>
                </ul>
            </li>
            <li><a href="../Informasi Jurusan/informasiJurusan.php">INFORMASI JURUSAN</a></li>
            <li><a href="../Perusahaan/perusahaan.php">PERUSAHAAN</a></li>
            <li><a href="../Lowker/loker.php">LOWONGAN KERJA</a></li>
        </ul>
    </nav>

    <div class="header-bar">
        <a href="#">Isi Survey</a>
    </div>

    <div class="survey-container">
        <form action="" method="POST">
            <div class="survey-title">
                <p>FORMULIR PENGISIAN SURVEY</p>
            </div>
            <div class="survey-box">
                <div class="survey-choice">
                    <p>Profesi yang sedang dijalani dalam 6 bulan terakhir</p>
                    <div class="survey-choice-container">
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="Bekerja">
                            <p>Bekerja</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="Wirausaha">
                            <p>Wirausaha</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="Menganggur">
                            <p>Menganggur</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="Magang">
                            <p>Magang</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="Kuliah">
                            <p>Kuliah</p>
                        </div>
                    </div>
                </div>
                <div class="survey-description">
                    <p>Keterangan</p>
                    <textarea placeholder="Misal Jurusan Kuliah/ Bidang Wirausaha/ Jabatan dalam Pekerjaan" name="description"></textarea>
                </div>
            </div>
            <div class="survey-submit">
                <button type="submit" class="survey-submit-btn">SUBMIT</button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('input[name="survey-choice"]').forEach((radio) => {
    radio.addEventListener('change', () => {});
});
</script>

</body>
</html>
