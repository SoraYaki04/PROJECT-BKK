<?php
// Koneksi ke database
include '../koneksi.php';

// Tambah Perusahaan
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $deskripsi_perusahaan  = $_POST['deskripsi_perusahaan'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $logo = $_POST['logo'];
    $gambar = $_POST['gambar'];
    

    $sql = $koneksi->prepare("INSERT INTO perusahaan (nama, alamat, kota, deskripsi_perusahaan, kontak, email, logo, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssssi", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $logo, $gambar );
    $sql->execute();

    header("Location: crud.php");
    exit;
}

// Hapus Perusahaan
if (isset($_GET['delete'])) {
    $id_perusahaan = $_GET['delete'];
    $sql = $koneksi->prepare("DELETE FROM perusahaan WHERE id_perusahaan = ?");
    $sql->bind_param("i", $id_perusahaan);
    $sql->execute();

    header("Location: crud.php");
    exit;
}

// Ambil data untuk edit
$edit = false;
$edit_id = "";
$edit_nama = "";
$edit_alamat = "";
$edit_kota = "";
$edit_deskripsi_perusahaan = "";
$edit_kontak = "";
$edit_email = "";
$edit_logo = "";
$edit_gambar= "";

if (isset($_GET['edit'])) {
    $edit = true;
    $id_perusahaan = $_GET['edit'];
    $query = $koneksi->prepare("SELECT * FROM perusahaan WHERE id_perusahaan = ?");
    $query->bind_param("i", $id_perusahaan);
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_assoc();

    $edit_id = $data['id_perusahaan'];
    $edit_nama = $data['nama'];
    $edit_alamat = $data['alamat'];
    $edit_kota = $data['kota'];
    $edit_deskripsi_perusahaan = $data['deskripsi_perusahaan'];
    $edit_kontak = $data['kontak'];
    $edit_email = $data['email'];
    $edit_logo = $data['logo'];
    $edit_gambar= $data['gambar'];
}

// Update Perusahaan
if (isset($_POST['update'])) {
    $id_perusahaan = $_POST['id_perusahaan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $deskripsi_perusahaan = $_POST['deskripsi_perusahaan'];
    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    

    if(isset($_FILES['logo']['tmp_name']) && !empty($_FILES['logo']['tmp_name'])) {
        $logo = file_get_contents($_FILES['logo']['tmp_name']);
    } else {
        $query = $koneksi->prepare("SELECT logo FROM perusahaan WHERE id_perusahaan = ?");
        $query->bind_param("i", $id_perusahaan);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        $logo = $data['logo'];
    }
    

    if(isset($_FILES['gambar']['tmp_name']) && !empty($_FILES['gambar']['tmp_name'])) {
        $gambar = file_get_contents($_FILES['gambar']['tmp_name']);
    } else {
        $query = $koneksi->prepare("SELECT gambar FROM perusahaan WHERE id_perusahaan = ?");
        $query->bind_param("i", $id_perusahaan);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_assoc();
        $gambar = $data['gambar'];
    }

    $sql = $koneksi->prepare("UPDATE perusahaan SET nama = ?, alamat = ?, kota = ?, deskripsi_perusahaan = ?, kontak = ?, email = ?, logo = ?, gambar = ? WHERE id_perusahaan = ?");
    $sql->bind_param("ssssssssi", $nama, $alamat, $kota, $deskripsi_perusahaan, $kontak, $email, $logo, $gambar, $id_perusahaan);
    $sql->execute();

    header("Location: crud.php");
    exit;
}


// Mendapatkan semua Perusahaan
$result = $koneksi->query("SELECT * FROM perusahaan");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD Perusahaan</title>
</head>
<body>
    <h1>CRUD Perusahaan</h1>

    <!-- Form Tambah / Edit Lowker -->
    <form method="POST" action="" enctype="multipart/form-data">
        <h3><?php echo $edit ? "Edit" : "Tambah"; ?> Lowker</h3>
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
        <input type="file" name="logo" accept="image/*" value="<?= $edit_logo ?>" ><br>
        
        <label>Gambar :</label><br>
        <input type="file" name="gambar" accept="image/*" value="<?= $edit_gambar ?>" ><br>

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
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" alt="Logo Perusahaan" width="100">';
                } else {
                    echo 'Tidak ada logo';
                }
                ?>
            </td>
            <td>
                <?php
                if (!empty($row['logo'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['gambar']) . '" alt="Logo Perusahaan" width="100">';
                    } else {
                        echo 'Tidak ada logo';
                    }
                ?>
            </td>
            <td>
                <a href="?edit=<?= $row['id_perusahaan'] ?>">Edit</a> |
                <a href="?delete=<?= $row['id_perusahaan'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
