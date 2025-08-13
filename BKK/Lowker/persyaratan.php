<?php
require_once __DIR__ . '/../config/helpers.php';
validate_csrf();

allow_role(['admin', 'alumni']);

$id_lowker = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id_lowker === 0) {
  redirect('detail-lowker.php?id=' . $id_lowker);
  exit;
}

// TODO Fungsi upload ke temp
function uploadFileTemp($file, $allowedTypes, $maxSize = 2097152) // ! 2mb
{
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];

  if ($fileError !== UPLOAD_ERR_OK) {
    return ['error' => 'Terjadi kesalahan saat upload file.'];
  }

  if ($fileSize > $maxSize) {
    return ['error' => 'Ukuran file terlalu besar. Maksimal ' . ($maxSize / 1024 / 1024) . 'MB'];
  }

  $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  if (!in_array($fileExt, $allowedTypes)) {
    return ['error' => 'Tipe file tidak didukung. Hanya menerima: ' . implode(', ', $allowedTypes)];
  }

  if (!is_dir(__DIR__ . '/../uploads/lamaran/temp')) {
    mkdir(__DIR__ . '/../uploads/lamaran/temp', 0777, true);
  }

  $tmpFileName = uniqid('temp_', true) . '.' . $fileExt;
  $tmpPath = __DIR__ . '/../uploads/lamaran/temp/' . $tmpFileName;

  if (!move_uploaded_file($fileTmpName, $tmpPath)) {
    return ['error' => 'Gagal menyimpan file sementara.'];
  }

  return ['success' => $tmpPath, 'ext' => $fileExt];
}

// TODO Fungsi memindahkan dari folder temp ke folder final
function moveFileToFolder($tmpFilePath, $field, $folderPath, $nama_lowker, $nama_alumni, $ext)
{
  $fileName = $field . '_' . $nama_lowker . '_' . $nama_alumni . '.' . $ext;
  $targetPath = $folderPath . '/' . $fileName;

  if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
  }

  if (rename($tmpFilePath, $targetPath)) {

    // ! Return path relatif untuk simpan di DB, misal tanpa base dir
    return 'uploads/lamaran/' . basename($folderPath) . '/' . $fileName;
  } else {
    return false;
  }
}


// TODO submit lamaran
if (isset($_POST['submit_lamaran'])) {


  if (!isset($_POST['id_lowker']) || empty($_POST['id_lowker'])) {
    $_SESSION['error'] = 'ID Lowongan tidak valid.';
    redirect('detail-lowker.php?id=' . $id_lowker);
    exit;
  }

  $id_lowker = (int) $_POST['id_lowker'];
  $id_alumni = $_SESSION['user_id'];

  // ! Validasi apakah id_lowker valid
  $query = "SELECT judul_lowker FROM lowker WHERE id_lowker = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("i", $id_lowker);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    $_SESSION['error'] = "ID lowongan kerja tidak valid.";
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }
  $row = $result->fetch_assoc();
  $nama_lowker = preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', strtolower($row['judul_lowker'])));
  $stmt->close();


  // ! Ambil nama alumni user
  $query = "SELECT nama FROM alumni WHERE id = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("i", $id_alumni);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    $_SESSION['error'] = "User alumni tidak ditemukan.";
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }
  $row = $result->fetch_assoc();
  $nama_alumni = preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', strtolower($row['nama'])));
  $stmt->close();


  // ! Array file dan allowed type
  $fileFields = [
    'pass_foto' => ['pdf', 'jpg', 'jpeg', 'png'],
    'ktp_kk' => ['pdf', 'jpg', 'jpeg', 'png'],
    'ijazah' => ['pdf'],
    'cv' => ['pdf'],
    'portofolio' => ['pdf'],  // * opsional
    'skck' => ['pdf'],
    'sertifikat' => ['pdf'],  // * opsional
    'surat_lamaran' => ['pdf'],
  ];

  $error = false;
  $tempFiles = [];


  // TODO Upload file sementara dulu (ke folder temp)
  foreach ($fileFields as $field => $allowedTypes) {

    // ! cek wajib atau opsional
    $isOptional = in_array($field, ['portofolio', 'sertifikat']);
    if (!$isOptional) {
      if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error'] = "File $field harus diupload.";
        $error = true;
        break;
      }
    }

    if (isset($_FILES[$field]) && $_FILES[$field]['error'] !== UPLOAD_ERR_NO_FILE) {
      $uploadResult = uploadFileTemp($_FILES[$field], $allowedTypes);
      if (isset($uploadResult['error'])) {
        $_SESSION['error'] = $uploadResult['error'] . " ($field)";
        $error = true;
        break;
      } else {
        $tempFiles[$field] = $uploadResult; // * simpan path tmp & ext
      }
    }
  }


  if ($error) {

    // TODO Hapus file-file yang sudah ter-upload sementara
    foreach ($tempFiles as $fileData) {
      if (isset($fileData['success']) && file_exists($fileData['success'])) {
        unlink($fileData['success']);
      }
    }
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }

  // TODO Simpan data lamaran dulu (tanpa nama file, isi dengan placeholder dulu)
  $sql = "INSERT INTO lamaran (
        id_lowker, id_alumni, pass_foto, ktp_kk, ijazah, cv, portofolio, skck, sertifikat, surat_lamaran, tanggal_lamaran
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";


  // ! Semua field file isi dengan string kosong dulu
  $emptyString = '';
  $stmt = $koneksi->prepare($sql);
  if (!$stmt) {
    $_SESSION['error'] = "Prepare statement gagal: " . $koneksi->error;

    // TODO Hapus file sementara 
    foreach ($tempFiles as $fileData) {
      if (isset($fileData['success']) && file_exists($fileData['success'])) {
        unlink($fileData['success']);
      }
    }
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }
  $stmt->bind_param(
    "iissssssss",
    $id_lowker,
    $id_alumni,
    $emptyString,
    $emptyString,
    $emptyString,
    $emptyString,
    $emptyString,
    $emptyString,
    $emptyString,
    $emptyString
  );

  if (!$stmt->execute()) {
    $_SESSION['error'] = "Gagal menyimpan data lamaran: " . $stmt->error;

    // TODO Hapus file sementara
    foreach ($tempFiles as $fileData) {
      if (isset($fileData['success']) && file_exists($fileData['success'])) {
        unlink($fileData['success']);
      }
    }

    $stmt->close();
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }

  $id_lamaran = $koneksi->insert_id;
  $stmt->close();


  // TODO Buat folder final untuk menyimpan lamaran
  $folderName = $id_lamaran . '_' . $nama_lowker . '_' . $nama_alumni;
  $folderPath = __DIR__ . '/../uploads/lamaran/' . $folderName;
  if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true);
  }


  // TODO Pindahkan file dari temp ke folder final dengan nama sesuai format
  $finalFilePaths = [];
  foreach ($tempFiles as $field => $fileData) {
    $finalPath = moveFileToFolder($fileData['success'], $field, $folderPath, $nama_lowker, $nama_alumni, $fileData['ext']);
    if ($finalPath === false) {
      $_SESSION['error'] = "Gagal memindahkan file $field ke folder tujuan.";
      $error = true;
      break;
    } else {
      $finalFilePaths[$field] = $finalPath;
    }
  }

  // ! Jika ada error saat pindah file, hapus semua file di folder dan data lamaran
  if ($error) {

    // ! Hapus file di folder
    foreach ($finalFilePaths as $fp) {
      $fullPath = __DIR__ . '/../' . $fp;
      if (file_exists($fullPath)) unlink($fullPath);
    }

    // ! Hapus file sementara jika ada
    foreach ($tempFiles as $fileData) {
      if (isset($fileData['success']) && file_exists($fileData['success'])) {
        unlink($fileData['success']);
      }
    }

    // ! Hapus folder jika kosong
    if (is_dir($folderPath)) {
      rmdir($folderPath);
    }

    // ! Hapus data lamaran
    $stmtDel = $koneksi->prepare("DELETE FROM lamaran WHERE id_lamaran = ?");
    $stmtDel->bind_param("i", $id_lamaran);
    $stmtDel->execute();
    $stmtDel->close();

    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }


  // TODO Update record lamaran dengan nama file final
  $sqlUpdate = "UPDATE lamaran SET
        pass_foto = ?, ktp_kk = ?, ijazah = ?, cv = ?, portofolio = ?, skck = ?, sertifikat = ?, surat_lamaran = ?
        WHERE id_lamaran = ?";

  $stmtUpdate = $koneksi->prepare($sqlUpdate);
  if (!$stmtUpdate) {
    $_SESSION['error'] = "Prepare update gagal: " . $koneksi->error;
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }

  $pass_foto     = $finalFilePaths['pass_foto'] ?? '';
  $ktp_kk        = $finalFilePaths['ktp_kk'] ?? '';
  $ijazah        = $finalFilePaths['ijazah'] ?? '';
  $cv            = $finalFilePaths['cv'] ?? '';
  $portofolio    = $finalFilePaths['portofolio'] ?? '';
  $skck          = $finalFilePaths['skck'] ?? '';
  $sertifikat    = $finalFilePaths['sertifikat'] ?? '';
  $surat_lamaran = $finalFilePaths['surat_lamaran'] ?? '';
  $id_lamaran    = (int) $id_lamaran; 

  $stmtUpdate->bind_param(
    "ssssssssi",
    $pass_foto,
    $ktp_kk,
    $ijazah,
    $cv,
    $portofolio,
    $skck,
    $sertifikat,
    $surat_lamaran,
    $id_lamaran
  );

  if (!$stmtUpdate->execute()) {
    $_SESSION['error'] = "Gagal update data file: " . $stmtUpdate->error;
    redirect('persyaratan.php?id=' . $id_lowker);
    exit;
  }
  $stmtUpdate->close();

  $_SESSION['success'] = "Lamaran berhasil dikirim!";

  redirect('detail-lowker.php?id=' . $id_lowker);
  exit;
}

?>    

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="persyaratan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

  <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
    <div class="floating-notif <?= isset($_SESSION['success']) ? 'success' : 'error' ?>">
      <?= htmlspecialchars($_SESSION['success'] ?? $_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['success'], $_SESSION['error']); ?>
  <?php endif; ?>


  <?php include '../navbar/header.php' ?>

  <div class="container">
    <!-- NAVBAR -->
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
      <a href="#">Lowongan Kerja</a>
    </div>

    <div class="requirement-section">
      <h2 class="section-title">TAMBAHKAN PERSYARATAN</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id_lowker" value="<?= htmlspecialchars($id_lowker) ?>">

        <div class="requirement-grid">
          <!-- (sama persis seperti form yang kamu punya) -->
          <!-- PASS FOTO -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-file fa-lg"></i>
              <div class="label-text">
                <p class="label-title">PASS FOTO TERBARU</p>
                <span class="optional">Tipe file yang diterima adalah PDF, JPEG, PNG</span>
              </div>
            </div>
            <div class="actions">
              <label for="pass_foto" class="upload-btn">Upload
                <input type="file" id="pass_foto" name="pass_foto" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="pass_foto">View</button>
            </div>
          </div>

          <!-- KTP & KK -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-id-card fa-lg"></i>
              <div class="label-text">
                <p class="label-title">FOTO KTP & KK</p>
                <span class="optional">Tipe file yang diterima adalah PDF, JPEG, PNG</span>
              </div>
            </div>
            <div class="actions">
              <label for="ktp_kk" class="upload-btn">Upload
                <input type="file" id="ktp_kk" name="ktp_kk" accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="ktp_kk">View</button>
            </div>
          </div>

          <!-- IJAZAH -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-file-alt fa-lg"></i>
              <div class="label-text">
                <p class="label-title">IJAZAH & TRANSKRIP NILAI</p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="ijazah" class="upload-btn">Upload
                <input type="file" id="ijazah" name="ijazah" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="ijazah">View</button>
            </div>
          </div>

          <!-- CV -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-user fa-lg"></i>
              <div class="label-text">
                <p class="label-title">CV</p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="cv" class="upload-btn">Upload
                <input type="file" id="cv" name="cv" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="cv">View</button>
            </div>
          </div>

          <!-- PORTOFOLIO -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-folder-open fa-lg"></i>
              <div class="label-text">
                <p class="label-title">PORTOFOLIO <span class="optional">(opsional)</span></p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="portofolio" class="upload-btn">Upload
                <input type="file" id="portofolio" name="portofolio" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="portofolio">View</button>
            </div>
          </div>

          <!-- SKCK -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-file fa-lg"></i>
              <div class="label-text">
                <p class="label-title">SKCK</p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="skck" class="upload-btn">Upload
                <input type="file" id="skck" name="skck" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="skck">View</button>
            </div>
          </div>

          <!-- SERTIFIKAT -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-file fa-lg"></i>
              <div class="label-text">
                <p class="label-title">SERTIFIKAT <span class="optional">(opsional)</span></p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="sertifikat" class="upload-btn">Upload
                <input type="file" id="sertifikat" name="sertifikat" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="sertifikat">View</button>
            </div>
          </div>

          <!-- SURAT LAMARAN -->
          <div class="requirement-box">
            <div class="icon-text">
              <i class="fas fa-envelope-open-text fa-lg"></i>
              <div class="label-text">
                <p class="label-title">SURAT LAMARAN KERJA</p>
                <span class="optional">Tipe file yang diterima adalah PDF</span>
              </div>
            </div>
            <div class="actions">
              <label for="surat_lamaran" class="upload-btn">Upload
                <input type="file" id="surat_lamaran" name="surat_lamaran" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="surat_lamaran">View</button>
            </div>
          </div>

        </div> <!-- .requirement-grid -->

        <div class="submit-button">
          <button type="submit" name="submit_lamaran">SUBMIT</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const targetId = this.getAttribute('data-target');
          const fileInput = document.getElementById(targetId);
          if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            const fileURL = URL.createObjectURL(file);
            window.open(fileURL, '_blank');
            setTimeout(() => URL.revokeObjectURL(fileURL), 100);
          } else {
            alert('Silakan upload file terlebih dahulu.');
          }
        });
      });


      document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
          if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const box = this.closest('.requirement-box');
            const optionalText = box.querySelector('.optional');
            if (!box.querySelector('.file-name')) {
              const fileNameElement = document.createElement('span');
              fileNameElement.className = 'file-name';
              fileNameElement.style.display = 'block';
              fileNameElement.style.marginTop = '5px';
              fileNameElement.style.color = '#4CAF50';
              fileNameElement.textContent = fileName;
              optionalText.parentNode.appendChild(fileNameElement);
            } else {
              box.querySelector('.file-name').textContent = fileName;
            }
          }
        });
      });
    });
  </script>
</body>

</html>