<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Kerja BKK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="proker.css?v=<?php echo time(); ?>" rel="stylesheet">
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
           <ul class="navbar-container">
            <li>
              <a href="../Home/Halaman Utama/berandautama.html" >HOME<i class="fa-solid fa-chevron-down"></i></a>
              <ul class="dropdown">
                <li><a href="../Home/Halaman Utama/berandautama.html">Halaman Utama</a></li>
                <li><a href="../Home/Pengantar/pengantar.html">Pengantar</a></li>
                <li><a href="../Home/Informasi Kegiatan BKK/informasikegiatanbkk.html">Informasi Kegiatan BKK</a></li>
                <li><a href="../Home/Halaman Utama/rekapitulasi.html">Rekapitulasi</a></li>
              </ul>
            </li>
    
            <li><a href="#" class="active">TENTANG KAMI<i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown">
              <li><a href="../Tentang Kami/visimisi.php">Visi Misi</a></li>
              <li><a href="#" class="active" >Progam Kerja BKK</a></li>
              <li><a href="../Tentang Kami/tujuan.php">Tujuan</a></li>
              <li><a href="../Tentang Kami/strukturorganisasi.php">Struktur Organisasi</a></li>
            </ul>
            </li>
            
            <li><a href="#">LOGIN<i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown">
              <li><a href="../Login/Login Admin/admin-login.php">Admin BKK</a></li>
              <li><a href="../Login/Login Management/management-login.php">Management</a></li>
              <li><a href="../Login/Login Siswa/siswa-login.php">Siswa / Alumni</a></li>
              <li><a href="../Login/Login Partisipan/partisipan-login.php">Partisipan Lain</a></li>
            </ul>
            </li>
    
            <li><a href="../Informasi Jurusan/informasiJurusan.php">INFORMASI JURUSAN</a></li>
            <li><a href="../Perusahaan/perusahaan.php">PERUSAHAAN</a></li>
            <li><a href="../Lowker/loker.php">LOWONGAN KERJA</a></li>
           </ul>
    
            
        </nav>

    <div class="container">
        <div class="header-bar">
            <a href="#">TENTANG KAMI / Program Kerja</a>
        </div>

        <section class="proker">
            <h2 class="proker-h2">PROGRAM KERJA BKK SMKN 1 BOYOLANGU</h2>
            <ol>
                <li class="proker-list">Sosialisasi Program BKK Kepada siswa-siswi SMKN 1 Boyolangu bertujuan Agar siswa tingkat ankhir XII/XIII mengetahui tentang kegiatan pelatihan, open rekrutmen dan lain sebagainya.</li>
                <li class="proker-list">Pendataan DUDI industri baik untuk penempatan kerja dalam negeri bertujuan Mengetahui perusahaan yang memungkinkan menjalin kerja sama.</li>
                <li class="proker-list">Melakukan kunjungan ke pengguna tenaga kerja /perusahaan untuk melakukan penawaran mengenai ketersediaan tenaga kerja bertujuan Untuk menghimpun informasi tentang kebutuhan tenaga kerja di perusahaan dan dikhusukan untuk tingkat akhir / kelas XII dan Kelas XIII.</li>
                <li class="proker-list">Pendataan dan Pembuatan data base canaker tamatan TA 2021-2022 Mengetahui canaker / tamatan yang belum bekerja.</li>
                <li class="proker-list">Pelatihan “Basic Mentality Learning” bertujuan Pembekalan (kognitif dan afektif) untuk menyiapkan canaker menempuh proses rekruitment dan ketika bekerja pada DUDI.</li>
                <li class="proker-list">Pelatihan Ketrampilan dan Uji sertifikasi bertujuan Calon tenaga kerja dan petugas BKK mendapatkan bekal pelatihan serta uji sertifikasi.</li>
                <li class="proker-list">Pelatihan Kewirausahaan bertujuan Menambah kompetensi dan pengetahuan tentang kewirausahaan bidang makan & minum.</li>
                <li class="proker-list">Proses rekruitmen kerja agar Alumni dapat terserap di DUDI.</li>
                <li class="proker-list">Mengikuti seminar / workshop/ latihan petugas BKK dan program magang bagi guru produktif bertujuan Untuk meningkatkan ketrampilan dan pengetahuan petugas BKK.</li>
            </ol>
        </section>
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.proker-h2, .proker-list');

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
