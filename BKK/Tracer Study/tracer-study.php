<?php
require_once __DIR__ . '/../config/helpers.php';

allow_role(['admin']);

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

    <?php include '../navbar/header.php' ?>

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

        <div class="header-bar">
            <a href="#">Tracer Study Alumni</a>
        </div>

        <div class="container-tracer">
            <h2><strong>TRACER STUDY DATA ALUMNI SMKN 1 BOYOLANGU</strong></h2>

            <div class="jurusan-buttons">
                <button class="btn <?php echo ($jurusan == 'RPL') ? 'active' : ''; ?>">RPL</button>
                <button class="btn <?php echo ($jurusan == 'TKJ') ? 'active' : ''; ?>">TKJ</button>
                <button class="btn <?php echo ($jurusan == 'KI') ? 'active' : ''; ?>">KI</button>
                <button class="btn <?php echo ($jurusan == 'DKV') ? 'active' : ''; ?>">DKV</button>
                <button class="btn <?php echo ($jurusan == 'ANM') ? 'active' : ''; ?>">ANM</button>
                <button class="btn <?php echo ($jurusan == 'AK') ? 'active' : ''; ?>">AK</button>
                <button class="btn <?php echo ($jurusan == 'MP') ? 'active' : ''; ?>">MP</button>
                <button class="btn <?php echo ($jurusan == 'BD') ? 'active' : ''; ?>">BD</button>
                <button class="btn <?php echo ($jurusan == 'ULW') ? 'active' : ''; ?>">ULW</button>
                <button class="btn <?php echo ($jurusan == 'PSPT') ? 'active' : ''; ?>">PSPT</button>
            </div>

            <h3>2023/2024</h3>

            <table class="tracer-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Andreano Sebastian Alfarisy</td>
                        <td>Bekerja, Kuliah</td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Andin</td>
                        <td>Magang</td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Badrun</td>
                        <td>Menganggur</td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Beni</td>
                        <td>Bekerja</td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Cici</td>
                        <td>Bekerja</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Chandra</td>
                        <td>Kuliah</td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Danang</td>
                        <td>Menganggur</td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Dani</td>
                        <td>Bekerja</td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Dinar</td>
                        <td>Magang</td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Ersha</td>
                        <td>Kuliah</td>
                    </tr>
                    <!-- Tambahan data siswa -->
                    <tr>
                        <td>11.</td>
                        <td>Fajar</td>
                        <td>Kuliah</td>
                    </tr>
                    <tr>
                        <td>12.</td>
                        <td>Gina</td>
                        <td>Bekerja</td>
                    </tr>
                    <tr>
                        <td>13.</td>
                        <td>Hadi</td>
                        <td>Magang</td>
                    </tr>
                    <tr>
                        <td>14.</td>
                        <td>Intan</td>
                        <td>Kuliah</td>
                    </tr>
                    <tr>
                        <td>15.</td>
                        <td>Joko</td>
                        <td>Bekerja</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Jumlah Siswa :</strong></td>
                        <td><strong>75</strong></td>
                    </tr>
                </tfoot>
            </table>



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