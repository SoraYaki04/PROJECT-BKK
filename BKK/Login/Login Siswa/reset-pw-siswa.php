<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bursa Kerja Khusus</title>
    <link rel="stylesheet" href="css/reset-pw.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="assets/foto logo.png" alt="Logo" class="logo">
                <h2>Reset Password</h2>
                <p>Akun Siswa/Alumni</p>
            </div>
            <form action="#">
                <div class="input-group">
                    <label for="username">Password Lama</label>
                    <input type="text" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" placeholder="Masukkan Password..." required>
                </div>
                <button type="submit" class="simpan-button">SIMPAN</button>
                <button type="submit" class="lewati-button">LEWATI</button>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
</body>
</html>
