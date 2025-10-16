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
    $autoloadPath = __DIR__ . '/../../vendor/autoload.php';
    if (file_exists($autoloadPath)) {
        require $autoloadPath;
    }

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
        // TODO Ambil data alumni (pelamar) dari database
        $stmt_user = $koneksi->prepare("SELECT * FROM alumni WHERE id = ?");
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $alumni = $stmt_user->get_result()->fetch_assoc();

        if (!$alumni) {
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
                    // Wajib PDF untuk berkas gabungan
                    if ($fieldname === 'berkas_lamaran' && $file_ext !== 'pdf') {
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

            // TODO Simpan berkas lamaran gabungan (PDF berisi pass foto, KTP/KK, ijazah, CV, SKCK, surat lamaran)
            $data_lamaran = [
                'pass_foto'     => null,
                'ijazah'        => null,
                'portofolio'    => simpanFile('portofolio'), // opsional tetap terpisah
                'sertifikat'    => simpanFile('sertifikat'), // opsional tetap terpisah
                'ktp_kk'        => null,
                'cv'            => null,
                'skck'          => null,
                'surat_lamaran' => simpanFile('berkas_lamaran'),
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
                // TODO Kirim email ke perusahaan menggunakan data yang sudah diambil (jika PHPMailer tersedia)
                if (class_exists(\PHPMailer\PHPMailer\PHPMailer::class)) {
                    if (empty($lowker['email']) || !filter_var($lowker['email'], FILTER_VALIDATE_EMAIL)) {
                        $success_message = null;
                        $error_message = "Lamaran berhasil disimpan tetapi email perusahaan tidak valid atau kosong.";
                    } else {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "mikoyae08@gmail.com";
                        $mail->Password = "fhyqmjaeqvyceoja"; // Ganti dengan App Password Gmail
                        $mail->SMTPSecure = "tls";
                        $mail->Port = 587;
                        $mail->CharSet = 'UTF-8';
                        $mail->isHTML(false);

                        $mail->setFrom("mikoyae08@gmail.com", "BKK SMKN 1 Boyolangu");
                        if (!empty($alumni['email'])) {
                            $mail->addReplyTo($alumni['email'], $alumni['nama'] ?? 'Pelamar');
                        }
                        $mail->addAddress($lowker['email'], $lowker['nama']);
                        $mail->Subject = "Lamaran Baru untuk Lowongan: " . $lowker['judul_lowker'];
                        
                        $mail->Body = "Terdapat lamaran baru untuk lowongan " . $lowker['judul_lowker'] . 
                                     "\n\nPelamar: " . ($alumni['nama'] ?? '-') . 
                                     "\nEmail: " . ($alumni['email'] ?? '-') .
                                     "\n\nSilakan login ke dashboard BKK untuk melihat detail lamaran dan dokumen pelamar.";
                        $mail->AltBody = "Lamaran baru untuk: " . $lowker['judul_lowker'] .
                                         " | Pelamar: " . ($alumni['nama'] ?? '-') .
                                         " | Email: " . ($alumni['email'] ?? '-') .
                                         " | Cek dashboard BKK untuk detail.";

                        // Lampirkan hanya berkas lamaran gabungan (PDF)
                        $baseUploadPath = __DIR__ . '/../uploads/lamaran/';
                        if (!empty($data_lamaran['surat_lamaran'])) {
                            $path = $baseUploadPath . $data_lamaran['surat_lamaran'];
                            if (is_file($path)) {
                                $mail->addAttachment($path, 'berkas_lamaran.pdf');
                            }
                        }

                        $mail->send();
                        $success_message = "Lamaran berhasil dikirim! Perusahaan akan menghubungi Anda jika memenuhi kualifikasi.";
                        

                    } catch (Exception $e) {
                        error_log("Gagal mengirim email: " . $mail->ErrorInfo);
                        $error_message = "Lamaran berhasil disimpan tetapi gagal mengirim notifikasi email: " . $mail->ErrorInfo;
                    }
                    }
                } else {
                    $success_message = "Lamaran berhasil disimpan. (Notifikasi email nonaktif: autoloader tidak ditemukan)";
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
  <link rel="stylesheet" href="../partials/navbar/navbar.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="persyaratan.css?v=<?php echo time(); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <div class="header-bar">
      <a href="#">Lowongan Kerja</a>
    </div>

    <?php if (isset($success_message) || isset($error_message)): ?>
    <div class="modal-overlay" id="resultModal">
      <div class="modal-content">
        <button type="button" class="modal-close" aria-label="Close">×</button>
        <div class="modal-icon">
          <?php if (isset($success_message)): ?>
            <i class="fas fa-check-circle"></i>
          <?php else: ?>
            <i class="fas fa-times-circle"></i>
          <?php endif; ?>
        </div>
        <div class="modal-text">
          <h2><?php echo isset($success_message) ? $success_message : $error_message; ?></h2>
        </div>
      </div>
    </div>
    <script>
      (function(){
        const overlay = document.getElementById('resultModal');
        const content = overlay.querySelector('.modal-content');
        const closeBtn = overlay.querySelector('.modal-close');
        function goBack(){ window.location.href = 'loker.php'; }
        closeBtn.addEventListener('click', goBack);
        overlay.addEventListener('click', function(e){ if(!content.contains(e.target)) goBack(); });
      })();
    </script>
    <?php else: ?>
    <div class="requirement-section">
      <h2 class="section-title">TAMBAHKAN PERSYARATAN</h2>

      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_lowker" value="<?php echo $id_lowker; ?>">

        <div class="requirement-grid">
          <!-- BERKAS LAMARAN GABUNGAN (PDF berisi pass foto, KTP/KK, ijazah, CV, SKCK, surat lamaran) -->
          <div class="requirement-box berkas-lamaran">
            <div class="icon-text">
              <i class="fas fa-file-pdf fa-lg"></i>
              <div class="label-text">
                <p class="label-title">BERKAS LAMARAN (PDF GABUNGAN)</p>
                <span class="optional">Wajib PDF berisi: Pass Foto, KTP/KK, Ijazah, CV, SKCK, Surat Lamaran</span>
              </div>
            </div>
            <div class="actions">
              <label for="berkas_lamaran" class="upload-btn">Upload
                <input type="file" id="berkas_lamaran" name="berkas_lamaran" accept=".pdf" style="display: none;">
              </label>
              <button type="button" class="view-btn" data-target="berkas_lamaran">View</button>
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

      // === Drag & Drop Support untuk semua requirement-box ===
      function acceptsPdfOnly(inputEl) {
        const accept = (inputEl.getAttribute('accept') || '').toLowerCase();
        return accept.includes('.pdf');
      }

      function validateFileForInput(inputEl, file) {
        if (!file) return false;
        const name = (file.name || '').toLowerCase();
        const type = (file.type || '').toLowerCase();
        const accept = (inputEl.getAttribute('accept') || '').toLowerCase();
        if (!accept) return true;
        // Simple validation by extension if MIME missing
        const allowedExts = accept.split(',').map(s => s.trim().replace('.', ''));
        const fileExt = name.split('.').pop();
        const mimeOk = type ? allowedExts.some(ext => (ext === 'pdf' && type === 'application/pdf') || type.includes(ext)) : false;
        const extOk = allowedExts.includes(fileExt);
        return mimeOk || extOk;
      }

      document.querySelectorAll('.requirement-box').forEach(box => {
        const input = box.querySelector('input[type="file"]');
        if (!input) return;

        ['dragenter', 'dragover'].forEach(evtName => {
          box.addEventListener(evtName, e => {
            e.preventDefault();
            e.stopPropagation();
            box.classList.add('drag-over');
          });
        });

        ['dragleave', 'dragend', 'mouseout'].forEach(evtName => {
          box.addEventListener(evtName, e => {
            box.classList.remove('drag-over');
          });
        });

        box.addEventListener('drop', e => {
          e.preventDefault();
          e.stopPropagation();
          box.classList.remove('drag-over');

          const files = e.dataTransfer && e.dataTransfer.files ? e.dataTransfer.files : [];
          if (!files.length) return;
          const file = files[0];

          if (!validateFileForInput(input, file)) {
            alert('File tidak sesuai. Harap unggah tipe yang diizinkan: ' + (input.getAttribute('accept') || ''));
            return;
          }

          // Assign file via DataTransfer (supported browsers)
          try {
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            input.dispatchEvent(new Event('change', { bubbles: true }));
          } catch (err) {
            console.warn('Drag&drop assignment failed:', err);
            alert('Browser Anda tidak mendukung drag & drop langsung. Silakan klik Upload.');
          }
        });
      });
    });
  </script>
</body>

</html>
