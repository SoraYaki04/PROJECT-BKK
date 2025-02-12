<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="perusahaan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
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
            <a href="#" class="">HOME<i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown">
              <li><a href="index.html">Halaman Utama</a></li>
              <li><a href="pengatar.html">Pengantar</a></li>
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
        <li><a href="perusahaan.html" class="active">PERUSAHAAN</a></li>
        <li><a href="loker.html" >LOWONGAN KERJA</a></li>
       </ul>

        
    </nav>
    
    <div class="header-bar">
        <a href="#">Lowongan Kerja</a>
    </div>
    <div class="search-container">
      <div class="search">
        <label for="category">Pencarian:</label>
        <select id="category" class="search-select">
            <option value="">SEMUA KATEGORI</option>
            <option value="UMKN">UMKM</option>
            <option value="MOU">MOU</option>
            <option value="START-UP">START UP</option>
            <option value="PERSEROAN-TERBATAS">PERSEROAN TERBATAS</option>
        </select>

        <select name="" id="" class="search-select">
          <option value="">SEMUA STANDAR</option>
          <option value="">LOKAL</option>
          <option value="">PROVINSI</option>
          <option value="">NASIONAL</option>
          <option value="">INTERNASIONAL</option>
        </select>

        <button class="search-button">Cari</button>
      </div>

    </div>
    <div class="company-container">

      <div class="company-list">

        <div class="company-item company-item-1" data-index="1">
          <img src="assets/perusahaan 1.png" alt=""  >
          <div class="company-detail company-detail-1" data-index="1">
            <h2>Microsoft</h2>
          <button onclick="togglePopup('popup-1')" class="detail-btn"><i class="fa-solid fa-list"></i>Detail Penelusuran</button>
          </div>
        </div>

        <div class="popup" id="popup-1">
          <div class="company-popup">
            <div class="close-popup">
              <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
            </div>
            <div class="company-header-popup">
              <div class="company-title-popup">
                <h1>PT. HYBE Label Insight Corporation</h1>
              </div>
              <div class="company-desc-popup">
                <p>HYBE Corporation adalah perusahaan hiburan asal 
                  Surabaya yang didirikan pada tahun 2005 oleh Bang 
                  Si-Hyuk atau Papa Bear sebagai Big Hit Entertainment. 
                  Perusahaan ini beroperasi sebagai label rekaman, agensi 
                  bakat, produksi musik, manajemen acara dan produksi konser, 
                  dan sebagai penerbit musik rumahan. Perusahaan ini memiliki beberapa anak perusahaan
                  , termasuk ADOR, Big Hit Music, Source Music, Pledis Entertaiment,
                   Belift Lab, dan KOZ Entertainment, yang secara kolektif dikenal sebagai Hybe Labels</p>
              </div>
            </div>

            <hr>

            <div class="company-detail-popup">
              <table>
                <tr>
                  <td class="company-detail-left">Nama Perusahaan</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Kode</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Alamat</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Kota</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Tahun Gabung</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Standar</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
                <tr>
                  <td class="company-detail-left">Standar Perusahaan</td>
                  <td class="company-detail-rigth">: PT CIHUYY</td>
                </tr>
              </table>
            </div>
            <div class="company-table-popup">
              <table>
                <tr>
                  <th class="table-number">No</th>
                  <th width="970px">Kerjasama</th>
                </tr>
                <tr>
                  <td class="table-number">1</td>
                  <td>Mentoring</td>
                </tr>
                <tr>
                  <td class="table-number">2</td>
                  <td>Rekrutmen</td>
                </tr>
                <tr>
                  <td class="table-number">3</td>
                  <td>Prakerin</td>
                </tr>
              </table>
            </div>
          </div>
        </div>


        <div class="company-item company-item-2" data-index="2">
          <img src="assets/perusahaan 2.png" alt="" >
          <div class="company-detail company-detail-2" data-index="2">
            <h2>A1-Pictures</h2>
            <a href="" class="detail-btn"> <i class="fa-solid fa-list"></i>Detail Penelusuran</a>
          </div>
        </div>
        
        <div class="company-item company-item-3" data-index="3">
          <img src="assets/perusahaan 3.jpg" alt="" >
          <div class="company-detail company-detail-3" data-index="3">
            <h2>Hybe Insight</h2>
            <a href="" class="detail-btn"> <i class="fa-solid fa-list"></i>Detail Penelusuran</a>
          </div>
        </div>

        <div class="company-item company-item-4" data-index="4">
          <img src="assets/perusahaan 4.png" alt="" >
          <div class="company-detail company-detail-4" data-index="4">
            <h2>PT. Entertaiment</h2>
            <a href="" class="detail-btn"> <i class="fa-solid fa-list"></i>Detail Penelusuran</a>
          </div>
        </div>

        <div class="company-item company-item-5" data-index="5">
          <img src="assets/perusahaan 5.jpg" alt="" >
          <div class="company-detail company-detail-5" data-index="5">
            <h2>Google</h2>
            <a href="" class="detail-btn"> <i class="fa-solid fa-list"></i>Detail Penelusuran</a>
          </div>
        </div>

      </div>

      <div class="company-controls">

      </div>

      </div>
    </div>

    <script src="js/perusahaan.js"></script>

</body>
</html>
