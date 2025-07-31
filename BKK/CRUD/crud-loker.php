<?php
require_once __DIR__ . '/../config/helpers.php';

validate_csrf();

allow_role(['admin', 'recruiter']);

// TODO TAMBAH LOWKER
if (isset($_POST['add'])) {
    $judul_lowker = trim($_POST['judul_lowker'] ?? '');
    $deskripsi_lowker = trim($_POST['deskripsi_lowker'] ?? '');
    $gaji = trim($_POST['gaji'] ?? '');
    $pendidikan = trim($_POST['pendidikan'] ?? '');
    $tipe_pekerjaan = trim($_POST['tipe_pekerjaan'] ?? '');
    $tgl_ditutup = trim($_POST['tgl_ditutup'] ?? '');
    $keahlian = trim($_POST['keahlian'] ?? '');
    $waktu_bekerja = trim($_POST['waktu_bekerja'] ?? '');
    $kualifikasi = trim($_POST['kualifikasi'] ?? '');
    $tunjangan = trim($_POST['tunjangan'] ?? '');
    $lokasi = trim($_POST['lokasi'] ?? '');
    $id_perusahaan = intval($_POST['id_perusahaan'] ?? 0);
    $id_jurusan = intval($_POST['id_jurusan'] ?? 0);
    $tgl_posting = date('Y-m-d');

    if (!$judul_lowker || !$deskripsi_lowker || !$id_perusahaan || !$id_jurusan) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect("crud.php");
    }

    // ! Validasi format tanggal
    if (!DateTime::createFromFormat('Y-m-d', $tgl_ditutup)) {
        $_SESSION['error'] = "Format tanggal tidak valid!";
        redirect("crud.php");
    }

    try {
        $sql = $koneksi->prepare("INSERT INTO lowker (judul_lowker, deskripsi_lowker, gaji, pendidikan,
                                tipe_pekerjaan, tgl_ditutup, keahlian, waktu_bekerja, kualifikasi, tunjangan, lokasi,
                                tgl_posting, id_perusahaan, id_jurusan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param(
            "ssssssssssssii",
            $judul_lowker,
            $deskripsi_lowker,
            $gaji,
            $pendidikan,
            $tipe_pekerjaan,
            $tgl_ditutup,
            $keahlian,
            $waktu_bekerja,
            $kualifikasi,
            $tunjangan,
            $lokasi,
            $tgl_posting,
            $id_perusahaan,
            $id_jurusan
        );
        $sql->execute();

        $_SESSION['success'] = "Lowker berhasil ditambahkan!";
        redirect("crud.php");
    } catch (Exception $e) {
        error_log("Error adding lowker: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan lowker.";
        redirect("crud.php");
    }
}

// TODO HAPUS LOWKER
if (isset($_GET['delete'])) {
    $id_lowker = intval($_GET['delete']);
    $sql = $koneksi->prepare("DELETE FROM lowker WHERE id_lowker = ?");
    $sql->bind_param("i", $id_lowker);
    $sql->execute();

    if (!$id_lowker) {
        $_SESSION['error'] = "ID Lowker tidak valid!";
        redirect("crud.php");
    }    

    $_SESSION['success'] = "Lowker berhasil dihapus.";
    redirect("crud.php");
}

// TODO EDIT LOWKER
$edit = false;
$edit_id = "";
$edit_judul = "";
$edit_deskripsi = "";
$edit_gaji = "";
$edit_pendidikan = "";
$edit_tipe_pekerjaan = "";
$edit_tgl_ditutup = "";
$edit_keahlian = "";
$edit_waktu_bekerja = "";
$edit_kualifikasi = "";
$edit_tunjangan = "";
$edit_lokasi = "";
$edit_id_perusahaan = "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id_lowker = intval($_GET['edit']);

    if (!$id_lowker) {
        $_SESSION['error'] = "ID Lowker tidak valid!";
        redirect("crud.php");
    }

    try {
        $query = $koneksi->prepare("SELECT * FROM lowker WHERE id_lowker = ?");
        $query->bind_param("i", $id_lowker);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();

        $edit_id = $data['id_lowker'];
        $edit_judul = $data['judul_lowker'];
        $edit_deskripsi = $data['deskripsi_lowker'];
        $edit_gaji = $data['gaji'];
        $edit_pendidikan = $data['pendidikan'];
        $edit_tipe_pekerjaan = $data['tipe_pekerjaan'];
        $edit_tgl_ditutup = $data['tgl_ditutup'];
        $edit_keahlian = $data['keahlian'];
        $edit_waktu_bekerja = $data['waktu_bekerja'];
        $edit_kualifikasi = $data['kualifikasi'];
        $edit_tunjangan = $data['tunjangan'];
        $edit_lokasi = $data['lokasi'];
        $edit_id_perusahaan = $data['id_perusahaan'];
        $edit_id_jurusan = $data['id_jurusan'];  

    } catch (Exception $e) {
        error_log("Error fetching lowker data: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat mengambil data lowker.";
        redirect("crud.php");
    }

}

// TODO UPDATE LOWKER
if (isset($_POST['update'])) {
    $id_lowker = intval($_POST['id_lowker']);
    $judul_lowker = trim($_POST['judul_lowker'] ?? '');
    $deskripsi_lowker = trim($_POST['deskripsi_lowker'] ?? '');
    $gaji = trim($_POST['gaji'] ?? '');
    $pendidikan = trim($_POST['pendidikan'] ?? '');
    $tipe_pekerjaan = trim($_POST['tipe_pekerjaan'] ?? '');
    $tgl_ditutup = trim($_POST['tgl_ditutup'] ?? '');
    $keahlian = trim($_POST['keahlian'] ?? '');
    $waktu_bekerja = trim($_POST['waktu_bekerja'] ?? '');
    $kualifikasi = trim($_POST['kualifikasi'] ?? '');
    $tunjangan = trim($_POST['tunjangan'] ?? '')  ;
    $lokasi = trim($_POST['lokasi'] ?? '');
    $id_perusahaan = intval($_POST['id_perusahaan'] ?? 0);
    $id_jurusan = intval($_POST['id_jurusan'] ?? 0);
    $tgl_posting = date('Y-m-d');

    if (!$judul_lowker || !$deskripsi_lowker || !$id_perusahaan || !$id_jurusan) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        redirect("crud.php");
    }

    // ! Validasi format tanggal
    if (!DateTime::createFromFormat('Y-m-d', $tgl_ditutup)) {
        $_SESSION['error'] = "Format tanggal tidak valid!";
        redirect("crud.php");
    }

    try {
        $sql = $koneksi->prepare("UPDATE lowker SET judul_lowker = ?, deskripsi_lowker = ?,
                                gaji = ?, pendidikan = ?, tipe_pekerjaan = ?, tgl_ditutup = ?,
                                keahlian = ?, waktu_bekerja = ?, kualifikasi = ?, tunjangan = ?, lokasi = ?,
                                id_perusahaan = ?, id_jurusan = ? WHERE id_lowker = ?");
        $sql->bind_param(
            "sssssssssssiii",
            $judul_lowker,
            $deskripsi_lowker,
            $gaji,
            $pendidikan,
            $tipe_pekerjaan,
            $tgl_ditutup,
            $keahlian,
            $waktu_bekerja,
            $kualifikasi,
            $tunjangan,
            $lokasi,
            $id_perusahaan,  
            $id_jurusan,      
            $id_lowker
        );
        $sql->execute();

        $_SESSION['success'] = "Data berhasil diupdate!";
        redirect("crud.php");

    } catch (Exception $e) {
        error_log("Error updating lowker: " . $e->getMessage());
        $_SESSION['error'] = "Terjadi kesalahan saat mengupdate data.";
        redirect("crud.php");
    }
}



// TODO  Ambil data perusahaan untuk dropdown
$companies = $koneksi->query("SELECT id_perusahaan, nama FROM perusahaan");
$jurusan = $koneksi->query("SELECT id_jurusan, jurusan FROM jurusan");

// TODO mengambil nama perusahaan
$result = $koneksi->query("
    SELECT lowker.*, perusahaan.nama AS nama_perusahaan, jurusan.jurusan AS nama_jurusan
    FROM lowker
    JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
    JOIN jurusan ON lowker.id_jurusan = jurusan.id_jurusan
    
    
");
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <title>CRUD Lowker</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>CRUD Lowker</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <p class="success"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Form Tambah / Edit Lowker -->
    <form method="POST" action="">
        <h3><?php echo $edit ? "Edit" : "Tambah"; ?> Lowker</h3>
        <input type="hidden" name="id_lowker" value="<?= $edit_id ?>">
        <?= csrf_field() ?>

        <label>Judul Lowker:</label><br>
        <input name="judul_lowker" required value="<?= htmlspecialchars($edit_judul) ?>"><br>

        <label>Deskripsi Lowker:</label><br>
        <textarea name="deskripsi_lowker" required><?= htmlspecialchars($edit_deskripsi) ?></textarea><br>

        <label>Gaji:</label><br>
        <input type="text" name="gaji" required value="<?= htmlspecialchars($edit_gaji) ?>"><br>

        <label>Pendidikan:</label><br>
        <input type="text" name="pendidikan" required value="<?= htmlspecialchars($edit_pendidikan) ?>"><br>

        <label>Tipe Pekerjaan:</label><br>
        <input type="text" name="tipe_pekerjaan" required value="<?= htmlspecialchars($edit_tipe_pekerjaan) ?>"><br>

        <label>Tanggal Ditutup:</label><br>
        <input type="date" name="tgl_ditutup" value="<?= $edit_tgl_ditutup ?>" required><br>

        <label>Keahlian:</label><br>
        <textarea name="keahlian" required><?= htmlspecialchars($edit_keahlian) ?></textarea><br>

        <label>Waktu Bekerja:</label><br>
        <input type="text" name="waktu_bekerja" value="<?= htmlspecialchars($edit_waktu_bekerja) ?>"><br>

        <label>Kualifikasi:</label><br>
        <input type="text" name="kualifikasi" value="<?= htmlspecialchars($edit_kualifikasi) ?>"><br>

        <label>Tunjangan:</label><br>
        <input type="text" name="tunjangan" value="<?= htmlspecialchars($edit_tunjangan) ?>"><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" value="<?= htmlspecialchars($edit_lokasi) ?>"><br>

        <label>Jurusan:</label><br>
        <select name="id_jurusan" required>
            <?php while ($jrs = $jurusan->fetch_assoc()): ?>
                <option value="<?= $jrs['id_jurusan'] ?>" <?= $edit && $edit_id_jurusan == $jrs['id_jurusan'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($jrs['jurusan']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Perusahaan:</label><br>
        <select name="id_perusahaan" required>
            <?php while ($company = $companies->fetch_assoc()): ?>
            <option value="<?= $company['id_perusahaan'] ?>" <?= $edit && $edit_id_perusahaan == $company['id_perusahaan'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($company['nama']) ?>
            </option>
            <?php endwhile; ?>
        </select><br><br>

        <?php if ($edit): ?>
            <button type="submit" name="update">Update</button>
            <a href="crud.php"><button type="button">Batal</button></a>
        <?php else: ?>
            <button type="submit" name="add">Tambah</button>
        <?php endif; ?>
    </form>

    <!-- Tabel Data Lowker -->
    <h3>Daftar Lowker</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Lowker</th>
                <th>Deskripsi Lowker</th>
                <th>Gaji</th>
                <th>Pendidikan</th>
                <th>Tipe Pekerjaan</th>
                <th>Tanggal Ditutup</th>
                <th>Keahlian</th>
                <th>Waktu Bekerja</th>
                <th>Kualifikasi</th>
                <th>Tunjangan</th>
                <th>Lokasi</th>
                <th>Tanggal Posting</th>
                <th>Jurusan</th>
                <th>Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_lowker'] ?></td>
                    <td><?= htmlspecialchars($row['judul_lowker']) ?></td>
                    <td><?= htmlspecialchars($row['deskripsi_lowker']) ?></td>
                    <td><?= htmlspecialchars($row['gaji']) ?></td>
                    <td><?= htmlspecialchars($row['pendidikan']) ?></td>
                    <td><?= htmlspecialchars($row['tipe_pekerjaan']) ?></td>
                    <td><?= htmlspecialchars($row['tgl_ditutup']) ?></td>
                    <td><?= htmlspecialchars($row['keahlian']) ?></td>
                    <td><?= htmlspecialchars($row['waktu_bekerja']) ?></td>
                    <td><?= htmlspecialchars($row['kualifikasi']) ?></td>
                    <td><?= htmlspecialchars($row['tunjangan']) ?></td>
                    <td><?= htmlspecialchars($row['lokasi']) ?></td>
                    <td><?= htmlspecialchars($row['tgl_posting']) ?></td>
                    <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                    <td><?= htmlspecialchars($row['nama_perusahaan']) ?></td>
                    <td>
                        <a href="?edit=<?= $row['id_lowker'] ?>">Edit</a> |
                        <a href="?delete=<?= $row['id_lowker'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>