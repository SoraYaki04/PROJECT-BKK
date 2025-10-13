<?php
require_once __DIR__ . '/../../config/helpers.php';
allow_role(['admin', 'recruiter']);

$id = intval($_GET['id'] ?? 0);

if (!$id) {
    $_SESSION['error'] = "ID tidak valid.";
    redirect('infokegbkk.php');
}

// TODO Ambil nama gambar sebelum hapus
$stmt = $koneksi->prepare("SELECT gambar FROM berita WHERE id_berita = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    $_SESSION['error'] = "Data tidak ditemukan.";
    redirect('infokegbkk.php');
}

// TODO Hapus gambar jika ada
if (!empty($row['gambar'])) {
    delete_uploaded_image($row['gambar']);
}

// TODO Hapus data dari DB
$stmt = $koneksi->prepare("DELETE FROM berita WHERE id_berita = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$_SESSION['success'] = "Kegiatan berhasil dihapus.";
redirect('infokegbkk.php');
?>