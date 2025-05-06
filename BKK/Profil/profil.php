<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    echo "ANDA BELUM LOGIN";
    exit();
}

// Ambil ID dari session
$id = $_SESSION['id'];

// Ambil data lengkap dari database
$query = $koneksi->query("SELECT * FROM siswa WHERE id = '$id'");
$data = $query->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Franklin+Demi+Cond&display=swap" rel="stylesheet">
  <link href="profil.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>

    <header>
      <div class="rectangle">
      </div>
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
      <nav class="navbar">
        <!-- data-feather="chevron-down"> -->
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
            <li><a href="../Tentang Kami/proker.php">Progam Kerja BKK</a></li>
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
        <a href="#">Profil</a>
    </div>
    
    <div class="profile-content">
        <div class="profile-title">
            <div class="profile-image">
                <img src="smile.png" alt="">
                <div class="profile-image-camera">
                    <img onclick="" src="camera.png" alt="">
                </div>
            </div>
            <div class="profile-name">
                <h2><?php echo $data['nama']; ?></h2>
                <p class="profile-title-nisn"><?php echo $data['nisn']; ?></p>
                <p class="profile-title-status">Siswa / Alumni Tahun 2022/2023</p>
            </div>
        </div>
        <div class="profile-description">
            <div class="profile-details">
                <P class="profile-details-1">Nama Lengkap</P>
                <p><?php echo $data['nama']; ?></p>

                <P class="profile-details-1">NISN</P>
                <p><?php echo $data['nisn']; ?></p>

                <p class="profile-details-1">Tempat Tanggal Lahir</p>
                <p><?php echo $data['tempat_lahir'] . ", " . $data['tanggal_lahir'] ; ?>  </p>

                <p class="profile-details-1">Alamat</p>
                <p> <?php echo "RT " . $data['rt'] . ", RW " . $data['rw'] . ", " . $data['dusun'] . ", " . $data['kelurahan'] . ", " . $data['kecamatan'];  ?> </p>

                <p class="profile-details-1">Kode Pos</p>
                <p><?php echo $data['kode_pos'] ?></p>

                <p class="profile-details-1">Jenis Kelamin</p>
                <p><?php echo ($data['jenis_kelamin'] ?? '') === 'L' ? 'Laki-Laki' : 'Perempuan' ?></p>

                <p class="profile-details-1">Agama</p>
                <p><?php echo $data['agama'] ?></p>

                <p class="profile-details-1">No Tlp / Hp</p>
                <p><?php echo $data['no_wa'] ?></p>

                <p class="profile-details-1">NIK</p>
                <p><?php echo $data['nik'] ?></p>
            </div>
        
            <div class="profile-notification">
                <div class="profile-notification-title">
                    <i class="fa-regular fa-bell"></i>
                    <p>Semua Notifikasi</p>
                </div>
                
                <hr>

                <div class="profile-notification-notif">
                    <div class="profile-notification-notif-left">
                        <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
                    </div>
                    <div class="profile-notification-notif-right">
                        <p>01 Agt 24</p>
                    </div>
                </div>

                <div class="profile-notification-notif">
                    <div class="profile-notification-notif-left">
                        <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
                    </div>
                    <div class="profile-notification-notif-right">
                        <p>01 Agt 24</p>
                    </div>
                </div>

                <div class="profile-notification-notif">
                    <div class="profile-notification-notif-left">
                        <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
                    </div>
                    <div class="profile-notification-notif-right">
                        <p>01 Agt 24</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    </div>
  
  
  </body>
  </html>
