<?php
session_start();
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Cek kredensial lama
    $sql = "SELECT * FROM users WHERE username = ? AND password = ? AND role = 'admin'";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $username, $old_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $update_sql = "UPDATE users SET password = ? WHERE username = ? AND role = 'admin'";
        $update_stmt = $koneksi->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $username);
        
        if ($update_stmt->execute()) {
            echo "<script>
                alert('Password berhasil diubah!');
                window.location.href='siswa-alumni-login.php';
            </script>";
        } else {
            echo "<script>alert('Gagal mengubah password!');</script>";
        }
        $update_stmt->close();
    } else {
        echo "<script>alert('Username atau password lama tidak valid!');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Bursa Kerja Khusus</title>
    <link rel="stylesheet" href="../login.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="../../logo.png" alt="Logo" class="logo">
                <h2>Reset Password</h2>
                <p>Akun admin</p>
            </div>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" name="old_password" id="old_password" placeholder="Masukkan Password Lama..." required>
                </div>
                <div class="input-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Masukkan Password Baru..." required>
                </div>
                <button type="submit" class="simpan-button">SIMPAN</button>
                <button type="button" class="lewati-button" onclick="window.location.href='admin-login.php'">LEWATI</button>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
</body>
</html>
