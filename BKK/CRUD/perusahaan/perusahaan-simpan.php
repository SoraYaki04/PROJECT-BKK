<?php
require_once __DIR__ . '/../../config/helpers.php';

validate_csrf();

// Ambil data
$nama = trim($_POST['nama']);
$alamat = trim($_POST['alamat']);
$kota = trim($_POST['kota']);
$deskripsi_perusahaan = trim($_POST['deskripsi_perusahaan']);
$kontak = trim($_POST['kontak']);
$email = trim($_POST['email']);
$gambar = $_FILES['gambar'] ?? null;
$standar = trim($_POST['standar']);
$kategori = trim($_POST['kategori']);
$kerja_sama = trim($_POST['kerja_sama']);

// Validasi
$errors = [];

if (!$nama) $errors[] = "Nama";
if (!$alamat) $errors[] = "Alamat";
if (!$kota) $errors[] = "Kota";
if (!$deskripsi_perusahaan) $errors[] = "Deskripsi Perusahaan";
if (!$kontak) $errors[] = "Kontak";
if (!$email) $errors[] = "Email";
if (!$gambar) $errors[] = "Gambar";
if (!$standar) $errors[] = "Standar";
if (!$kategori) $errors[] = "Kategori";

if (!empty($errors)) {
    $_SESSION['error'] = "Field berikut wajib diisi: " . implode(", ", $errors);
    redirect('perusahaan.php');
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
        redirect('perusahaan.php');
    }

    if ($gambar['size'] > $maxSize) {
        $_SESSION['error'] = "Ukuran gambar melebihi 2MB.";
        redirect('perusahaan.php');
    }

    $uploadDir = __DIR__ . '/../../uploads/perusahaan/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $gambarName = uniqid('perusahaan_', true) . '.' . $ext;
    move_uploaded_file($gambar['tmp_name'], $uploadDir . $gambarName);
}

// Simpan ke database
$stmt = $koneksi->prepare("INSERT INTO perusahaan (nama, alamat, kota, deskripsi_perusahaan, kontak, email, gambar, standar, kategori, kerja_sama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $gambarName, $standar, $kategori, $kerja_sama);

if ($stmt->execute()) {
    $_SESSION['success'] = "Perusahaan berhasil ditambahkan.";
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
}

$stmt->close();

redirect('perusahaan.php');