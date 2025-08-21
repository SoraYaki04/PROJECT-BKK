<?php
require_once __DIR__ . '/../../config/helpers.php';
allow_role(['admin']);
validate_csrf();

$id = intval($_POST['id_perusahaan'] ?? 0);
$nama = trim($_POST['nama']);
$alamat = trim($_POST['alamat']);
$kota = trim($_POST['kota']);
$deskripsi_perusahaan = trim($_POST['deskripsi_perusahaan']);
$kontak = trim($_POST['kontak']);
$email = trim($_POST['email']);
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
if (!$standar) $errors[] = "Standar";
if (!$kategori) $errors[] = "Kategori";

if (!empty($errors)) {
    $_SESSION['error'] = "Field berikut wajib diisi: " . implode(", ", $errors);
    redirect('perusahaan.php');
}

// TODO  Ambil data lama untuk cek gambar lama
$lama = $koneksi->query("SELECT gambar FROM perusahaan WHERE id_perusahaan = $id")->fetch_assoc();
$gambarLama = $lama['gambar'] ?? null;

$gambarBaru = $gambarLama;

// ! Jika ada gambar baru diupload
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

    // TODO Hapus gambar lama
    if ($gambarLama) {
        $oldPath = __DIR__ . '/../../uploads/perusahaan/' . $gambarLama;
        if (file_exists($oldPath)) unlink($oldPath);
    }

    // TODO Simpan gambar baru
    $uploadDir = __DIR__ . '/../../uploads/perusahaan/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $gambarBaru = uniqid('perusahaan_', true) . '.' . $ext;
    move_uploaded_file($gambar['tmp_name'], $uploadDir . $gambarBaru);
}

// TODO Update data
$stmt = $koneksi->prepare("UPDATE perusahaan SET nama=?, alamat=?, kota=?, deskripsi_perusahaan=?, kontak=?, email=?, gambar=?, standar=?, kategori=?, kerja_sama=? WHERE id_perusahaan=?");
$stmt->bind_param("ssssssssssi", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $gambarBaru, $standar, $kategori, $kerja_sama, $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "perusahaan berhasil diubah.";
} else {
    $_SESSION['error'] = "Gagal mengubah data.";
}

$stmt->close();
redirect('perusahaan.php');
