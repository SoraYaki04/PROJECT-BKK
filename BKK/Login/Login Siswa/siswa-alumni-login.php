<?php
session_start();
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Ambil user berdasarkan nama saja
    $sql = "SELECT * FROM alumni WHERE nama = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];

        // Cek apakah password cocok (plaintext atau hash)
        if ($password === $stored_password || password_verify($password, $stored_password)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: Home Siswa/homesiswa.php");
            exit();
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa/ Alumni - Bursa Kerja Khusus</title>
    <link rel="stylesheet" href="../login.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="../../logo.png" alt="Logo" class="logo">
                <h2>Login</h2>
                <p>Akun Siswa/Alumni</p>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="nama">Username</label>
                    <input type="text" name="nama" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password..." required>
                </div>
                <button type="submit" class="login-button">MASUK</button>
                <div class="reset-link">
                    <a href="reset-pw-siswa.php">Reset Password</a>
                </div>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
