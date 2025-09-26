<?php
require_once __DIR__ . '/../config/helpers.php';
include __DIR__ . '/../koneksi.php';

// Initialize jurusan variable
$jurusan = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';

// Check if database connection is working and tables exist
$database_error = false;
$error_message = '';

try {
    // Test if alumni table exists
    $test_query = "SHOW TABLES LIKE 'alumni'";
    $test_result = $koneksi->query($test_query);
    
    if ($test_result->num_rows == 0) {
        $database_error = true;
        $error_message = "Database tables not found. Please run the database setup first.";
    } else {
        // Test if the alumni table has the expected structure
        $test_query = "DESCRIBE alumni";
        $test_result = $koneksi->query($test_query);
        $columns = [];
        while ($row = $test_result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        
        if (!in_array('id', $columns)) {
            $database_error = true;
            $error_message = "Database structure is incorrect. Please import the correct database schema.";
        }
    }
} catch (Exception $e) {
    $database_error = true;
    $error_message = "Database connection error: " . $e->getMessage();
}

// Get jurusan mapping
$jurusan_mapping = [
    'RPL' => 7,  // REKAYASA PERANGKAT LUNAK
    'TKJ' => 9,  // TEKNIK KOMPUTER JARINGAN
    'KI' => 8,   // TEKNIK KIMIA INDUSTRI
    'DKV' => 4,  // DESAIN KOMUNIKASI VISUAL
    'ANM' => 2,  // ANIMASI
    'AK' => 1,   // AKUNTANSI
    'MP' => 5,   // MANAJEMEN PERKANTORAN
    'BD' => 3,   // BISNIS DIGITAL
    'ULW' => 10, // USAHA LAYANAN WISATA
    'PSPT' => 6  // PROGAM SIARAN PENYIARAN TELEVISI
];

$result = null;
$total_count = 0;
$stats = ['total_alumni' => 0, 'sudah_survey' => 0, 'belum_survey' => 0];

if (!$database_error) {
    try {
        // Build query to get alumni with their survey data
        $where_clause = '';
        $params = [];
        $types = '';

        if (!empty($jurusan) && isset($jurusan_mapping[$jurusan])) {
            $where_clause = "WHERE a.id_jurusan = ?";
            $params[] = $jurusan_mapping[$jurusan];
            $types .= 'i';
        }

        $query = "SELECT 
            a.id,
            a.nama,
            a.id_jurusan,
            j.jurusan as nama_jurusan,
            s.pilihan_survey,
            s.kritiksaran,
            s.tgl_dibuat,
            CASE 
                WHEN s.id_survey IS NOT NULL THEN 'Sudah Mengisi Survey'
                ELSE 'Belum Mengisi Survey'
            END as status_survey
        FROM alumni a
        LEFT JOIN jurusan j ON a.id_jurusan = j.id_jurusan
        LEFT JOIN survey s ON a.id = s.id_alumni
        " . $where_clause . "
        ORDER BY a.nama ASC";

        $stmt = $koneksi->prepare($query);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        // Get total count for footer
        $count_query = "SELECT COUNT(*) as total FROM alumni a " . $where_clause;
        $count_stmt = $koneksi->prepare($count_query);
        if (!empty($params)) {
            $count_stmt->bind_param($types, ...$params);
        }
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $total_count = $count_result->fetch_assoc()['total'];

        // stats section removed per request

    } catch (Exception $e) {
        $database_error = true;
        $error_message = "Database query error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study</title>
    <link rel="stylesheet" href="tracer-study.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php include __DIR__ . '/../navbar/header.php' ?>

    <div class="container">

        <!--  NAVBAR -->
        <?php
        if (!is_logged_in()) {
            include __DIR__ . '/../navbar/guest.php';
        } elseif (is_alumni()) {
            include __DIR__ . '/../navbar/alumni.php';
        } elseif (is_admin()) {
            include __DIR__ . '/../navbar/admin.php';
        }
        ?>

        <div class="header-bar">
            <a href="#">Tracer Study Alumni</a>
        </div>

        <div class="container-tracer">
            <h2><strong>TRACER STUDY DATA ALUMNI SMKN 1 BOYOLANGU</strong></h2>

            <div class="jurusan-buttons">
                <a href="?jurusan=RPL" class="btn <?php echo ($jurusan == 'RPL') ? 'active' : ''; ?>">RPL</a>
                <a href="?jurusan=TKJ" class="btn <?php echo ($jurusan == 'TKJ') ? 'active' : ''; ?>">TKJ</a>
                <a href="?jurusan=KI" class="btn <?php echo ($jurusan == 'KI') ? 'active' : ''; ?>">KI</a>
                <a href="?jurusan=DKV" class="btn <?php echo ($jurusan == 'DKV') ? 'active' : ''; ?>">DKV</a>
                <a href="?jurusan=ANM" class="btn <?php echo ($jurusan == 'ANM') ? 'active' : ''; ?>">ANM</a>
                <a href="?jurusan=AK" class="btn <?php echo ($jurusan == 'AK') ? 'active' : ''; ?>">AK</a>
                <a href="?jurusan=MP" class="btn <?php echo ($jurusan == 'MP') ? 'active' : ''; ?>">MP</a>
                <a href="?jurusan=BD" class="btn <?php echo ($jurusan == 'BD') ? 'active' : ''; ?>">BD</a>
                <a href="?jurusan=ULW" class="btn <?php echo ($jurusan == 'ULW') ? 'active' : ''; ?>">ULW</a>
                <a href="?jurusan=PSPT" class="btn <?php echo ($jurusan == 'PSPT') ? 'active' : ''; ?>">PSPT</a>
            </div>

            <h3>2023/2024</h3>
            
            <?php if ($database_error): ?>
            <div style="background: #ffebee; border: 1px solid #f44336; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h3 style="color: #d32f2f; margin-top: 0;">
                    <i class="fas fa-exclamation-triangle"></i> Database Error
                </h3>
                <p style="color: #d32f2f; margin-bottom: 15px;"><?php echo htmlspecialchars($error_message); ?></p>
                <div style="background: #f5f5f5; padding: 15px; border-radius: 5px;">
                    <h4 style="margin-top: 0; color: #333;">To fix this issue:</h4>
                    <ol style="color: #555;">
                        <li>Make sure XAMPP MySQL service is running</li>
                        <li>Import the database schema from the <code>db/</code> folder</li>
                        <li>Run the database setup: <a href="../setup_database.php" style="color: #1976d2;">setup_database.php</a></li>
                    </ol>
                </div>
            </div>
            <?php else: ?>
            
            <?php if (!empty($jurusan)): ?>
            <div style="background: #e3f2fd; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <strong>Filter Jurusan: <?php echo htmlspecialchars($jurusan); ?></strong>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (!$database_error): ?>
            <table class="tracer-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Status Survey</th>
                        <th>Tanggal Survey</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result && $result->num_rows > 0):
                        $counter = 1;
                        while ($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_jurusan'] ?? 'Tidak Diketahui'); ?></td>
                        <td>
                            <?php if ($row['status_survey'] == 'Sudah Mengisi Survey'): ?>
                                <span style="color: #4CAF50; font-weight: bold;">
                                    <i class="fas fa-check-circle"></i> Sudah Mengisi
                                </span>
                            <?php else: ?>
                                <span style="color: #f44336; font-weight: bold;">
                                    <i class="fas fa-times-circle"></i> Belum Mengisi
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['tgl_dibuat']): ?>
                                <?php echo date('d/m/Y', strtotime($row['tgl_dibuat'])); ?>
                            <?php else: ?>
                                <span style="color: #999;">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                            <i class="fas fa-info-circle"></i> Tidak ada data alumni yang ditemukan.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Jumlah Alumni :</strong></td>
                        <td colspan="2"><strong><?php echo $total_count; ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?>



        </div>
    </div>

  <script>
    const cards = document.querySelectorAll('.container-tracer');

    function togglePopup(popupId) {
      document.getElementById(popupId).classList.toggle("active");
    }


    // ! SMOOTH SCROLLING
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.1
    });

    cards.forEach(card => {
      observer.observe(card);
    });
  </script>

</body>

</html>
