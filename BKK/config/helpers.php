<?php
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/security.php';

function redirect($url) {
    header("Location: $url");
    exit;
}

// ? AUTH
// * Cek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// * Cek apakah user memiliki role yang diizinkan
function allow_role(array $allowed_roles) {
    if (!is_logged_in()) {
        redirect('../Login/logout.php');
    }

    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
        echo "<h3>Akses ditolak. Halaman ini hanya untuk " . implode(", ", $allowed_roles) . "</h3>";
        exit;
    }
}

// * Fungsi khusus untuk admin
function is_admin() {
    return is_logged_in() && ($_SESSION['role'] ?? '') === 'admin';
}

// * Fungsi khusus untuk alumni
function is_alumni() {
    return is_logged_in() && ($_SESSION['role'] ?? '') === 'alumni';
}

// * Fungsi khusus untuk manajemen
function is_manajemen() {
    return is_logged_in() && ($_SESSION['role'] ?? '') === 'manajemen';
}

function is_recruiter() {
    return is_logged_in() && ($_SESSION['role'] ?? '') === 'recruiter';
}

// ? NAVBAR
function base_url($path = '') {
    return '/BKK/PROJECT-BKK-main/bkk/' . ltrim($path, '/');
}

function nav_active($path_or_paths) {
    $current = $_SERVER['REQUEST_URI'];

    if (is_array($path_or_paths)) {
        foreach ($path_or_paths as $path) {
            if (strpos($current, $path) !== false) return 'active';
        }
    } else {
        if (strpos($current, $path_or_paths) !== false) return 'active';
    }

    return '';
}




// ? DELETE
function delete_uploaded_image($filename) {
    $uploadDir = __DIR__ . '/../uploads/kegiatan/';
    if (!$filename || strpos($filename, '..') !== false) return false;

    $filePath = $uploadDir . $filename;
    return (file_exists($filePath) && is_file($filePath)) ? unlink($filePath) : false;
}



?>



