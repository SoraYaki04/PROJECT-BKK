<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Franklin+Demi+Cond&display=swap"
        rel="stylesheet">
    <link href="../../homeafterlogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

    <header>
        <div class="rectangle">
        </div>
        </div>

        <div class="logo">
            <div class="logo-header">
                <img src="../../../logo.png" alt="BKK SMKN 1 Boyolangu Logo">
            </div>
            <div class="header-text">
                <img src="../../../tulisan logo.png" alt="Bursa Kerja Khusus SMKN 1 Boyolangu" id="text-img">
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
                <li> <img class="profil-pojok" src="profiladminbkk.png"></li>
                <li>
                    <a href="#" class="active">HOME<i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="" class="active">Halaman Utama</a></li>
                        <li><a href="">Beranda</a></li>
                        <li><a href="">Tentang Kami</a></li>
                    </ul>
                </li>

                <li><a href="#">TRACER STUDY</a></li>
                <li><a href="#">INFORMASI JURUSAN</a></li>
                <li><a href="#">PERUSAHAAN</a></li>
                <li><a href="#">LOWONGAN KERJA</a></li>

                <li>
                    <a href="#">REKAP<i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="">Rekap Alumni</a></li>
                        <li><a href="">Rekap Lowongan Kerja</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">CRUD<i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="">CRUD Home</a></li>
                        <li><a href="">CRUD Lowongan Kerja</a></li>
                    </ul>
                </li>
            </ul>


        </nav>

        <section class="hero">
            <div class="hero-content">
                <h1>Bursa Kerja Khusus <br> SMKN 1 Boyolangu</h1>
                <hr>
                <div class="tagline"></div>
                <p class="tagline">DREAM - ACTION - SUCCES</p>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-button" target="_blank">Video
                    Tutorial<i class="fa-regular fa-circle-play"></i></a>

                <section class="survey-section">
                    <div class="survey-container">
                        <img src="../../isi survey BKK.png" alt="Isi Survey BKK" class="survey-image">
                        <a href="#" class="survey-button">
                            <i class="fa-solid fa-circle-check"></i> ISI SURVEY
                        </a>

                        <div class="survey-overlay">
                            <div class="lock-icon">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <p class="survey-message">*Survey ini hanya berlaku untuk Siswa/ Alumni</p>
                        </div>
                    </div>
                </section>

            </div>

        </section>

        <footer>
            <p>&copy; 2024 Bursa Kerja Khusus SMKN 1 Boyolangu. All Rights Reserved.</p>
        </footer>
    </div>


</body>

</html>
