<?php
// Koneksi ke database
include 'koneksi.php';

// Tambah lowker
if (isset($_POST['add'])) {
    $deskripsi_lowker = $_POST['deskripsi_lowker'];
    $tgl_ditutup = $_POST['tgl_ditutup'];
    $persyaratan = $_POST['persyaratan'];
    $id_perusahaan = $_POST['id_perusahaan'];
    $tgl_posting = date('Y-m-d'); // Tambahkan tanggal posting otomatis

    $sql = $koneksi->prepare("INSERT INTO lowker (deskripsi_lowker, tgl_ditutup, persyaratan, tgl_posting, id_perusahaan) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssssi", $deskripsi_lowker, $tgl_ditutup, $persyaratan, $tgl_posting, $id_perusahaan);
    $sql->execute();

    header("Location: crud.php");
    exit;
}

// Hapus lowker
if (isset($_GET['delete'])) {
    $id_lowker = $_GET['delete'];
    $sql = $koneksi->prepare("DELETE FROM lowker WHERE id_lowker = ?");
    $sql->bind_param("i", $id_lowker);
    $sql->execute();

    header("Location: crud.php");
    exit;
}

// Ambil data untuk edit
$edit = false;
$edit_id = "";
$edit_deskripsi = "";
$edit_tgl_ditutup = "";
$edit_persyaratan = "";
$edit_id_perusahaan = "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id_lowker = $_GET['edit'];
    $query = $koneksi->prepare("SELECT * FROM lowker WHERE id_lowker = ?");
    $query->bind_param("i", $id_lowker);
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_assoc();

    $edit_id = $data['id_lowker'];
    $edit_deskripsi = $data['deskripsi_lowker'];
    $edit_tgl_ditutup = $data['tgl_ditutup'];
    $edit_persyaratan = $data['persyaratan'];
    $edit_id_perusahaan = $data['id_perusahaan'];
}

// Update lowker
if (isset($_POST['update'])) {
    $id_lowker = $_POST['id_lowker'];
    $deskripsi_lowker = $_POST['deskripsi_lowker'];
    $tgl_ditutup = $_POST['tgl_ditutup'];
    $persyaratan = $_POST['persyaratan'];
    $id_perusahaan = $_POST['id_perusahaan'];

    $sql = $koneksi->prepare("UPDATE lowker SET deskripsi_lowker = ?, tgl_ditutup = ?, persyaratan = ?, id_perusahaan = ? WHERE id_lowker = ?");
    $sql->bind_param("sssii", $deskripsi_lowker, $tgl_ditutup, $persyaratan, $id_perusahaan, $id_lowker);
    $sql->execute();

    header("Location: crud.php");
    exit;
}

// Fetch companies for the dropdown
$companies = $koneksi->query("SELECT id_perusahaan, nama FROM perusahaan");

// Mendapatkan semua lowker dengan nama perusahaan
$result = $koneksi->query("
    SELECT lowker.*, perusahaan.nama AS nama_perusahaan 
    FROM lowker 
    JOIN perusahaan ON lowker.id_perusahaan = perusahaan.id_perusahaan
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>CRUD Lowker</title>
</head>
<body>
    <h1>CRUD Lowker</h1>

    <!-- Form Tambah / Edit Lowker -->
    <form method="POST" action="">
        <h3><?php echo $edit ? "Edit" : "Tambah"; ?> Lowker</h3>
        <input type="hidden" name="id_lowker" value="<?= $edit_id ?>">
        <label>Deskripsi Lowker:</label><br>
        <textarea name="deskripsi_lowker" required><?= $edit_deskripsi ?></textarea><br>
        <label>Tanggal Ditutup:</label><br>
        <input type="date" name="tgl_ditutup" value="<?= $edit_tgl_ditutup ?>" required><br>
        <label>Persyaratan:</label><br>
        <textarea name="persyaratan" required><?= $edit_persyaratan ?></textarea><br><br>
        <label>Perusahaan:</label><br>
        <select name="id_perusahaan" required>
            <?php while ($company = $companies->fetch_assoc()): ?>
                <option value="<?= $company['id_perusahaan'] ?>" <?= $edit && $edit_id_perusahaan == $company['id_perusahaan'] ? 'selected' : '' ?>>
                    <?= $company['nama'] ?>
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
                <th>Deskripsi Lowker</th>
                <th>Tanggal Ditutup</th>
                <th>Persyaratan</th>
                <th>Tanggal Posting</th>
                <th>Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_lowker'] ?></td>
                    <td><?= $row['deskripsi_lowker'] ?></td>
                    <td><?= $row['tgl_ditutup'] ?></td>
                    <td><?= $row['persyaratan'] ?></td>
                    <td><?= $row['tgl_posting'] ?></td>
                    <td><?= $row['nama_perusahaan'] ?></td>
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
