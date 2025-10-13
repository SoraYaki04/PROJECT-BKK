<?php
require_once __DIR__ . '/../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Jurusan</title>
  <link rel="stylesheet" href="../partials/navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="informasiJurusan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

  <?php include '../partials/navbar/header.php' ?>

  <div class="container">

      <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
        include '../partials/navbar/guest.php';
    } elseif (is_alumni()) {
        include '../partials/navbar/alumni.php';
    } elseif (is_admin()) {
        include '../partials/navbar/admin.php';
    }
    ?>

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


    // ! CARD CLICK -> OPEN ITS SIBLING POPUP
    cards.forEach(card => {
      const sibling = card.nextElementSibling;
      if (sibling && sibling.classList.contains('popup')) {
        card.addEventListener('click', () => {
          sibling.classList.add('active');
        });
      }
    });

    // ! READ MORE BUTTON: remove inline onclick and open only sibling popup
    document.querySelectorAll('.deskripsi .read-more-btn').forEach(btn => {
      // Remove inline onclick that toggles duplicated id popups
      btn.removeAttribute('onclick');
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation(); // prevent triggering card click
        const card = btn.closest('.card');
        const popup = card && card.nextElementSibling;
        if (popup && popup.classList.contains('popup')) {
          popup.classList.add('active');
        }
      });
    });

    // ! OVERLAY CLICK -> CLOSE POPUP
    document.querySelectorAll('.popup .overlay').forEach(overlay => {
      overlay.addEventListener('click', () => {
        const popup = overlay.closest('.popup');
        if (popup) popup.classList.remove('active');
      });
    });

    // ! CLOSE BUTTON (X): remove inline onclick and close nearest popup
    document.querySelectorAll('.popup .close-btn').forEach(btn => {
      btn.removeAttribute('onclick');
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const popup = btn.closest('.popup');
        if (popup) popup.classList.remove('active');
      });
    });

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