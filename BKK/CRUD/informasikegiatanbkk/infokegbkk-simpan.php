<?php
require_once __DIR__ . '/../../config/helpers.php';

validate_csrf();

// Ambil data
$judul = trim($_POST['judul']);
$tanggal = $_POST['tanggal'];
$jml_peserta = (int)$_POST['jml_peserta'];
$lokasi = trim($_POST['lokasi']);
$deskripsi = trim($_POST['deskripsi']);

// Validasi
if (!$judul || !$tanggal || !$jml_peserta || !$lokasi || !$deskripsi) {
    $_SESSION['error'] = "Semua data wajib diisi.";
    redirect('infokegbkk.php');
}

// Upload Gambar
$gambarName = null;
if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar'];
    $allowedExt = ['jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024;

    $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $gambar['tmp_name']);
    finfo_close($finfo);

    if (!in_array($ext, $allowedExt) || !in_array($mime, ['image/jpeg', 'image/png'])) {
        $_SESSION['error'] = "Format gambar tidak valid.";
        redirect('infokegbkk.php');
    }

    if ($gambar['size'] > $maxSize) {
        $_SESSION['error'] = "Ukuran gambar melebihi 2MB.";
        redirect('infokegbkk.php');
    }

    $uploadDir = __DIR__ . '/../../uploads/kegiatan/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $gambarName = uniqid('kegiatan_', true) . '.' . $ext;
    move_uploaded_file($gambar['tmp_name'], $uploadDir . $gambarName);
}

// Simpan ke database
$stmt = $koneksi->prepare("INSERT INTO berita (judul, tanggal, jml_peserta, lokasi, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisss", $judul, $tanggal, $jml_peserta, $lokasi, $deskripsi, $gambarName);

if ($stmt->execute()) {
    $_SESSION['success'] = "Kegiatan berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
}

$stmt->close();

redirect('infokegbkk.php');
