/*
 Navicat Premium Dump SQL

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : bkk

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 19/08/2025 15:37:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alumni
-- ----------------------------
DROP TABLE IF EXISTS `alumni`;
CREATE TABLE `alumni`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nisn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agama` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rt` int NULL DEFAULT NULL,
  `rw` int NULL DEFAULT NULL,
  `dusun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kelurahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pos` int NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_wa` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jurusan` int NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_jurusan`(`id_jurusan` ASC) USING BTREE,
  CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of alumni
-- ----------------------------
INSERT INTO `alumni` VALUES (1, 'user1', 'lk', '0123', 'Tulungaagung', '2025-07-22', '017', 'islam', 'sendang', 3, 2, 'mrcan', 'krosok', 'sendnag', 9868, 'pakli8104@gmail.com', '082228329932', 1, '$2y$10$sTNTKcTbQpgeceMxYjFVde7MbI67mI8w2cl2i.DCciffZ730d3/ym', 'profile_1_1753838330.jpg');

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `id_berita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jml_peserta` varbinary(255) NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_berita`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berita
-- ----------------------------
INSERT INTO `berita` VALUES (5, 'inzaghiiiii', '2025-08-19', 0x313030, 'Tulungagung', 'Filippo Inzaghi adalah pesapk bola profesional yang telah memnangkan berbagai piala bersama ac millan, dan juga dengan italia.\r\npuncaknya ketika di ac milan, Inzaghi berhasil mencetak gol kemenangan di Athens pada saat final Cham,pion League melawan juara favorit yaitu liverpool yang saat itu bisa dibilang kandidat terbaik juara', 'kegiatan_68931379960ee1.65217981.jpg');
INSERT INTO `berita` VALUES (6, 'ERLIINGGGGGG', '2025-08-19', 0x313030, 'Manchester', 'Erling Braut Haaland adalah pesepak bola profesional yang sekarang membela tim manchester city di premier league', 'kegiatan_68931436121a25.45683861.jpg');
INSERT INTO `berita` VALUES (7, 'MARTEN PAES', '2025-08-27', 0x3131, 'Indonesia', 'Kiper timnas indonesia', 'kegiatan_68941abf953ac3.90492159.jpg');
INSERT INTO `berita` VALUES (8, 'Marselino', '2025-08-01', 0x3130, 'Surabaya', 'Gelandang penyerang timnas indonesia', 'kegiatan_68941ba3ba00c0.02999201.jpg');
INSERT INTO `berita` VALUES (9, 'MBAPPE', '2025-08-26', 0x37, 'Perancis', 'Penyerang timnas Perancis dan juga Real Madrid', 'kegiatan_68941c748f4db8.43761353.jpg');
INSERT INTO `berita` VALUES (10, 'SON', '2025-08-01', 0x37, 'Korea Selatan', 'Penyerang timnas Korea Selatan dan juga Legenda klub Totenham Hotspur', 'kegiatan_68941cc3677b27.28188285.jpg');
INSERT INTO `berita` VALUES (12, 'MESSI', '2025-08-30', 0x3130, 'Rosario', 'Lionel; Messi adalah seorang pemain sepak bole yang kini membela klub Inter Miami. Ia adalah legenda hidup Barcelona yang masih bermain hingga sekarang. Memenangkan berbagai tropy bergengsi bersama klub dan juga timnas Argentina. Pencapaian dia pantas untuk disebut \"The Greatest of All Times\" hingga mendapatkan 8 Baloon D\'or yang menjadi pemain pertama yang mempunyai Baloon D\'or sebanyak itu.\r\ncihuyyy', 'kegiatan_68941ef7b4c469.60455580.jpg');
INSERT INTO `berita` VALUES (13, 'C. RONALDO', '2025-08-30', 0x37, 'Portugal', 'Penyerang timnas Portugal dan juga legenda Real Madrid.\r\nRivalitasnya dengan messi menjadi salah satu rivalitas paling intens di sepak bola menjadikannya salah satu yang terbaik di dunia', 'kegiatan_68941f81475592.26051743.jpg');

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES (1, 'AKUNTANSI');
INSERT INTO `jurusan` VALUES (2, 'ANIMASI');
INSERT INTO `jurusan` VALUES (3, 'BISNIS DIGITAL');
INSERT INTO `jurusan` VALUES (4, 'DESAIN KOMUNIKASI VISUAL');
INSERT INTO `jurusan` VALUES (5, 'MANAJEMEN PERKANTORAN');
INSERT INTO `jurusan` VALUES (6, 'PROGAM SIARAN PENYIARAN TELEVISI');
INSERT INTO `jurusan` VALUES (7, 'REKAYASA PERANGKAT LUNAK');
INSERT INTO `jurusan` VALUES (8, 'TEKNIK KIMIA INDUSTRI');
INSERT INTO `jurusan` VALUES (9, 'TEKNIK KOMPUTER JARINGAN');
INSERT INTO `jurusan` VALUES (10, 'USAHA LAYANAN WISATA');

-- ----------------------------
-- Table structure for lamaran
-- ----------------------------
DROP TABLE IF EXISTS `lamaran`;
CREATE TABLE `lamaran`  (
  `id_lamaran` int NOT NULL AUTO_INCREMENT,
  `id_alumni` int NULL DEFAULT NULL,
  `id_lowker` int NULL DEFAULT NULL,
  `pass_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ijazah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `portofolio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sertifikat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ktp_kk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `skck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `surat_lamaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lamaran` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_lamaran`) USING BTREE,
  INDEX `id_alumni`(`id_alumni` ASC) USING BTREE,
  INDEX `id_lowker`(`id_lowker` ASC) USING BTREE,
  CONSTRAINT `alumni` FOREIGN KEY (`id_alumni`) REFERENCES `alumni` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `lowker` FOREIGN KEY (`id_lowker`) REFERENCES `lowker` (`id_lowker`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lamaran
-- ----------------------------

-- ----------------------------
-- Table structure for lowker
-- ----------------------------
DROP TABLE IF EXISTS `lowker`;
CREATE TABLE `lowker`  (
  `id_lowker` int NOT NULL AUTO_INCREMENT,
  `id_jurusan` int NOT NULL,
  `judul_lowker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_lowker` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe_pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_ditutup` date NULL DEFAULT NULL,
  `tgl_posting` date NULL DEFAULT NULL,
  `keahlian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `waktu_bekerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kualifikasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tunjangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `id_perusahaan` int NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_pelamar` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_lowker`, `id_jurusan`) USING BTREE,
  INDEX `id_perusahaan`(`id_perusahaan` ASC) USING BTREE,
  INDEX `id_lowker`(`id_lowker` ASC) USING BTREE,
  INDEX `jurusan`(`id_jurusan` ASC) USING BTREE,
  CONSTRAINT `jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lowker
-- ----------------------------
INSERT INTO `lowker` VALUES (15, 7, 'BACK END DEVELOPER (PHP/Laravel)', 'const companyContainer = document.querySelector(\'.company-container\');\r\nconst companyControlsContainer = document.querySelector(\'.company-controls\');\r\nconst companyControls = [\'previous\', \'next\'];\r\nconst companyItems = document.querySelectorAll(\'.company-item\');\r\n\r\nclass Carousel {\r\n    constructor(container, items, controls) {\r\n        this.carouselContainer = container;\r\n        this.carouselControls = controls;\r\n        this.carouselArray = [...items];\r\n        this.isTransitioning = false;\r\n        this.controlButtons = [];\r\n        this.autoPlayInterval = null;\r\n    }\r\n\r\n    updateCompany() {\r\n        this.carouselArray.forEach((el, index) => {\r\n            const detailElement = el.querySelector(\'.company-detail\');\r\n\r\n            if (detailElement && index !== 2) {', '', 'Rp 100-200 juta', 'Diploma D1/D2/D3, Sarjana S1, SMA/SMK', 'Full time, remote (work from anywhere)', '2025-08-30', '2025-08-19', 'HTML\r\nCSS\r\nJAVASCRIPT\r\nPYTHON\r\nPASCAL\r\nC++', 'Rabu - Jumat. 07:30 - 12:00', 'Mempunyai semangat muda\r\njujur\r\namanah\r\nrajin', 'uang makan\r\nuang minum\r\nuang transportasi', 6, 'Malang', NULL);

-- ----------------------------
-- Table structure for perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE `perusahaan`  (
  `id_perusahaan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `kota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi_perusahaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `kontak` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo` longblob NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `standar` enum('umkm','mou','startup','perseroan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('lokal','provinsi','nasional','internasional') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kerja_sama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_perusahaan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------
INSERT INTO `perusahaan` VALUES (1, 'Microsoft', 'Redmond', 'Washingtomn', 'Microsoft Corporation adalah perusahaan multinasional Amerika Serikat yang berpusat di Redmond, Washington, Amerika Serikat yang mengembangkan, membuat, memberi lisensi, dan mendukung berbagai produk dan jasa terkait dengan komputer. Perusahaan ini didirikan oleh Bill Gates dan Paul Allen pada tanggal 4 April 1975. Microsoft merupakan pembuat perangkat lunak terbesar di dunia menurut pendapatannya.Microsoft juga merupakan salah satu perusahaan paling bernilai di dunia', '111', 'microsoft@gmail.com', NULL, 'perusahaan_68a3ee4d852219.20238592.png', 'perseroan', 'internasional', 'RPLD\r\nDKV\r\nANM');
INSERT INTO `perusahaan` VALUES (2, 'A-1 Pictures', 'Suginami', 'Tokyo', 'A-1 Pictures Inc. adalah sebuah studio animasi Jepang yang didirikan oleh Mikihiro Iwata seorang mantan produser dari Sunrise, A-1 Pictures dioperasikan dan dimiliki sepenuhnya oleh Aniplex anak perusahaan dari Sony Music Entertainment Japan.', '222', 'a1pictures@gmail.com', NULL, 'perusahaan_68a3f12600b531.71771867.png', 'umkm', 'internasional', 'ANIMASI');
INSERT INTO `perusahaan` VALUES (3, 'Hybe Insight', 'Yongsan Trade Center Co., Ltd.', 'Seoul', '\"안녕하세요. HYBE INSIGHT입니다. HYBE INSIGHT는 \"WE BELIEVE IN MUSIC\"이라는 하이브의 미션 아래, \'음악으로 감동을 전하고 선한 영향력을 나누며 삶의 변화를 만들어간다\'라는 지향점이 녹아있는 HYBE의 전시 브랜드입니다. HYBE INSIGHT는 2023년 1월 15일(일)을 마지막으로 하이브 용산 사옥에서의 운영을 종료하고 임시 휴업함을 알려드립니다. 그동안 보내주신 여러분의 성원에 감사드리며 새로운 공간에서 보다 발전된 모습으로 찾아뵙겠습니다. HYBE INSIGHT와 관련된 새로운 소식은 공식 트위터와 홈페이지를 통해 확인 가능합니다. 감사합니다.\"', '333', 'hybe@gmail.com', NULL, 'perusahaan_68a3f19da560e5.18334738.jpg', 'mou', 'internasional', 'PM\r\nBP');
INSERT INTO `perusahaan` VALUES (4, 'Google', 'Mountain View', '0', 'Google LLC adalah sebuah perusahaan multinasional Amerika Serikat yang berkekhususan pada jasa dan produk Internet. Produk-produk tersebut meliputi teknologi pencarian, komputasi web, perangkat lunak, dan periklanan daring. Sebagian besar labanya berasal dari AdWords.', '444', 'google@gmail.com', NULL, 'perusahaan_68a3f269af6520.34290154.jpg', 'perseroan', 'internasional', 'RPL\r\nRPL\r\nRPL\r\nRPL');
INSERT INTO `perusahaan` VALUES (6, 'BBPPMPVOE BOE', 'Arjosari', 'Malang', 'alai Besar Pengembangan Penjaminan Mutu Pendidikan Vokasi Bidang Otomotif dan Elektronika (BBPPMPV BOE) merupakan Unit Pelaksana Teknis (UPT) di lingkungan Direktorat Jenderal Pendidikan Vokasi (Ditjen Pendidikan Vokasi), Kementerian Pendidikan dan Kebudayaan yang pendiriannya mengacu pada Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor: 26 tahun 2020 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Kementerian Pendidikan dan Kebudayaan.', '555', 'bbppmpvoe@gmail.com', NULL, 'perusahaan_68a4211dabe057.10614909.jpg', 'perseroan', 'nasional', 'RPL\r\nTKJ');

-- ----------------------------
-- Table structure for survey
-- ----------------------------
DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey`  (
  `id_survey` int NOT NULL AUTO_INCREMENT,
  `id_alumni` int NULL DEFAULT NULL,
  `pilihan_survey` enum('bekerja','wirausaha','menganggur','magang','kuliah') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kritiksaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tgl_dibuat` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_survey`) USING BTREE,
  INDEX `id_alumni`(`id_alumni` ASC) USING BTREE,
  CONSTRAINT `alumni_survey` FOREIGN KEY (`id_alumni`) REFERENCES `alumni` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of survey
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','management','siswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'om', '$2y$10$wIDtUOkHy.ymr2VPiyZGHul/O4GKJo00xbJd7jId1cBC9MDfMamQG', 'admin');
INSERT INTO `users` VALUES (2, 'em', 'em', 'siswa');
INSERT INTO `users` VALUES (3, 'am', 'am', 'management');

SET FOREIGN_KEY_CHECKS = 1;
