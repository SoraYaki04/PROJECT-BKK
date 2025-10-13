<?php
require_once __DIR__ . '/../../config/helpers.php';
allow_role(['admin', 'recruiter']);

$id = intval($_GET['id'] ?? 0);

if (!$id) {
    $_SESSION['error'] = "ID tidak valid.";
    redirect('loker.php');
}

// Eksekusi hapus
$stmt = $koneksi->prepare("DELETE FROM lowker WHERE id_lowker = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['success'] = "Lowongan berhasil dihapus.";
redirect('Loker.php');
