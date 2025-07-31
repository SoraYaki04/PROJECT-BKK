<?php
require_once __DIR__ . '/../config/helpers.php';

$result = $koneksi->query("SELECT * FROM perusahaan");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="perusahaan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
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

    <section>
      <div class="header-bar">
        <a href="#">Perusahaan</a>
      </div>
      <div class="search-container">

        <div class="search">
          <label for="category">Pencarian:</label>
          <input type="input" name="search">
          <button class="search-button">Cari</button>

          <label for="category">Kategori:</label>
          <select id="category" class="search-select">
            <option value="UMKN">UMKM</option>
            <option value="MOU">MOU</option>
            <option value="START-UP">START UP</option>
            <option value="PERSEROAN-TERBATAS">PERSEROAN TERBATAS</option>
          </select>

          <button class="search-button">Cari</button>
        </div>

      </div>
      <div class="company-container">

        <div class="company-list">

          <?php 
      $no = 1;
      while($row = $result->fetch_assoc()):
        $imgData = base64_encode($row['gambar']);
        $popup_id = "popup-" . $no;
      ?>

          <div class="company-item company-item-<?= $no ?>" data-index="<?= $no ?>">
            <img src="data:image/png;base64,<?= $imgData ?>" alt="<?= htmlspecialchars($row['nama']) ?>" />

            <div class="company-detail company-detail-<?= $no ?>" data-index="<?= $no ?>">
              <h2><?= htmlspecialchars($row['nama']) ?></h2>
              <button onclick="togglePopup('<?= $popup_id ?>')" class="detail-btn">
                <i class="fa-solid fa-list"></i> Detail Penelusuran
              </button>
            </div>
          </div>


          <!-- POPUP -->
          <div class="popup" id="<?php echo $popup_id; ?>">
            <div class="company-popup"> 
              <div class="close-popup">
                <button class="close-btn" onclick="togglePopup('<?php echo $popup_id; ?>')">&times;</button>
              </div>
              <div class="company-header-popup">
                <div class="company-title-popup">
                  <h1><?php echo htmlspecialchars($row['nama']); ?></h1>
                </div>
                <div class="company-desc-popup">
                  <p><?php echo htmlspecialchars($row['deskripsi_perusahaan']); ?></p>
                </div>
              </div>

              <hr>

              <div class="company-detail-popup">
                <table>
                  <tr>
                    <td class="company-detail-left">Nama Perusahaan</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['nama']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Alamat</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['alamat']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kota</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['kota']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kontak</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['kontak']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Email</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['email']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Kategori</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['kategori']); ?></td>
                  </tr>
                  <tr>
                    <td class="company-detail-left">Standar</td>
                    <td class="company-detail-rigth">: <?php echo htmlspecialchars($row['standar']); ?></td>
                  </tr>
                </table>
              </div>

              <div class="company-table-popup">
                <table>
                  <tr>
                    <th class="table-number">No</th>
                    <th width="970px">Kerjasama</th>
                  </tr>

                  <?php
            $kerjaList = preg_split("/[\r\n]+/", $row['kerja_sama']); 
            $kerjaNo = 1;
            foreach ($kerjaList as $item) {
                $item = trim($item);
                if (!empty($item)) {
                    echo "<tr>
                            <td class='table-number'>{$kerjaNo}</td>
                            <td>{$item}</td>
                          </tr>";
                    $kerjaNo++;
                }
            }
            ?>
                </table>
              </div>
            </div>
          </div>

          <?php 
    $no++;
    endwhile; 
?>

        </div>

        <div class="company-controls">

        </div>

      </div>
    </section>

  </div>

  <script src="perusahaan.js"></script>

</body>

</html>
