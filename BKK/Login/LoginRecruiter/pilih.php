<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login sebagai recruiter
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'recruiter') {
    header("Location: recruiter-login.php");
    exit();
}

// Ambil data perusahaan
$result = $koneksi->query("SELECT * FROM perusahaan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Perusahaan - Recruiter</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .company-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .company-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .company-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .company-card h3 {
            margin: 10px 0;
            color: #333;
        }
        .company-card p {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
        }
        .add-company-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 2px dashed #ccc;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .add-company-card:hover {
            background: #e9ecef;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #333;
        }
        .no-companies {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        </div>

        <?php if($result->num_rows > 0): ?>
            <h2>Pilih Perusahaan Anda:</h2>
            <div class="company-grid">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="company-card">
                    <?php if(!empty($row['logo'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['logo']); ?>" alt="Logo <?php echo htmlspecialchars($row['nama']); ?>">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                    <p><strong>Alamat:</strong> <?php echo htmlspecialchars($row['alamat']); ?></p>
                    <p><strong>Kota:</strong> <?php echo htmlspecialchars($row['kota']); ?></p>
                    <p><strong>Kontak:</strong> <?php echo htmlspecialchars($row['kontak']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                </div>
                <?php endwhile; ?>
                
                <!-- Card untuk menambah perusahaan baru -->
                <a href="../../BKK/Perusahaan/crud.php" class="company-card add-company-card">
                    <i class="fas fa-plus" style="font-size: 48px; color: #666;"></i>
                    <h3>Tambah Perusahaan Baru</h3>
                </a>
            </div>
        <?php else: ?>
            <div class="no-companies">
                <h2>Belum ada perusahaan terdaftar</h2>
                <p>Silakan daftarkan perusahaan Anda terlebih dahulu</p>
                <a href="../../perusahaan/crud.php" class="btn">Daftarkan Perusahaan</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
