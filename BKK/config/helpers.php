<?php
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/security.php';

function redirect($url) {
    header("Location: $url");
    exit;
}

// Contoh fungsi auth
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>