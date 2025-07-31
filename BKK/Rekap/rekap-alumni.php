<?php
require_once __DIR__ . '/../config/helpers.php';


allow_role(['admin']);
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
            include 'navbar/guest.php';
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


        <div class="tabel-wrapper">
            <div class="judul-tabel">Rekayasa Perangkat Lunak</div>
            <table>
                <tr>
                    <td>Total</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Kuliah</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>Wirausaha</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Bekerja</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Belum Bekerja</td>
                    <td>10</td>
                </tr>
            </table>
        </div>

        <!-- Tabel 2 -->
        <div class="tabel-wrapper">
            <div class="judul-tabel">Desain Komunikasi Visual</div>
            <table>
                <tr>
                    <td>Total</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Kuliah</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>Wirausaha</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Bekerja</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Belum Bekerja</td>
                    <td>10</td>
                </tr>
            </table>
        </div>

        <!-- Tabel 3 -->
        <div class="tabel-wrapper">
            <div class="judul-tabel">Teknik Komputer dan Jaringan</div>
            <table>
                <tr>
                    <td>Total</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Kuliah</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>Wirausaha</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Bekerja</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Belum Bekerja</td>
                    <td>10</td>
                </tr>
            </table>
        </div>


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