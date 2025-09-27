<?php
require_once __DIR__ . '/../config/helpers.php';
?>

<style>
.navbar ul li a {
    padding: 10px 10px;
}

.navbar ul li.crud-dropdown ul.dropdown {
  right: 0;
  left: auto;
}

</style>

<nav class="navbar">
  <ul class="navbar-container">
    <li>
      <a class="<?= nav_active(['Home/HalamanUtama/berandautama.php', 'Home/Pengantar/pengantar.php', 'Home/InformasiKegiatanBKK/informasikegiatanbkk.php']) ?>" href="#">HOME<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('Home/HalamanUtama/berandautama.php') ?>" href="<?= base_url('Home/HalamanUtama/berandautama.php') ?>">Halaman Utama</a></li>
        <li><a class="<?= nav_active('Home/Pengantar/pengantar.php') ?>" href="<?= base_url('Home/Pengantar/pengantar.php') ?>">Pengantar</a></li>
        <li><a class="<?= nav_active('Home/InformasiKegiatanBKK/informasikegiatanbkk.php') ?>" href="<?= base_url('Home/InformasiKegiatanBKK/informasikegiatanbkk.php') ?>">Informasi Kegiatan BKK</a></li>
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

    <li><a class="<?= nav_active('TracerStudy/tracer-study.php') ?>" href="<?= base_url('TracerStudy/tracer-study.php') ?>">TRACER STUDY</a></li>
    <li><a class="<?= nav_active('InformasiJurusan/informasiJurusan.php') ?>" href="<?= base_url('InformasiJurusan/informasiJurusan.php') ?>">INFORMASI JURUSAN</a></li>
    <li><a class="<?= nav_active('Perusahaan/perusahaan.php') ?>" href="<?= base_url('Perusahaan/perusahaan.php') ?>">PERUSAHAAN</a></li>
    <li><a class="<?= nav_active('Lowker/loker.php') ?>" href="<?= base_url('Lowker/loker.php') ?>">LOWONGAN KERJA</a></li>

    <li>
      <a class="<?= nav_active(['Rekap/rekap-alumni.php', 'Rekap/rekap-loker.php']) ?>" href="#">REKAP<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('Rekap/rekap-alumni.php') ?>" href="<?= base_url('Rekap/rekap-alumni.php') ?>">Rekap Alumni</a></li>
        <li><a class="<?= nav_active('Rekap/rekap-loker.php') ?>" href="<?= base_url('Rekap/rekap-loker.php') ?>">Rekap Lowongan Kerja</a></li>
      </ul>
    </li>

    <li class="crud-dropdown">
      <a class="<?= nav_active(['CRUD/perusahaan/perusahaan.php', 'CRUD/loker/loker.php', 'CRUD/loker/loker-tambah.php', 'CRUD/informasikegiatanbkk/infokegbkk.php']) ?>" href="#">C.R.U.D<i class="fa-solid fa-chevron-down"></i></a>
      <ul class="dropdown">
        <li><a class="<?= nav_active('CRUD/informasikegiatanbkk/infokegbkk.php') ?>" href="<?= base_url('CRUD/informasikegiatanbkk/infokegbkk.php') ?>">CRUD Kegiatan BKK</a></li>
        <li><a class="<?= nav_active('CRUD/perusahaan/perusahaan.php') ?>" href="<?= base_url('CRUD/perusahaan/perusahaan.php') ?>">CRUD Perusahaan</a></li>
        <li><a class="<?= nav_active('CRUD/loker/loker.php') ?>" href="<?= base_url('CRUD/loker/loker.php') ?>">CRUD Lowongan Kerja</a></li>
      </ul>
    </li>

  </ul>
</nav>
