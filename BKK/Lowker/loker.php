<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="loker.css?v=<?php echo time(); ?>">
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
    <nav class="navbar">
      <!-- data-feather="chevron-down"> -->
       <ul class="navbar-container">
          <li>
            <a href="index.html">HOME<i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown">
              <li><a href="index.html">Halaman Utama</a></li>
              <li><a href="pengantar.html">Pengantar</a></li>
              <li><a href="">Informasi Kegiatan BKK</a></li>
              <li><a href="">Rekapitulasi</a></li>
            </ul>
          </li>

        <li><a href="#">TENTANG KAMI<i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown">
          <li><a href="visimisi.html">Visi Misi</a></li>
          <li><a href="proker.html">Progam Kerja BKK</a></li>
          <li><a href="tujuan.html">Tujuan</a></li>
          <li><a href="strukturorganisasi.html">Struktur Organisasi</a></li>
        </ul>
        </li>
        
        <li><a href="#">LOGIN<i class="fa-solid fa-chevron-down"></i></a>
        <ul class="dropdown">
          <li><a href="admin-login.html">Admin BKK</a></li>
          <li><a href="management-login.html">Management</a></li>
          <li><a href="siswa-alumni-login.html">Siswa / Alumni</a></li>
          <li><a href="pengguna-lain-login.html">Partisipan Lain</a></li>
        </ul>
        </li>

        <li><a href="informasiJurusan.html">INFORMASI JURUSAN</a></li>
        <li><a href="perusahaan.html">PERUSAHAAN</a></li>
        <li><a href="loker.html" class="active">LOWONGAN KERJA</a></li>
       </ul>

        
    </nav>
    
    <div class="header-bar">
        <a href="#">Lowongan Kerja</a>
    </div>
    <div class="search-container">
      <div class="search">
        <label for="category">Pencarian:</label>
        <select id="category" class="search-select">
            <option value="">SEMUA KATEGORI/JURUSAN</option>
            <option value="TKJ">Teknik Komputer dan Jaringan</option>
            <option value="TKI">Teknik Kimia Industri</option>
            <option value="RPL">Rekayasa Perangkat Lunak</option>
            <option value="PM">Pemasaran</option>
            <option value="AKL">Akuntansi</option>
            <option value="MP">Manajemen Perkantoran</option>
            <option value="AN">Animasi</option>
            <option value="BP">Broadcasting</option>
            <option value="DKV">Desain Komunikasi Visual</option>
            <option value="ULW">Usaha Layanan Wisata</option>
        </select>
        <input type="text" class="search-input" placeholder="Masukkan Lokasi">
        <button class="search-button">Cari</button>
      </div>

    </div>
    <div class="job-list">
        <div class="job-card">

          <div class="job-header">
            <h3>LOWONGAN KERJA UD. BINTANG</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>UD. BINTANG</li>
              <li><i class="fa-solid fa-location-dot"></i>Malang</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">BACK END DEVELOPER (PHP/Laravel)</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Programmer</p>
              <p>PHP</p>
              <p>Laravel</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>
      
        <div class="job-card">
          <div class="job-header">
            <h3>LOWONGAN KERJA PT. SARINAH</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>PT. SARINAH</li>
              <li><i class="fa-solid fa-location-dot"></i>Jakarta</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">DESAIN WEB, KONTEN CREATOR</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Desain</p>
              <p>Web</p>
              <p>Konten Creator</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>
        <div class="job-card">
          <div class="job-header">
            <h3>LOWONGAN KERJA PT. SARINAH</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>PT. SARINAH</li>
              <li><i class="fa-solid fa-location-dot"></i>Jakarta</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">DESAIN WEB, KONTEN CREATOR</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Desain</p>
              <p>Web</p>
              <p>Konten Creator</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>
        <div class="job-card">
          <div class="job-header">
            <h3>LOWONGAN KERJA PT. SARINAH</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>PT. SARINAH</li>
              <li><i class="fa-solid fa-location-dot"></i>Jakarta</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">DESAIN WEB, KONTEN CREATOR</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Desain</p>
              <p>Web</p>
              <p>Konten Creator</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>
        <div class="job-card">
          <div class="job-header">
            <h3>LOWONGAN KERJA PT. SARINAH</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>PT. SARINAH</li>
              <li><i class="fa-solid fa-location-dot"></i>Jakarta</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">DESAIN WEB, KONTEN CREATOR</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Desain</p>
              <p>Web</p>
              <p>Konten Creator</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>
        <div class="job-card">
          <div class="job-header">
            <h3>LOWONGAN KERJA PT. SARINAH</h3>
          </div>
          
          <div class="job-detail">
            <ul>
              <li><i class="fa-solid fa-building"></i>PT. SARINAH</li>
              <li><i class="fa-solid fa-location-dot"></i>Jakarta</li>
              <li><i class="fa-regular fa-clock"></i>Kamis, 18 nov 2021 14.00</li>
              <li style="color: red;">exp date : sabtu, 18 des 2021</li>
            </ul>

            <p class="job-role">DESAIN WEB, KONTEN CREATOR</p>

            <div class="line"></div>

            <div class="job-tags">
              <p>Desain</p>
              <p>Web</p>
              <p>Konten Creator</p>
            </div>
          </div>

          <div class="job-footer">
            <a href="detail.html"><button class="detail-button"><i class="fa-solid fa-list"></i>DETAIL</button></a>
          </div>
        </div>

      </div>
    </div>

</body>
</html>
