<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Jurusan</title>
  <link rel="stylesheet" href="../css/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="informasiJurusan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
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
          <a href="../Home/Halaman Utama/berandautama.html">HOME<i class="fa-solid fa-chevron-down"></i></a>
          <ul class="dropdown">
            <li><a href="../Home/Halaman Utama/berandautama.html">Halaman Utama</a></li>
            <li><a href="../Home/Pengantar/pengantar.html">Pengantar</a></li>
            <li><a href="../Home/Informasi Kegiatan BKK/informasikegiatanbkk.html">Informasi Kegiatan BKK</a></li>
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
            <li><a href="../Login/admin-login.html">Admin BKK</a></li>
            <li><a href="../Login/management-login.html">Management</a></li>
            <li><a href="../Login/siswa-alumni-login.html">Siswa / Alumni</a></li>
            <li><a href="../Login/pengguna-lain-login.html">Partisipan Lain</a></li>
          </ul>
        </li>

        <li><a href="#" class="active">INFORMASI JURUSAN</a></li>
        <li><a href="../Perusahaan/perusahaan.php">PERUSAHAAN</a></li>
        <li><a href="../Lowker/loker.php">LOWONGAN KERJA</a></li>
      </ul>


    </nav>

    <div class="header-bar">
      <a href="#">Informasi Jurusan</a>
    </div>


    <div class="card-container">
      
      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="title">
          <p>Teknik Kimia Industri</p>
        </div>
        <div class="card-content">
          <div class="foto">
            <img src="ki 1.png" alt="">
          </div>
          <div class="deskripsi">
            <hr>
            <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
              kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
              industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat mengubah
              bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
            <button onclick="togglePopup('popup-1')" class="read-more-btn">Baca Selengkapnya...</button>
          </div>
        </div>
      </div>
      <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="card-popup">
          <div class="title">
            <p>Teknik Kimia Industri</p>
          </div>
          <div class="popup-content">
            <div class="card-content">
              <div class="foto-popup">
                <img src="ki 1.png" alt="">
                <img src="KI 4 1.png" alt="">
              </div>
              <div class="deskripsi">
                <hr>
                <p>Jurusan Teknik Kimia Industri adalah salah satu bidang studi yang menggabungkan ilmu teknik dan ilmu
                  kimia untuk mempelajari proses-proses industri yang melibatkan bahan kimia. Secara umum, teknik kimia
                  industri memfokuskan pada pengembangan, perancangan, dan pengoperasian sistem industri yang dapat
                  mengubah bahan mentah menjadi produk jadi melalui proses kimia dan fisik yang efisien.</p>
                <br>
                <ul>
                  <h3>Proyek Kerja :</h3>
                  <ul>
                    <li>Industri perminyakan dan gas alam</li>
                    <li>Pertambangan batu bara</li>
                    <li>Industri semen</li>
                    <li>Industri pupuk</li>
                    <li>Process Engineer (Insinyur Proses): Bertanggung jawab atas desain dan pengoptimalan proses
                      produksi</li>
                    <li>Production Manager (Manajer Produksi): Mengelola proses produksi dan memastikan kualitas serta
                      efisiensi</li>
                    <li>Quality Control Analyst (Analis Kontrol Kualitas): Memastikan produk yang dihasilkan memenuhi
                      standar kualitas</li>
                    <li>Environmental Engineer (Insinyur Lingkungan): Mengelola dan meminimalkan dampak lingkungan dari
                      proses industri</li>
                    <li>Research and Development (R&D): Mengembangkan produk baru atau meningkatkan proses produksi yang
                      sudah ada</li>
                  </ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="close-popup">
            <button class="close-btn" onclick="togglePopup('popup-1')">&times;</button>
          </div>
        </div>
      </div>

    </div>


  </div>



  <script>
    const cards = document.querySelectorAll('.card');

    function togglePopup(popupId) {
      document.getElementById(popupId).classList.toggle("active");
    }


    // ! SMOOTH SCROLLING
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