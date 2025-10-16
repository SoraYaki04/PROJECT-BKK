<?php
require_once __DIR__ . '/../config/helpers.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// koneksi sudah dimuat via helpers.php
global $koneksi;
if (!isset($koneksi)) {
    die("Database connection not established.");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = trim($_POST['survey-choice'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Validasi dasar
    if (empty($choice)) {
        die("Pilihan survey tidak boleh kosong.");
    }


    // Tentukan alumni ID: jika alumni login, ambil dari session; selain itu ambil dari form
    if (is_alumni()) {
        $alumni_id = $_SESSION['user_id'] ?? null;
    } else {
        $alumni_id = $_POST['alumni_id'] ?? null;
    }
    
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
    } else {
        include '../partials/navbar/guest.php';
    }
    ?>

    <div class="header-bar">
        <a href="#">Isi Survey</a>
    </div>

    <div class="survey-container">
        <?php if (isset($success_message)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
        </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error_message); ?>
        </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="survey-title">
                <p>FORMULIR PENGISIAN SURVEY</p>
            </div>
            
            <div class="survey-box">
                <div class="survey-choice">
                    <?php if (is_alumni()): ?>
                        <?php
                        $alumni_id = $_SESSION['user_id'] ?? null;
                        $alumni_nama = '';
                        if ($alumni_id) {
                            $stmtA = $koneksi->prepare("SELECT nama FROM alumni WHERE id = ?");
                            $stmtA->bind_param("i", $alumni_id);
                            $stmtA->execute();
                            $resA = $stmtA->get_result()->fetch_assoc();
                            $alumni_nama = $resA['nama'] ?? '';
                        }
                        ?>
                        <p>Alumni</p>
                        <div class="alumni-badge">
                            <i class="fas fa-user-graduate"></i>
                            <span><?php echo htmlspecialchars($alumni_nama); ?></span>
                        </div>
                        <input type="hidden" name="alumni_id" value="<?php echo (int)$alumni_id; ?>">
                    <?php else: ?>
                        <p>Pilih Nama Alumni</p>
                        <select name="alumni_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                            <option value="">-- Pilih Nama Alumni --</option>
                            <?php
                            $alumni_query = "SELECT id, nama FROM alumni ORDER BY nama ASC";
                            $alumni_result = $koneksi->query($alumni_query);
                            while ($alumni = $alumni_result->fetch_assoc()) {
                                echo '<option value="' . $alumni['id'] . '">' . htmlspecialchars($alumni['nama']) . '</option>';
                            }
                            ?>
                        </select>
                    <?php endif; ?>
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

<!-- no inline scripts needed -->

</body>
</html>
