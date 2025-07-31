<?php
require_once __DIR__ . '/../config/helpers.php';

// ! Check login 
if (!is_logged_in()) {
    redirect('../Login/LoginSiswa/siswa-alumni-login.php');
}

// TODO AMBIL DATA ALUMNI
$id = intval($_SESSION['user_id']); 
$stmt = $koneksi->prepare("SELECT * FROM alumni WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$edit_mode = isset($_GET['edit']) && $_GET['edit'] == 'true';

// ! UPLOAD IMAGE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_profile_image'])) {
    validate_csrf();
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = dirname(__DIR__) . '/uploads/profiles/';
        
        // ! BUAT DIRECTORY UPLOAD JIKA TIDAK ADA
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                $_SESSION['error'] = "Gagal membuat direktori upload";
                redirect('profil.php');
            }
        }

        // ! HAPUS GAMBAR LAMA
        if (!empty($data['gambar'])) {
            $oldFilePath = $targetDir . $data['gambar'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
        $fileExt = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $fileName = 'profile_' . $id . '_' . time() . '.' . $fileExt;
        $targetFile = $targetDir . $fileName;
        
        // ! VALIDASI GAMBAR
        $check = getimagesize($_FILES['profile_image']['tmp_name']);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
        if ($check !== false && 
            in_array(strtolower($fileExt), $allowedTypes) && 
            $_FILES['profile_image']['size'] <= 2 * 1024 * 1024) {
            
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
                $update = $koneksi->prepare("UPDATE alumni SET gambar = ? WHERE id = ?");
                $update->bind_param("si", $fileName, $id);
                if ($update->execute()) {
                    $_SESSION['success'] = "Foto profil berhasil diupdate";
                    $data['gambar'] = $fileName;
                } else {
                    $_SESSION['error'] = "Gagal menyimpan ke database";
                    unlink($targetFile);
                }
                $update->close();
            } else {
                $_SESSION['error'] = "Gagal mengupload gambar";
            }
        } else {
            $_SESSION['error'] = "Gambar tidak valid (max 2MB, format: JPG, PNG, GIF)";
        }
    } else {
        $_SESSION['error'] = "Silakan pilih gambar terlebih dahulu";
    }
    redirect('profil.php');
}

// TODO PROFILE EDIT
if ($edit_mode && $_SERVER['REQUEST_METHOD'] === 'POST') {
    validate_csrf();
    
    // ! Sanitize inputs
    $nama = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $tempat_lahir = htmlspecialchars(trim($_POST['tempat_lahir'] ?? ''));
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $rt = intval($_POST['rt'] ?? 0);
    $rw = intval($_POST['rw'] ?? 0);
    $dusun = htmlspecialchars(trim($_POST['dusun'] ?? ''));
    $kelurahan = htmlspecialchars(trim($_POST['kelurahan'] ?? ''));
    $kecamatan = htmlspecialchars(trim($_POST['kecamatan'] ?? ''));
    $kode_pos = htmlspecialchars(trim($_POST['kode_pos'] ?? ''));
    $no_wa = htmlspecialchars(trim($_POST['no_wa'] ?? ''));

    // ! Validate WhatsApp number
    if (!preg_match('/^[0-9]{10,15}$/', $no_wa)) {
        $_SESSION['error'] = "Nomor WhatsApp tidak valid";
        redirect('profil.php?edit=true');
    }

    // TODO Update profile
    $stmt = $koneksi->prepare("UPDATE alumni SET 
        nama = ?,
        tempat_lahir = ?,
        tanggal_lahir = ?,
        rt = ?,
        rw = ?,
        dusun = ?,
        kelurahan = ?,
        kecamatan = ?,
        kode_pos = ?,
        no_wa = ?
        WHERE id = ?");
    
    if ($stmt->bind_param("sssiisssssi", 
        $nama,
        $tempat_lahir,
        $tanggal_lahir,
        $rt,
        $rw,
        $dusun,
        $kelurahan,
        $kecamatan,
        $kode_pos,
        $no_wa,
        $id
    ) && $stmt->execute()) {
        $_SESSION['success'] = "Profil berhasil diperbarui";
        redirect('profil.php');
    } else {
        $_SESSION['error'] = "Gagal memperbarui profil";
        redirect('profil.php?edit=true');
    }
}

$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Franklin+Demi+Cond&display=swap" rel="stylesheet">
  <link href="../navbar/navbar.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="profil.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

  <header>
    <div class="rectangle">
    </div>

    <div class="logo">
      <div class="logo-header">
        <img src="../logo.png" alt="BKK SMKN 1 Boyolangu Logo">
      </div>
      <div class="header-text">
        <img src="../tulisan logo.png" alt="Bursa Kerja Khusus SMKN 1 Boyolangu" id="text-img">
      </div>
    </div>

    <div class="contact-info">
      <div class="contact-phone">
        <i class="fas fa-phone-alt"></i>
        <div class="contact-ket">
          <p>Call Us</p>
          <p>+6281-xxx-xxx-xxx</p>
        </div>
      </div>
      <div class="contact-email">
        <i class="fas fa-envelope"></i>
        <div class="contact-ket">
          <p>Email Us</p>
          <p>bkk@smkn1boyolangu@gmail.com</p>
        </div>

      </div>
      <div class="contact-map">
        <i class="fas fa-map-marker-alt"></i>
        <div class="contact-ket">
          <p>Located Us</p>
          <p>Jl. Ki Mangun Sarkoro No.VI/3, Beji, Boyolangu</p>
        </div>

      </div>
    </div>
  </header>

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
      <a href="#">Profil</a>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
    <div class="notification success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="notification error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>



    <div class="profile-content">
      <div class="profile-title">
        <div class="profile-image">
          <?php if (!empty($data['gambar'])): ?>
          <img class="profile-data" src="../uploads/profiles/<?= htmlspecialchars($data['gambar']) ?>"
            alt="Foto Profil">
          <?php else: ?>
          <img class="profile-data" src="smile.png" alt="Foto Profil Default">
          <?php endif; ?>

          <div class="profile-image-camera">
            <form id="imageUploadForm" method="POST" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="upload_profile_image" value="1">
              <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
              <label for="profileImageInput" style="cursor: pointer;">
                <img src="camera.png" alt="Ubah Foto">
              </label>
            </form>
          </div>
        </div>

        <div class="profile-name">
          <h2><?php echo $data['nama']; ?></h2>
          <p class="profile-title-nisn"><?php echo $data['nisn']; ?></p>
          <p class="profile-title-status">Siswa / Alumni Tahun 2022/2023</p>
        </div>
      </div>

      <?php if ($edit_mode): ?>
      <div class="profile-description">
        <div class="profile-details">
          <h2>Edit Profil</h2>
          <form method="POST" action="profil.php?edit=true">
            <?= csrf_field() ?>
            <div class="form-group">
              <p class="profile-details-1">Nama Lengkap</p>
              <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required>
            </div>

            <div class="form-row">
              <div class="form-group">
                <p class="profile-details-1">Tempat Lahir</p>
                <input type="text" id="tempat_lahir" name="tempat_lahir"
                  value="<?= htmlspecialchars($data['tempat_lahir'] ?? '') ?>" required>
              </div>
              <div class="form-group">
                <p class="profile-details-1">Tanggal Lahir</p>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                  value="<?= htmlspecialchars($data['tanggal_lahir'] ?? '') ?>" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <p class="profile-details-1">RT</p>
                <input type="number" id="rt" name="rt" value="<?= htmlspecialchars($data['rt'] ?? '') ?>">
              </div>
              <div class="form-group">
                <p class="profile-details-1">RW</p>
                <input type="number" id="rw" name="rw" value="<?= htmlspecialchars($data['rw'] ?? '') ?>">
              </div>
            </div>

            <div class="form-group">
              <p class="profile-details-1">Dusun</p>
              <input type="text" id="dusun" name="dusun" value="<?= htmlspecialchars($data['dusun'] ?? '') ?>">
            </div>

            <div class="form-group">
              <p class="profile-details-1">Kelurahan</p>
              <input type="text" id="kelurahan" name="kelurahan"
                value="<?= htmlspecialchars($data['kelurahan'] ?? '') ?>">
            </div>

            <div class="form-group">
              <p class="profile-details-1">Kecamatan</p>
              <input type="text" id="kecamatan" name="kecamatan"
                value="<?= htmlspecialchars($data['kecamatan'] ?? '') ?>">
            </div>

            <div class="form-group">
              <p class="profile-details-1">Kode Pos</p>
              <input type="text" id="kode_pos" name="kode_pos" value="<?= htmlspecialchars($data['kode_pos'] ?? '') ?>">
            </div>

            <div class="form-group">
              <p class="profile-details-1">No. WhatsApp</p>
              <input type="text" id="no_wa" name="no_wa" value="<?= htmlspecialchars($data['no_wa'] ?? '') ?>" required>
              <small>Format: 081234567890 (10-15 digit angka)</small>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn-save">Simpan Perubahan</button>
              <a href="profil.php" class="btn-cancel">Batal</a>
            </div>
          </form>
        </div>
      </div>

      <?php else: ?>

      <div class="profile-description">
        <div class="profile-details">
          <a class="edit-profil" href="profil.php?edit=true" title="Edit Profil">
            <i class="fa-solid fa-pen-to-square fa-xl"></i>
          </a>

          <P class="profile-details-1">Nama Lengkap</P>
          <p><?php echo $data['nama']; ?></p>

          <P class="profile-details-1">NISN</P>
          <p><?php echo $data['nisn']; ?></p>

          <p class="profile-details-1">Tempat Tanggal Lahir</p>
          <p><?php echo $data['tempat_lahir'] . ", " . $data['tanggal_lahir']; ?></p>

          <p class="profile-details-1">Alamat</p>
          <p>
            <?php echo "RT " . $data['rt'] . ", RW " . $data['rw'] . ", " . $data['dusun'] . ", " . $data['kelurahan'] . ", " . $data['kecamatan']; ?>
          </p>

          <p class="profile-details-1">Kode Pos</p>
          <p><?php echo $data['kode_pos'] ?></p>

          <p class="profile-details-1">Jenis Kelamin</p>
          <p><?php echo ($data['jenis_kelamin'] ?? '') === 'L' ? 'Laki-Laki' : 'Perempuan' ?></p>

          <p class="profile-details-1">Agama</p>
          <p><?php echo $data['agama'] ?></p>

          <p class="profile-details-1">No Tlp / Hp</p>
          <p><?php echo $data['no_wa'] ?></p>

          <p class="profile-details-1">NIK</p>
          <p><?php echo $data['nik'] ?></p>
        </div>

        <div class="profile-notification">
          <div class="profile-notification-title">
            <i class="fa-regular fa-bell"></i>
            <p>Semua Notifikasi</p>
          </div>

          <hr>

          <div class="profile-notification-notif">
            <div class="profile-notification-notif-left">
              <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
            </div>
            <div class="profile-notification-notif-right">
              <p>01 Agt 24</p>
            </div>
          </div>

          <div class="profile-notification-notif">
            <div class="profile-notification-notif-left">
              <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
            </div>
            <div class="profile-notification-notif-right">
              <p>01 Agt 24</p>
            </div>
          </div>

          <div class="profile-notification-notif">
            <div class="profile-notification-notif-left">
              <p>Anda Belum Mengisi Survey Bulan Juli 2024</p>
            </div>
            <div class="profile-notification-notif-right">
              <p>01 Agt 24</p>
            </div>
          </div>

        </div>
      </div>
<a href="../Login/logout.php">Logout</a>

      <?php endif; ?>
    </div>


  </div>

  <script>

    document.getElementById('profileImageInput').addEventListener('change', function (e) {
      // ! Validasi file
      const file = e.target.files[0];
      if (!file) return;

      // ! Validasi ukuran dan tipe file
      if (file.size > 2 * 1024 * 1024) {
        alert('File terlalu besar (maksimal 2MB)');
        return;
      }

      if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
        alert('Format file tidak didukung (hanya JPG, PNG, GIF)');
        return;
      }

      // TODO Submit form
      document.getElementById('imageUploadForm').submit();
    });
  </script>

</body>

</html>
