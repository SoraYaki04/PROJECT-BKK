<?php
require_once __DIR__ . '/../config/helpers.php';
?>

<nav class="navbar">
  <ul class="navbar-container">

    <?php if (is_alumni()): ?>
      <li>
        <div onclick="window.location.href='<?= base_url('Profil/profil.php') ?>'" class="profile-icon">
          <i class="fa-solid fa-user fa-sm student-profile" style="color: #5135FA;"></i>
        </div>
      </li>
    <?php endif; ?>

    <li>
      <a class="<?= nav_active(['Home/HalamanUtama/berandautama.php', 'Home/Pengantar/pengantar.php', 'Home/InformasiKegiatanBKK/informasikegiatanbkk.php']) ?>" href="#">HOME<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('Home/HalamanUtama/berandautama.php') ?>" href="<?= base_url('Home/HalamanUtama/berandautama.php') ?>">Halaman Utama</a></li>
        <li><a class="<?= nav_active('Home/Pengantar/pengantar.php') ?>" href="<?= base_url('Home/Pengantar/pengantar.php') ?>">Pengantar</a></li>
        <li><a class="<?= nav_active('Home/InformasiKegiatanBKK/informasikegiatanbkk.php') ?>" href="<?= base_url('Home/InformasiKegiatanBKK/informasikegiatanbkk.php') ?>">Informasi Kegiatan BKK</a></li>
        <li><a class="<?= nav_active('Rekap/rekap-alumni.php') ?>" href="<?= base_url('Rekap/rekap-alumni.php') ?>">Rekapitulasi</a></li>
      </ul>
    </li>

    <li>
      <a class="<?= nav_active(['TentangKami/visimisi.php', 'TentangKami/proker.php', 'TentangKami/tujuan.php', 'TentangKami/strukturorganisasi.php']) ?>" href="#">TENTANG KAMI<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('TentangKami/visimisi.php') ?>" href="<?= base_url('TentangKami/visimisi.php') ?>">Visi Misi</a></li>
        <li><a class="<?= nav_active('TentangKami/proker.php') ?>" href="<?= base_url('TentangKami/proker.php') ?>">Program Kerja</a></li>
        <li><a class="<?= nav_active('TentangKami/tujuan.php') ?>" href="<?= base_url('TentangKami/tujuan.php') ?>">Tujuan</a></li>
        <li><a class="<?= nav_active('TentangKami/strukturorganisasi.php') ?>" href="<?= base_url('TentangKami/strukturorganisasi.php') ?>">Struktur Organisasi</a></li>
      </ul>
    </li>

    <?php if (!is_logged_in()): ?>
    <li>
      <a href="#">LOGIN<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a href="<?= base_url('Login/LoginAdmin/admin-login.php') ?>">Admin BKK</a></li>
        <li><a href="<?= base_url('Login/LoginManagement/management-login.php') ?>">Management</a></li>
        <li><a href="<?= base_url('Login/LoginSiswa/siswa-alumni-login.php') ?>">Siswa / Alumni</a></li>
        <li><a href="<?= base_url('Login/LoginUserLain/pengguna-lain-login.html') ?>">Partisipan Lain</a></li>
      </ul>
    </li>
    <?php endif; ?>

    <li><a class="<?= nav_active('InformasiJurusan/informasiJurusan.php') ?>" href="<?= base_url('InformasiJurusan/informasiJurusan.php') ?>">INFORMASI JURUSAN</a></li>
    <li><a class="<?= nav_active('Perusahaan/perusahaan.php') ?>" href="<?= base_url('Perusahaan/perusahaan.php') ?>">PERUSAHAAN</a></li>
    <li>
      <a class="<?= nav_active(['Lowker/loker.php', 'Rekap/rekap-loker.php']) ?>" href="#">LOWONGAN KERJA<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('Lowker/loker.php') ?>" href="<?= base_url('Lowker/loker.php') ?>">Daftar Lowongan</a></li>
        <li><a class="<?= nav_active('Rekap/rekap-loker.php') ?>" href="<?= base_url('Rekap/rekap-loker.php') ?>">Rekap Lowongan Kerja</a></li>
      </ul>
    </li>
    <li><a class="<?= nav_active('Survey/survey.php') ?>" href="<?= base_url('Survey/survey.php') ?>">SURVEY</a></li>

  </ul>
</nav>
