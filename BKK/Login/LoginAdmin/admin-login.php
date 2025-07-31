<?php
require_once __DIR__ . '/../../config/helpers.php';

// ! Redirect jika sudah login sebagai admin
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    redirect('../../Home/HalamanUtama/berandautama.php');
    exit();
}

// ! Rate limiting
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
    $time_since_last = time() - ($_SESSION['last_login_attempt'] ?? 0);
    if ($time_since_last < 30) {
        $_SESSION['error'] = "Terlalu banyak percobaan. Silakan tunggu 30 detik.";
        redirect('admin-login.php');
        exit();
    } else {
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_login_attempt']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validate_csrf();
    
    // ! Sanitasi input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password harus diisi";
        redirect('admin-login.php');
        exit();
    }

    // TODO Ambil data admin dari database
    $sql = "SELECT id, username, password, role FROM users WHERE username = ? AND role = 'admin'";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // ! Regenerate session ID untuk mencegah session fixation
            session_regenerate_id(true);

            // ! Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['last_login'] = time();
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

            // ! Reset login attempts on success
            unset($_SESSION['login_attempts']);
            unset($_SESSION['last_login_attempt']);

            redirect('../../Home/HalamanUtama/berandautama.php');
            exit();
        } else {
            // ! Track failed attempts
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            $_SESSION['last_login_attempt'] = time();
            
            if (($_SESSION['login_attempts'] ?? 0) > 5) {
                $_SESSION['error'] = "Terlalu banyak percobaan login. Silakan coba lagi nanti.";
                redirect('admin-login.php');
                exit();
            }
            
            $_SESSION['error'] = "Username atau password salah";
            redirect('admin-login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Username atau password salah";
        redirect('admin-login.php');
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bursa Kerja Khusus</title>
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
                <p>Akun login</p>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                
                <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>
            
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password..." required>
                </div>
                <button type="submit" class="login-button">MASUK</button>
                <div class="reset-link">
                    <a href="reset-pw-admin.php">Reset Password</a>
                </div>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
</body>
</html>
