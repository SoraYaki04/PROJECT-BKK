<?php
require_once __DIR__ . '/../config/helpers.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struktur Organisasi BKK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="../partials/navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="strukturorganisasi.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <?php include '../partials/navbar/header.php' ?>

  <div class="container">

    <!--  NAVBAR -->
    <?php
    if (!is_logged_in()) {
        include '../partials/navbar/guest.php';
    } elseif (is_alumni()) {
        include '../partials/navbar/alumni.php';
    } elseif (is_admin()) {
        include '../partials/navbar/admin.php';
    }
    ?>
    <div class="container">
      <div class="header-bar">
        <a href="#">TENTANG KAMI / Struktur Organisasi BKK</a>
      </div>

      <div class="strukturorg">
        <img src="strukturorg.png">
      </div>
    </div>
  </div>
</body>

</html>