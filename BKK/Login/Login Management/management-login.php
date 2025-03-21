<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Management - Bursa Kerja Khusus</title>
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
                <p>Akun Management</p>
            </div>
            <form action="#">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Masukkan Password..." required>
                </div>
                <button type="submit" class="login-button">MASUK</button>
            </form>
            <p class="footer-text">Bursa Kerja Khusus SMKN 1 Boyolangu</p>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = new mysqli("localhost", "your_username", "your_password", "bkk");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM users WHERE username = ? AND password = ? AND role = 'management'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
