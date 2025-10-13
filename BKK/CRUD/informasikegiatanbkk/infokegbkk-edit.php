<?php
require_once __DIR__ . '/../../config/helpers.php';
allow_role(['admin']);
validate_csrf();

$id = intval($_POST['id_berita'] ?? 0);
$judul = trim($_POST['judul']);
$tanggal = $_POST['tanggal'];
$jml_peserta = trim($_POST['jml_peserta']);
$lokasi = trim($_POST['lokasi']);
$deskripsi = trim($_POST['deskripsi']);

if (!$id || !$judul || !$tanggal || !$jml_peserta || !$lokasi || !$deskripsi) {
    $_SESSION['error'] = "Semua data wajib diisi.";
    redirect('infokegbkk.php');
}

// TODO  Ambil data lama untuk cek gambar lama
$lama = $koneksi->query("SELECT gambar FROM berita WHERE id_berita = $id")->fetch_assoc();
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
        redirect('infokegbkk.php');
    }

    if ($gambar['size'] > $maxSize) {
        $_SESSION['error'] = "Ukuran gambar melebihi 2MB.";
        redirect('infokegbkk.php');
    }

    // TODO Hapus gambar lama
    if ($gambarLama) {
        $oldPath = __DIR__ . '/../../uploads/kegiatan/' . $gambarLama;
        if (file_exists($oldPath)) unlink($oldPath);
    }

    // TODO Simpan gambar baru
    $uploadDir = __DIR__ . '/../../uploads/kegiatan/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $gambarBaru = uniqid('kegiatan_', true) . '.' . $ext;
    move_uploaded_file($gambar['tmp_name'], $uploadDir . $gambarBaru);
}

// TODO Update data
$stmt = $koneksi->prepare("UPDATE berita SET judul=?, tanggal=?, jml_peserta=?, lokasi=?, deskripsi=?, gambar=? WHERE id_berita=?");
$stmt->bind_param("ssisssi", $judul, $tanggal, $jml_peserta, $lokasi, $deskripsi, $gambarBaru, $id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Kegiatan berhasil diubah.";
} else {
    $_SESSION['error'] = "Gagal mengubah data.";
}

$stmt->close();
redirect('infokegbkk.php');
