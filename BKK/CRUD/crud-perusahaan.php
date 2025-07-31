<?php
require_once __DIR__ . '/../config/helpers.php';

allow_role(['admin']);

validate_csrf();

// TODO Add Company
if (isset($_POST['add'])) {
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $kota = trim($_POST['kota'] ?? '');
    $deskripsi_perusahaan = trim($_POST['deskripsi_perusahaan'] ?? '');
    $kontak = trim($_POST['kontak'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $standar = trim($_POST['standar'] ?? '');
    $kerja_sama = trim($_POST['kerja_sama'] ?? '');

    // ! Validasi Input yang diperlukan
    if (empty($nama) || empty($alamat) || empty($kota) || empty($kontak) || empty($email)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect('crud-perusahaan.php');
    }

    // ! Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid!";
        redirect('crud-perusahaan.php');
    }

    // ! Validasi file uploads
    $logo = null;
    if (isset($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])) {
        // ! Check if file is an image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['logo']['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "File logo harus berupa gambar (JPEG, PNG, GIF)!";
            redirect('crud-perusahaan.php');
        }

        // ! Check file size (max 2MB)
        if ($_FILES['logo']['size'] > 2097152) {
            $_SESSION['error'] = "Ukuran logo terlalu besar (maksimal 2MB)!";
            redirect('crud-perusahaan.php');
        }
        
        $logo = file_get_contents($_FILES['logo']['tmp_name']);
    }

    $gambar = null;
    if (isset($_FILES['gambar']['tmp_name']) && is_uploaded_file($_FILES['gambar']['tmp_name'])) {
        // ! Check if file is an image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['gambar']['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "File gambar harus berupa gambar (JPEG, PNG, GIF)!";
            redirect('crud-perusahaan.php');
        }

        // ! Check file size (max 2MB)
        if ($_FILES['gambar']['size'] > 2097152) {
            $_SESSION['error'] = "Ukuran gambar terlalu besar (maksimal 2MB)!";
            redirect('crud-perusahaan.php');
        }
        
        $gambar = file_get_contents($_FILES['gambar']['tmp_name']);
    }

    try {
        $sql = $koneksi->prepare("INSERT INTO perusahaan (nama, alamat, kota, deskripsi_perusahaan, kontak, email, logo, gambar, kategori, standar, kerja_sama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssssssssss", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $logo, $gambar, $kategori, $standar, $kerja_sama);
        $sql->execute();

        $_SESSION['success'] = "Perusahaan berhasil ditambahkan!";
        redirect('crud-perusahaan.php');
    } catch (Exception $e) {
        error_log("Error adding company: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan perusahaan.";
        redirect('crud-perusahaan.php');
    }
}

// TODO Delete Company
if (isset($_GET['delete'])) {
    $id_perusahaan = intval($_GET['delete'] ?? 0);
    
    if ($id_perusahaan <= 0) {
        $_SESSION['error'] = "ID Perusahaan tidak valid!";
        redirect('crud-perusahaan.php');
    }

    try {
        $sql = $koneksi->prepare("DELETE FROM perusahaan WHERE id_perusahaan = ?");
        $sql->bind_param("i", $id_perusahaan);
        $sql->execute();

        $_SESSION['success'] = "Perusahaan berhasil dihapus!";
        redirect('crud-perusahaan.php');
    } catch (Exception $e) {
        error_log("Error deleting company: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus perusahaan.";
        redirect('crud-perusahaan.php');
    }
}

// TODO Edit data perusahaan
$edit = false;
$edit_id = "";
$edit_nama = "";
$edit_alamat = "";
$edit_kota = "";
$edit_deskripsi_perusahaan = "";
$edit_kontak = "";
$edit_email = "";
$edit_logo = "";
$edit_gambar = "";
$edit_kategori = "";
$edit_standar = "";
$edit_kerja_sama = "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id_perusahaan = intval($_GET['edit'] ?? 0);
    
    if ($id_perusahaan <= 0) {
        $_SESSION['error'] = "ID Perusahaan tidak valid!";
        redirect('crud-perusahaan.php');
    }

    try {
        $query = $koneksi->prepare("SELECT * FROM perusahaan WHERE id_perusahaan = ?");
        $query->bind_param("i", $id_perusahaan);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows === 0) {
            $_SESSION['error'] = "Perusahaan tidak ditemukan!";
            redirect('crud-perusahaan.php');
        }
        
        $data = $result->fetch_assoc();

        $edit_id = $data['id_perusahaan'];
        $edit_nama = htmlspecialchars($data['nama']);
        $edit_alamat = htmlspecialchars($data['alamat']);
        $edit_kota = htmlspecialchars($data['kota']);
        $edit_deskripsi_perusahaan = htmlspecialchars($data['deskripsi_perusahaan']);
        $edit_kontak = htmlspecialchars($data['kontak']);
        $edit_email = htmlspecialchars($data['email']);
        $edit_logo = $data['logo'];
        $edit_gambar = $data['gambar'];
        $edit_kategori = htmlspecialchars($data['kategori']);
        $edit_standar = htmlspecialchars($data['standar']);
        $edit_kerja_sama = htmlspecialchars($data['kerja_sama']);
    } catch (Exception $e) {
        error_log("Error fetching company data: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat mengambil data perusahaan.";
        redirect('crud-perusahaan.php');
    }
}

// TODO Update perusahaan
if (isset($_POST['update'])) {
    $id_perusahaan = intval($_POST['id_perusahaan'] ?? 0);
    
    if ($id_perusahaan <= 0) {
        $_SESSION['error'] = "ID Perusahaan tidak valid!";
        redirect('crud-perusahaan.php');
    }

    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $kota = trim($_POST['kota'] ?? '');
    $deskripsi_perusahaan = trim($_POST['deskripsi_perusahaan'] ?? '');
    $kontak = trim($_POST['kontak'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $standar = trim($_POST['standar'] ?? '');
    $kerja_sama = trim($_POST['kerja_sama'] ?? '');

    // ! Validasi input yang di[erlukan]
    if (empty($nama) || empty($alamat) || empty($kota) || empty($kontak) || empty($email)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect('crud-perusahaan.php');
    }

    // ! Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid!";
        redirect('crud-perusahaan.php');
    }

    // TODO Handle logo update
    if (isset($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])) {
        // ! Check if file is an image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['logo']['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "File logo harus berupa gambar (JPEG, PNG, GIF)!";
            redirect('crud-perusahaan.php');
        }

        // ! Check file size (max 2MB)
        if ($_FILES['logo']['size'] > 2097152) {
            $_SESSION['error'] = "Ukuran logo terlalu besar (maksimal 2MB)!";
            redirect('crud-perusahaan.php');
        }
        
        $logo = file_get_contents($_FILES['logo']['tmp_name']);
    } else {
        // ! Keep existing logo if no new file uploaded
        $query = $koneksi->prepare("SELECT logo FROM perusahaan WHERE id_perusahaan = ?");
        $query->bind_param("i", $id_perusahaan);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        $logo = $data['logo'];
    }

    // ! Handle gambar update
    if (isset($_FILES['gambar']['tmp_name']) && is_uploaded_file($_FILES['gambar']['tmp_name'])) {
        // ! Check if file is an image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['gambar']['tmp_name']);
        
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "File gambar harus berupa gambar (JPEG, PNG, GIF)!";
            redirect('crud-perusahaan.php');
        }

        // ! Check file size (max 2MB)
        if ($_FILES['gambar']['size'] > 2097152) {
            $_SESSION['error'] = "Ukuran gambar terlalu besar (maksimal 2MB)!";
            redirect('crud-perusahaan.php');
        }
        
        $gambar = file_get_contents($_FILES['gambar']['tmp_name']);
    } else {
        // ! Keep existing gambar if no new file uploaded
        $query = $koneksi->prepare("SELECT gambar FROM perusahaan WHERE id_perusahaan = ?");
        $query->bind_param("i", $id_perusahaan);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        $gambar = $data['gambar'];
    }

    try {
        $sql = $koneksi->prepare("UPDATE perusahaan SET nama = ?, alamat = ?, kota = ?, deskripsi_perusahaan = ?, kontak = ?, email = ?, logo = ?, gambar = ?, kategori = ?, standar = ?, kerja_sama = ? WHERE id_perusahaan = ?");
        $sql->bind_param("sssssssssssi", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $logo, $gambar, $kategori, $standar, $kerja_sama, $id_perusahaan);
        $sql->execute();

        $_SESSION['success'] = "Perusahaan berhasil diupdate!";
        redirect('crud-perusahaan.php');
    } catch (Exception $e) {
        error_log("Error updating company: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat mengupdate perusahaan.";
        redirect('crud-perusahaan.php');
    }
}

// TODO Ambil data perusahaan
try {
    $result = $koneksi->query("SELECT * FROM perusahaan ORDER BY nama ASC");
} catch (Exception $e) {
    error_log("Error fetching companies: " . $e->getMessage());
    $_SESSION['error'] = "Terjadi kesalahan saat mengambil data perusahaan.";
    $result = false;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>CRUD Perusahaan</title>
    <style>
        .success {
            color: green;
            padding: 10px;
            background-color: #e6ffe6;
            border: 1px solid green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            padding: 10px;
            background-color: #ffebeb;
            border: 1px solid red;
            margin-bottom: 15px;
        }

    </style>
</head>

<body>
    <h1>CRUD Perusahaan</h1>

    <?php if (isset($_SESSION['success'])): ?>
    <div class="success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <h3><?php echo $edit ? "Edit" : "Tambah"; ?> Lowker</h3>
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id_perusahaan" value="<?= $edit_id ?>">

        <label>Nama :</label><br>
        <input name="nama" value="<?= $edit_nama ?>" required></input><br>

        <label>Alamat :</label><br>
        <input type="input" name="alamat" value="<?= $edit_alamat ?>" required><br>

        <label>Kota :</label><br>
        <input type="input" name="kota" value="<?= $edit_kota ?>" required><br>

        <label>Deskripsi Perusahaan :</label><br>
        <textarea name="deskripsi_perusahaan" id=""><?= $edit_deskripsi_perusahaan ?></textarea><br>

        <label>Kontak :</label><br>
        <input type="input" name="kontak" value="<?= $edit_kontak ?>" required><br>

        <label>Email :</label><br>
        <input type="input" name="email" value="<?= $edit_email ?>" required><br>

        <label>Logo :</label><br>
        <input type="file" name="logo" accept="image/*" value=""><br>

        <label>Gambar :</label><br>
        <input type="file" name="gambar" accept="image/*" value=""><br><br>

        <label>Standar</label><br>
        <input type="radio" name="standar" value="umkm" <?= $edit_standar == 'umkm' ? 'checked' : '' ?>>UMKM
        <input type="radio" name="standar" value="mou" <?= $edit_standar == 'mou' ? 'checked' : '' ?>>MOU
        <input type="radio" name="standar" value="startup" <?= $edit_standar == 'startup' ? 'checked' : '' ?>>STARTUP
        <input type="radio" name="standar" value="perseroan"
            <?= $edit_standar == 'perseroan' ? 'checked' : '' ?>>PERSEROAN
        <br><br>

        <label>Kategori</label><br>
        <input type="radio" name="kategori" value="lokal" <?= $edit_kategori == 'lokal' ? 'checked' : '' ?>>LOKAL
        <input type="radio" name="kategori" value="provinsi"
            <?= $edit_kategori == 'provinsi' ? 'checked' : '' ?>>PROVINSI
        <input type="radio" name="kategori" value="nasional"
            <?= $edit_kategori == 'nasional' ? 'checked' : '' ?>>NASIONAL
        <input type="radio" name="kategori" value="internasional"
            <?= $edit_kategori == 'internasional' ? 'checked' : '' ?>>INTERNASIONAL
        <br><br>

        <label>Kerja Sama:</label><br>
        <textarea name="kerja_sama"
            placeholder="Tekan enter untuk baris selanjutnya"><?= $edit_kerja_sama ?></textarea><br><br>


        <?php if ($edit): ?>
        <button type="submit" name="update">Update</button>
        <a href="crud.php"><button type="button">Batal</button></a>
        <?php else: ?>
        <button type="submit" name="add">Tambah</button>
        <?php endif; ?>
    </form>

    <!-- Tabel Data Lowker -->
    <h3>Daftar Perusahaan</h3>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Deskripsi Perusahaan</th>
                <th>Kontak</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Gambar</th>
                <th>Standar</th>
                <th>Kategori</th>
                <th>Kerja Sama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_perusahaan']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['kota']; ?></td>
                <td><?php echo $row['deskripsi_perusahaan']; ?></td>
                <td><?php echo $row['kontak']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <?php 
                if (!empty($row['logo'])) {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['logo']) . '" alt="Logo Perusahaan" width="100">';
                } else {
                    echo 'Tidak ada logo';
                }
                ?>
                </td>
                <td>
                    <?php 
                if (!empty($row['gambar'])) {
                    echo '<img src="data:image/png;base64,' . base64_encode($row['gambar']) . '" alt="Gambar Perusahaan" width="100">';
                } else {
                    echo 'Tidak ada gambar';
                }
                ?>
                </td>

                <td><?php echo $row['kategori']; ?></td>
                <td><?php echo $row['standar']; ?></td>
                <td>
                    <ol>
                        <?php
                    $kerjaList = preg_split("/[\r\n]+/", $row['kerja_sama']); 
                    foreach ($kerjaList as $item) {
                        $item = trim($item);
                        if (!empty($item)) {
                            echo "<li>{$item}</li>";
                        }
                    }
                    ?>
                    </ol>
                </td>


                <td>
                    <a href="?edit=<?= $row['id_perusahaan'] ?>">Edit</a> |
                    <a href="?delete=<?= $row['id_perusahaan'] ?>"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>