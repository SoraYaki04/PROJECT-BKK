<?php

require_once __DIR__ . '/../config/helpers.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

allow_role(['admin', 'alumni']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID lowongan tidak valid.");
}

// ! Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_lamaran'])) {
    require_once __DIR__ . '/../config/helpers.php';
    require '../../vendor/autoload.php';

    // TODO Ambil data user yang login dari session
    if (!isset($_SESSION['user_id'])) {
        die("Anda harus login terlebih dahulu");
    }
    
    $user_id = $_SESSION['user_id'];
    $id_lowker = (int)$_POST['id_lowker'] ?? 0;
    $upload_dir = "../uploads/lamaran/";

    if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

    // ! Validasi ID lowongan dengan prepared statement
    $stmt = $koneksi->prepare("SELECT l.*, p.id_perusahaan, p.email, p.nama 
                              FROM lowker l 
                              JOIN perusahaan p ON l.id_perusahaan = p.id_perusahaan 
                              WHERE l.id_lowker = ?");
    $stmt->bind_param("i", $id_lowker);
    $stmt->execute();
    $lowker = $stmt->get_result()->fetch_assoc();
    
    if (!$lowker) {
        $error_message = "ID lowongan tidak valid atau tidak ditemukan.";
    } else {

        // TODO Ambil data user dari database
        $stmt_user = $koneksi->prepare("SELECT * FROM users WHERE id = ?");
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $user = $stmt_user->get_result()->fetch_assoc();

        if (!$user) {
            $error_message = "Data user tidak ditemukan.";
        } else {

            // TODO Fungsi untuk menyimpan file dengan validasi lebih ketat
            function simpanFile($fieldname) {
                global $upload_dir;
                if (isset($_FILES[$fieldname])) {
                    // ! Cek error
                    if ($_FILES[$fieldname]['error'] !== UPLOAD_ERR_OK) {
                        return null;
                    }
                    
                    // ! Validasi ukuran file (maks 5MB)
                    if ($_FILES[$fieldname]['size'] > 5 * 1024 * 1024) {
                        return null;
                    }
                    
                    // ! Validasi ekstensi file
                    $allowed_ext = ['pdf', 'jpg', 'jpeg', 'png'];
                    $file_ext = strtolower(pathinfo($_FILES[$fieldname]['name'], PATHINFO_EXTENSION));
                    
                    if (!in_array($file_ext, $allowed_ext)) {
                        return null;
                    }
                    
                    // ! Generate nama unik yang lebih aman
                    $newname = uniqid() . '_' . bin2hex(random_bytes(8)) . "." . $file_ext;
                    $target_path = $upload_dir . $newname;
                    
                    // ! Pindahkan file
                    if (move_uploaded_file($_FILES[$fieldname]['tmp_name'], $target_path)) {
                        return $newname;
                    } else {
                        error_log("Gagal menyimpan file: " . $_FILES[$fieldname]['name']);
                        return null;
                    }


                }
                return null;
            }

            // TODO Simpan semua file yang diupload
            $data_lamaran = [
                'pass_foto'     => simpanFile('pass_foto'),
                'ijazah'        => simpanFile('ijazah'),
                'portofolio'    => simpanFile('portofolio'),
                'sertifikat'    => simpanFile('sertifikat'),
                'ktp_kk'        => simpanFile('ktp_kk'),
                'cv'            => simpanFile('cv'),
                'skck'          => simpanFile('skck'),
                'surat_lamaran' => simpanFile('surat_lamaran'),
            ];

            // TODO Simpan ke database termasuk user_id
            $stmt = $koneksi->prepare("INSERT INTO lamaran (
                id_lowker, id_alumni, pass_foto, ijazah, portofolio, sertifikat, 
                ktp_kk, cv, skck, surat_lamaran, tanggal_lamaran
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            
            $stmt->bind_param("iissssssss", 
                $id_lowker,
                $user_id,
                $data_lamaran['pass_foto'],
                $data_lamaran['ijazah'],
                $data_lamaran['portofolio'],
                $data_lamaran['sertifikat'],
                $data_lamaran['ktp_kk'],
                $data_lamaran['cv'],
                $data_lamaran['skck'],
                $data_lamaran['surat_lamaran']
            );

            if ($stmt->execute()) {
                // TODO Kirim email ke perusahaan menggunakan data yang sudah diambil
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "emailmu@gmail.com";
                    $mail->Password = "apppassword";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;

                    $mail->setFrom("emailmu@gmail.com", "BKK SMKN 1 Boyolangu");
                    $mail->addAddress($lowker['email'], $lowker['nama']);
                    $mail->Subject = "Lamaran Baru untuk Lowongan: " . $lowker['judul_lowker'];
                    
                    $mail->Body = "Terdapat lamaran baru untuk lowongan " . $lowker['judul_lowker'] . 
                                 "\n\nPelamar: " . $user['nama'] . 
                                 "\nEmail: " . $user['email'] .
                                 "\n\nSilakan login ke dashboard BKK untuk melihat detail lamaran dan dokumen pelamar.";

                   echo "Email perusahaan: " . $lowker['email'];
exit;

                    $mail->send();
                    $success_message = "Lamaran berhasil dikirim! Perusahaan akan menghubungi Anda jika memenuhi kualifikasi.";
                    

                } catch (Exception $e) {
                    error_log("Gagal mengirim email: " . $e->getMessage());
                    $error_message = "Lamaran berhasil disimpan tetapi gagal mengirim notifikasi email.";
                }
            } else {
                $error_message = "Gagal menyimpan data lamaran. Silakan coba lagi.";
                error_log("Database error: " . $stmt->error);
            }
        }
    }
}


$id_lowker = (int)$_GET['id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bursa Kerja Khusus SMKN 1 Boyolangu</title>
  <link rel="stylesheet" href="../navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="persyaratan.css?v=<?php echo time(); ?>">
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
      <a href="#">Lowongan Kerja</a>
    </div>

    <?php if (isset($success_message)): ?>
    <div class="success-message">
      <i class="fas fa-check-circle fa-3x"></i>
      <h2><?php echo $success_message; ?></h2>
      <a href="loker.html" class="back-btn">Kembali ke Lowongan Kerja</a>
    </div>
    <?php elseif (isset($error_message)): ?>
    <div class="error-message">
      <i class="fas fa-times-circle fa-3x"></i>
      <h2><?php echo $error_message; ?></h2>
      <a href="javascript:history.back()" class="back-btn">Kembali</a>
    </div>
    <?php else: ?>
    <div class="requirement-section">
      <h2 class="section-title">TAMBAHKAN PERSYARATAN</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_lowker" value="<?php echo $id_lowker; ?>">

        <div class="requirement-grid">

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

          <!-- FOTO KTP & KK -->
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

          <!-- IJAZAH & TRANSKRIP NILAI -->
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
        </div>

        <div class="submit-button">
          <button type="submit" name="submit_lamaran">SUBMIT</button>
        </div>
      </form>
    </div>
    <?php endif; ?>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // ! Fungsi untuk view file
      document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          const targetId = this.getAttribute('data-target');
          const fileInput = document.getElementById(targetId);

          if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            const fileURL = URL.createObjectURL(file);

            // TODO Buka file di tab baru
            window.open(fileURL, '_blank');

            // TODO Hapus URL objek setelah digunakan
            setTimeout(() => URL.revokeObjectURL(fileURL), 100);
          } else {
            alert('Silakan upload file terlebih dahulu.');
          }
        });
      });

      // TODO Tampilkan nama file setelah upload
      document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
          if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const box = this.closest('.requirement-box');
            const optionalText = box.querySelector('.optional');

            // TODO Tambahkan nama file di bawah optional text
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