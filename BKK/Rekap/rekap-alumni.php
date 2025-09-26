<?php
require_once __DIR__ . '/../config/helpers.php';


allow_role(['admin', 'alumni', 'siswa']);

// Rekap alumni per jurusan menggunakan status survey terbaru per alumni
$rekap = [];
$sql = "
  SELECT 
    j.id_jurusan,
    j.jurusan AS nama_jurusan,
    COUNT(a.id) AS total,
    COALESCE(SUM(CASE WHEN ss.pilihan_survey = 'kuliah' THEN 1 ELSE 0 END), 0) AS kuliah,
    COALESCE(SUM(CASE WHEN ss.pilihan_survey = 'wirausaha' THEN 1 ELSE 0 END), 0) AS wirausaha,
    COALESCE(SUM(CASE WHEN ss.pilihan_survey = 'bekerja' THEN 1 ELSE 0 END), 0) AS bekerja,
    COALESCE(SUM(CASE WHEN ss.pilihan_survey = 'menganggur' THEN 1 ELSE 0 END), 0) AS belum_bekerja
  FROM jurusan j
  LEFT JOIN alumni a ON a.id_jurusan = j.id_jurusan
  LEFT JOIN (
    SELECT s1.id_alumni, s1.pilihan_survey
    FROM survey s1
    JOIN (
      SELECT id_alumni, MAX(id_survey) AS max_id
      FROM survey
      GROUP BY id_alumni
    ) sm ON sm.id_alumni = s1.id_alumni AND sm.max_id = s1.id_survey
  ) ss ON ss.id_alumni = a.id
  GROUP BY j.id_jurusan, j.jurusan
  ORDER BY j.jurusan ASC
";

$q = $koneksi->query($sql);
if ($q) {
  while ($row = $q->fetch_assoc()) {
    $rekap[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Alumni</title>
    <link rel="stylesheet" href="rekap-alumni.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include '../navbar/header.php'
    ?>

    <div class="container">

        <!--  NAVBAR -->
        <?php
        if (!is_logged_in()) {
            include '../navbar/guest.php';
        } elseif (is_alumni()) {
            include '../navbar/alumni.php';
        } elseif (is_admin()) {
            include '../navbar/admin.php';
        }
        ?>
    </div>

    <div class="header-bar">
        <a href="#">Rekap Alumni</a>
    </div>

    <div class="container-tabel">


        <?php if (!empty($rekap)): ?>
          <?php foreach ($rekap as $r): ?>
            <div class="tabel-wrapper">
                <div class="judul-tabel"><?= htmlspecialchars($r['nama_jurusan']) ?></div>
                <table>
                    <tr>
                        <td>Total</td>
                        <td><?= (int)$r['total'] ?></td>
                    </tr>
                    <tr>
                        <td>Kuliah</td>
                        <td><?= (int)$r['kuliah'] ?></td>
                    </tr>
                    <tr>
                        <td>Wirausaha</td>
                        <td><?= (int)$r['wirausaha'] ?></td>
                    </tr>
                    <tr>
                        <td>Bekerja</td>
                        <td><?= (int)$r['bekerja'] ?></td>
                    </tr>
                    <tr>
                        <td>Belum Bekerja</td>
                        <td><?= (int)$r['belum_bekerja'] ?></td>
                    </tr>
                </table>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="text-align:center; color:#666;">Tidak ada data jurusan.</p>
        <?php endif; ?>


    </div>

  <script>
    const content = document.querySelectorAll('.tabel-wrapper');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.1
    });

    content.forEach(content => {
      observer.observe(content);
    });
  </script>

</body>

</html>
