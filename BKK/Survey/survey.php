<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../koneksi.php'; 
if (!isset($koneksi)) {
    die("Database connection not established.");
}

// Check if admin is logged in and track login status
$admin_logged_in = false;
$admin_username = '';
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $admin_logged_in = true;
    $admin_username = $_SESSION['username'] ?? '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = trim($_POST['survey-choice'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validasi dasar
    if (empty($choice)) {
        die("Pilihan survey tidak boleh kosong.");
    }

    // If admin is logged in, include admin info in description
    if ($admin_logged_in) {
        $description = "[ADMIN LOGIN: " . $admin_username . "] " . $description;
    }

    // Get alumni ID from form
    $alumni_id = $_POST['alumni_id'] ?? null;
    
    if (!$alumni_id) {
        die("Alumni ID is required to save survey data.");
    }

    // Insert survey data into survey table
    $stmt = $koneksi->prepare("INSERT INTO survey (id_alumni, pilihan_survey, kritiksaran, tgl_dibuat) VALUES (?, ?, ?, NOW())");
    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
    }

    $stmt->bind_param("iss", $alumni_id, $choice, $description);

    if ($stmt->execute()) {
        $success_message = "Terima kasih atas tanggapan Anda!";
        if ($admin_logged_in) {
            $success_message .= " (Status Admin: Login berhasil)";
        }
    } else {
        $error_message = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../partials/navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="survey.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body class="survey-page">

<?php include '../partials/navbar/header.php'; ?>

<div class="container">
    <?php
    if (!is_logged_in()) {
        include '../partials/navbar/guest.php';
    } elseif (is_alumni()) {
        include '../partials/navbar/alumni.php';
    } elseif (is_admin()) {
        include '../partials/navbar/admin.php';
    } else {
        include '../partials/navbar/guest.php';
    }
    ?>

    <div class="header-bar">
        <a href="#">Isi Survey</a>
        <?php if ($admin_logged_in): ?>
        <span style="float: right; color: #4CAF50; font-weight: bold;">
            <i class="fas fa-user-shield"></i> Admin: <?php echo htmlspecialchars($admin_username); ?>
            <a href="../Login/logout.php" style="margin-left: 15px; color: #dc3545; text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </span>
        <?php endif; ?>
    </div>

    <div class="survey-container">
        <?php if (isset($success_message)): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
        </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error_message); ?>
        </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="survey-title">
                <p>FORMULIR PENGISIAN SURVEY</p>
                <?php if ($admin_logged_in): ?>
                <p style="color: #4CAF50; font-size: 14px; margin-top: 10px;">
                    <i class="fas fa-info-circle"></i> Anda login sebagai Admin. Status login akan dicatat dalam survey.
                    <br>
                    <a href="../TracerStudy/tracer-study.php" style="color: #007bff; text-decoration: none; font-size: 12px;">
                        <i class="fas fa-chart-line"></i> Lihat Tracer Study
                    </a>
                </p>
                <?php endif; ?>
            </div>
            
            <div class="survey-box">
                <div class="survey-choice">
                    <p>Pilih Nama Alumni</p>
                    <select name="alumni_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                        <option value="">-- Pilih Nama Alumni --</option>
                        <?php
                        // Get all alumni for the dropdown
                        $alumni_query = "SELECT id, nama FROM alumni ORDER BY nama ASC";
                        $alumni_result = $koneksi->query($alumni_query);
                        while ($alumni = $alumni_result->fetch_assoc()) {
                            echo '<option value="' . $alumni['id'] . '">' . htmlspecialchars($alumni['nama']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="survey-box">
                <div class="survey-choice">
                    <p>Profesi yang sedang dijalani dalam 6 bulan terakhir</p>
                    <div class="survey-choice-container">
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="bekerja">
                            <p>Bekerja</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="wirausaha">
                            <p>Wirausaha</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="menganggur">
                            <p>Menganggur</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="magang">
                            <p>Magang</p>
                        </div>
                        <div class="survey-choice-input">
                            <input type="radio" name="survey-choice" value="kuliah">
                            <p>Kuliah</p>
                        </div>
                    </div>
                </div>
                <div class="survey-description">
                    <p>Keterangan</p>
                    <textarea placeholder="Misal Jurusan Kuliah/ Bidang Wirausaha/ Jabatan dalam Pekerjaan" name="description"></textarea>
                </div>
            </div>
            <div class="survey-submit">
                <button type="submit" class="survey-submit-btn">SUBMIT</button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('input[name="survey-choice"]').forEach((radio) => {
    radio.addEventListener('change', () => {});
});
</script>

</body>
</html>
