<?php
session_start();
require_once __DIR__ . '/../../config/security.php'; 
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ! Validasi CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Akses tidak sah!");
    }

    // ! Sanitasi input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'] ?? '';

    // ! Validasi input
    if (empty($username) || empty($old_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: reset-pw-siswa.php");
        exit();
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Password baru dan konfirmasi password tidak sama!";
        header("Location: reset-pw-siswa.php");
        exit();
    }

    if (strlen($new_password) < 8) {
        $_SESSION['error'] = "Password baru minimal 8 karakter!";
        header("Location: reset-pw-siswa.php");
        exit();
    }

    // TODO Ambil data user
    $sql = "SELECT id, nama, password FROM alumni WHERE nama = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // todo Verifikasi password lama menggunakan password_verify()
if ($old_password === $user['password'] || password_verify($old_password, $user['password'])) {
            // ! Validasi panjang password baru
            if (strlen($new_password) < 8) {
                die("Password baru minimal 8 karakter!");
            }

            // ! Hash password baru
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // TODO Update password di database
            $update_sql = "UPDATE alumni SET password = ? WHERE id = ?";
            $update_stmt = $koneksi->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_new_password, $user['id']);

            if ($update_stmt->execute()) {
                $_SESSION['success'] = "Password berhasil diubah!";
                header("Location: siswa-alumni-login.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate password!";
                header("Location: reset-pw-siswa.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Password lama salah!";
            header("Location: reset-pw-siswa.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User tidak ditemukan!";
        header("Location: reset-pw-siswa.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Bursa Kerja Khusus</title>
    <link rel="stylesheet" href="../reset-pw.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="../../logo.png" alt="Logo" class="logo">
                <h2>Reset Password</h2>
                <p>Akun Siswa/Alumni</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="">
                <?php echo csrf_field(); ?>

                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" name="old_password" id="old_password" placeholder="Masukkan Password Lama..."
                        required>
                </div>
                <div class="input-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Masukkan Password Baru..."
                        required minlength="8">
                    <small>Minimal 8 karakter</small>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" id="confirm_password"
                        placeholder="Konfirmasi Password Baru..." required minlength="8">
                </div>
                <button type="submit" class="simpan-button btn">SIMPAN</button>
                <button type="button" class="lewati-button btn"
                    onclick="window.location.href='siswa-alumni-login.php'">LEWATI</button>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
</body>

</html>
