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

 Date: 21/08/2025 10:24:26
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
INSERT INTO `berita` VALUES (12, 'MESSI', '2025-08-30', 0x3131, 'Rosario', 'Lionel; Messi adalah seorang pemain sepak bole yang kini membela klub Inter Miami. Ia adalah legenda hidup Barcelona yang masih bermain hingga sekarang. Memenangkan berbagai tropy bergengsi bersama klub dan juga timnas Argentina. Pencapaian dia pantas untuk disebut \"The Greatest of All Times\" hingga mendapatkan 8 Baloon D\'or yang menjadi pemain pertama yang mempunyai Baloon D\'or sebanyak itu.\r\ncihuyyy', 'kegiatan_68a56d8ac5d501.75489548.jpg');
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
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lowker
-- ----------------------------
INSERT INTO `lowker` VALUES (15, 7, 'BACK END DEVELOPER (PHP/Laravel)', 'const companyContainer = document.querySelector(\'.company-container\');\r\nconst companyControlsContainer = document.querySelector(\'.company-controls\');\r\nconst companyControls = [\'previous\', \'next\'];\r\nconst companyItems = document.querySelectorAll(\'.company-item\');\r\n\r\nclass Carousel {\r\n    constructor(container, items, controls) {\r\n        this.carouselContainer = container;\r\n        this.carouselControls = controls;\r\n        this.carouselArray = [...items];\r\n        this.isTransitioning = false;\r\n        this.controlButtons = [];\r\n        this.autoPlayInterval = null;\r\n    }\r\n\r\n    updateCompany() {\r\n        this.carouselArray.forEach((el, index) => {\r\n            const detailElement = el.querySelector(\'.company-detail\');\r\n\r\n            if (detailElement && index !== 2) {', '', 'Rp 100-200 juta', 'Diploma D1/D2/D3, Sarjana S1, SMA/SMK', 'Full time, remote (work from anywhere)', '2025-08-30', '2025-08-19', 'HTML\r\nCSS\r\nJAVASCRIPT\r\nPYTHON\r\nPASCAL\r\nC++', 'Rabu - Jumat. 07:30 - 12:00', 'Mempunyai semangat muda\r\njujur\r\namanah\r\nrajin', 'uang makan\r\nuang minum\r\nuang transportasi', 6, 'Malang', NULL);
INSERT INTO `lowker` VALUES (16, 2, 'Junior 2D Animator', 'Membuat animasi karakter 2D untuk serial animasi edukasi dan hiburan.', '', 'Rp4.500.000 – Rp6.000.000', 'Minimal D3/S1 Desain Komunikasi Visual atau Animasi', 'Full-time', '2025-08-21', '2025-08-20', 'Adobe Animate\r\nToon Boom Harmony\r\nkreativitas storytelling', 'Senin–Jumat (09.00–17.00)', 'Fresh graduate dipersilakan melamar mampu bekerja dalam tim\r\ndetail oriented.', 'BPJS Kesehatan\r\nBPJS Ketenagakerjaan\r\nuang makan\r\nbonus project.', 9, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (17, 2, '3D Animator', 'Membuat animasi 3D untuk film pendek, iklan, dan game.', '', 'Rp5.000.000 – Rp7.500.000', 'Minimal S1 Animasi / Multimedia / Seni Rupa', 'Full-time', '2025-08-31', '2025-08-20', 'Blender\r\nMaya\r\n3Ds Max\r\nprinsip animasi (timing, squash & stretch).', 'Senin–Sabtu (08.00–16.00)', 'Memiliki portofolio animasi 3D\r\nterbiasa bekerja dengan deadline komunikatif.', 'Transportasi\r\nmakan siang\r\nbonus tahunan', 8, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (18, 2, 'Motion Graphic Designer', 'Mendesain motion graphic untuk kebutuhan iklan digital, media sosial, dan presentasi perusahaan.', '', 'Rp4.000.000 – Rp6.500.000', 'Minimal D3 Desain Grafis / Multimedia', 'Full-time / Hybrid', '2025-09-30', '2025-08-20', 'Adobe After Effects\r\nIllustrator\r\nPhotoshop', 'Senin–Jumat (09.00–18.00)', 'Berpengalaman minimal 1 tahun\r\nkreatif\r\nmampu bekerja mandiri.', 'Asuransi kesehatan\r\nuang transport\r\nbonus per proyek.', 14, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (19, 2, 'Storyboard Artist', 'Membuat storyboard untuk proyek animasi dan iklan, bekerja sama dengan sutradara animasi.', '', 'Rp4.200.000 – Rp6.000.000', 'SMA/SMK Seni Rupa / D3/S1 Animasi', 'Kontrak 1 tahun', '2025-10-15', '2025-08-20', 'Menggambar manual & digital\r\nsinematografi dasar\r\nstorytelling visual.', 'Senin–Jumat (09.00–17.00)', 'Kreatif\r\nmemahami layout scene\r\nmampu menyampaikan ide secara visual.', 'Uang makan\r\ntransportasi\r\ninsentif project', 2, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (20, 2, 'Character Designer', 'Mendesain karakter unik untuk animasi 2D & 3D, mulai dari sketsa hingga final design.', '', 'Rp4.800.000 – Rp6.800.000', 'Minimal D3/S1 Desain Komunikasi Visual / Seni Rupa', 'Full-time', '2025-09-23', '2025-08-20', 'Photoshop\r\nClip Studio Paint\r\nProcreate\r\nkreativitas desain karakter.', 'Senin–Jumat (09.00–17.00)', 'Berpengalaman minimal 1 tahun\r\nkreatif\r\nmampu berkolaborasi dengan tim animator', 'BPJS Kesehatan\r\nbonus kinerja\r\nuang transport.', 15, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (21, 2, 'Visual Effects (VFX) Artist', 'Membuat efek visual untuk film, iklan, dan video musik (misalnya ledakan, hujan, magic effect).', '', 'Rp6.000.000 – Rp9.000.000', 'Minimal S1 Animasi / Film / Multimedia', 'Full-time', '2025-08-27', '2025-08-20', 'After Effects\r\nNuke, Houdini\r\ncompositing\r\ncolor grading.', 'Senin–Sabtu (08.00–17.00)', 'Pengalaman min. 2 tahun di bidang VFX,\r\nmampu bekerja dengan deadline ketat.', 'Bonus project,\r\nasuransi kesehatan,\r\nuang makan & transport.', 16, 'Tokyo', NULL);
INSERT INTO `lowker` VALUES (22, 2, 'Layout Artist', 'Menentukan tata letak kamera, pencahayaan, dan lingkungan untuk adegan animasi.', '', 'Rp4.500.000 – Rp6.500.000', 'D3/S1 Animasi, Multimedia, atau Seni Rupa', 'Kontrak / Freelance', '2025-08-22', '2025-08-20', 'Maya/Blender,\r\nsinematografi,\r\nperspektif gambar,\r\nlighting.', 'Fleksibel (berdasarkan deadline proyek)', 'Memiliki portofolio layout scene,\r\nmampu bekerja mandiri maupun tim.', 'Bonus per proyek,\r\nfleksibilitas kerja remote,\r\ninsentif target.', 13, 'Tokyo', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------
INSERT INTO `perusahaan` VALUES (1, 'Microsoft', 'Redmond', 'Washingtomn', 'Microsoft Corporation adalah perusahaan multinasional Amerika Serikat yang berpusat di Redmond, Washington, Amerika Serikat yang mengembangkan, membuat, memberi lisensi, dan mendukung berbagai produk dan jasa terkait dengan komputer. Perusahaan ini didirikan oleh Bill Gates dan Paul Allen pada tanggal 4 April 1975. Microsoft merupakan pembuat perangkat lunak terbesar di dunia menurut pendapatannya.Microsoft juga merupakan salah satu perusahaan paling bernilai di dunia', '111', 'microsoft@gmail.com', NULL, 'perusahaan_68a3ee4d852219.20238592.png', 'perseroan', 'internasional', 'RPLD\r\nDKV\r\nANM');
INSERT INTO `perusahaan` VALUES (2, 'A-1 Pictures', 'Suginami', 'Tokyo', 'A-1 Pictures Inc. adalah sebuah studio animasi Jepang yang didirikan oleh Mikihiro Iwata seorang mantan produser dari Sunrise, A-1 Pictures dioperasikan dan dimiliki sepenuhnya oleh Aniplex anak perusahaan dari Sony Music Entertainment Japan.', '222', 'a1pictures@gmail.com', NULL, 'perusahaan_68a3f12600b531.71771867.png', 'umkm', 'internasional', 'ANIMASI');
INSERT INTO `perusahaan` VALUES (3, 'Hybe Insight', 'Yongsan Trade Center Co., Ltd.', 'Seoul', '\"안녕하세요. HYBE INSIGHT입니다. HYBE INSIGHT는 \"WE BELIEVE IN MUSIC\"이라는 하이브의 미션 아래, \'음악으로 감동을 전하고 선한 영향력을 나누며 삶의 변화를 만들어간다\'라는 지향점이 녹아있는 HYBE의 전시 브랜드입니다. HYBE INSIGHT는 2023년 1월 15일(일)을 마지막으로 하이브 용산 사옥에서의 운영을 종료하고 임시 휴업함을 알려드립니다. 그동안 보내주신 여러분의 성원에 감사드리며 새로운 공간에서 보다 발전된 모습으로 찾아뵙겠습니다. HYBE INSIGHT와 관련된 새로운 소식은 공식 트위터와 홈페이지를 통해 확인 가능합니다. 감사합니다.\"', '333', 'hybe@gmail.com', NULL, 'perusahaan_68a3f19da560e5.18334738.jpg', 'mou', 'internasional', 'PM\r\nBP');
INSERT INTO `perusahaan` VALUES (4, 'Google', 'Mountain View', '0', 'Google LLC adalah sebuah perusahaan multinasional Amerika Serikat yang berkekhususan pada jasa dan produk Internet. Produk-produk tersebut meliputi teknologi pencarian, komputasi web, perangkat lunak, dan periklanan daring. Sebagian besar labanya berasal dari AdWords.', '444', 'google@gmail.com', NULL, 'perusahaan_68a3f269af6520.34290154.jpg', 'perseroan', 'internasional', 'RPL\r\nRPL\r\nRPL\r\nRPL');
INSERT INTO `perusahaan` VALUES (6, 'BBPPMPVOE BOE', 'Arjosari', 'Malang', 'alai Besar Pengembangan Penjaminan Mutu Pendidikan Vokasi Bidang Otomotif dan Elektronika (BBPPMPV BOE) merupakan Unit Pelaksana Teknis (UPT) di lingkungan Direktorat Jenderal Pendidikan Vokasi (Ditjen Pendidikan Vokasi), Kementerian Pendidikan dan Kebudayaan yang pendiriannya mengacu pada Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor: 26 tahun 2020 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Kementerian Pendidikan dan Kebudayaan.', '555', 'bbppmpvoe@gmail.com', NULL, 'perusahaan_68a4211dabe057.10614909.jpg', 'perseroan', 'nasional', 'RPL\r\nTKJ');
INSERT INTO `perusahaan` VALUES (8, 'CloverWorks', 'Umezato, Suginami', 'Tokyo', 'CloverWorks Inc. (Jepang: 株式会社クローバーワークス, Hepburn: Kabushiki-gaisha Kurōbā Wākusu) adalah sebuah Studio animasi Jepang yang diubah dari Studio Kōenji milik A-1 Pictures, CloverWorks dioperasikan dan dimiliki oleh Aniplex, anak perusahaan dari Sony Music Entertainment Japan.', '666', 'cloverworks@gmail.com', NULL, 'perusahaan_68a56b00d3db31.42754976.jpg', 'perseroan', 'internasional', 'Rascal Does Not Dream of a Knapsack Kid\r\nSpy X  Family\r\nHorimiya');
INSERT INTO `perusahaan` VALUES (9, 'MAPPA', 'Tokyo', 'Tokyo', 'MAPPA Co., Ltd. (Jepang: 株式会社MAPPA, Hepburn: Kabushiki-gaisha Mappa) adalah sebuah studio animasi asal Jepang yang didirikan pada tahun 2011 oleh Masao Maruyama, pendiri dan mantan produser Madhouse.[1][2]', '777', 'mappa@gmail.com', NULL, 'perusahaan_68a56b5f8d8ee2.56834818.jpg', 'umkm', 'nasional', 'Jujutsu Kaisen\r\nLazarus\r\nAOT');
INSERT INTO `perusahaan` VALUES (11, 'Ufotable', 'Nakano', 'Tokyo', 'Ufotable, Inc. (Jepang: ユーフォーテーブル有限会社, Hepburn: Yūfōtēburu yūgen-gaisha) adalah studio animasi Jepang yang didirikan pada Oktober 2000 oleh mantan staf TMS Entertainment melalui anak perusahaannya Telecom Animation Film dan berlokasi di Nakano, Prefektur Tokyo. Ciri khas yang terlihat pada banyak karya mereka adalah animasi tanah liat.', '888', 'ufotable@gmail.com', NULL, 'perusahaan_68a56f42ddaa80.85530374.png', 'mou', 'nasional', 'Demon Slayer\r\nFate/Zero');
INSERT INTO `perusahaan` VALUES (12, 'SILVER LINK', 'Mitaka', 'Tokyo', 'SILVER LINK., Inc. (Jepang: 株式会社シルバーリンク, Hepburn: Kabushiki gaisha Shirubā Rinku) adalah studio animasi Jepang. Didirikan oleh produser animasi Hayato Kaneko pada Desember 2007 dan bertempat di Tokyo. Mayoritas produksi solo Silver Link telah disutradarai oleh Shin Ōnuma, yang sebelumnya adalah asisten sutradara bersama Akiyuki Shinbo di Shaft.', '999', 'silverlink@gmail.com', NULL, 'perusahaan_68a56fb0c5da15.53357583.jpg', 'startup', 'internasional', 'Maou Gakuin no Futekigousha: Shijou Saikyou no Maou no Shiso, Tensei shite Shison-tachi no Gakkou e Kayou');
INSERT INTO `perusahaan` VALUES (13, 'Sunrise', 'Suginami', 'Tokyo', 'Sunrise Inc. (Jepang: 株式会社サンライズ, Hepburn: Kabushiki gaisha Sanraizu) adalah Merek usaha (Label) anime dari Bandai Namco Filmworks, studio animasi Jepang yang didirikan pada September 1972 dan berbasis di Suginami, Tokyo. Nama sebelumnya adalah Nippon Sunrise dan Sunrise Studio', '101', 'sunrise@gmail.com', NULL, 'perusahaan_68a57176f36d32.02167707.jpg', 'perseroan', 'internasional', 'Code Geass');
INSERT INTO `perusahaan` VALUES (14, 'Kyoto Animation', 'Uji', 'Kyoto', 'Kyoto Animation Co., Ltd. (株式会社京都アニメーション, Kabushiki-gaisha Kyōto Animēshon), disingkat menjadi KyoAni (京アニ), adalah sebuah studio animasi Jepang sekaligus penerbit novel ringan yang berpusat di Uji, Prefektur Kyoto, Jepang. Perusahaan ini didirikan pada tahun 1981 oleh mantan staf Mushi Pro. Dipimpin oleh Hideaki Hatta, perusahaan ini juga berafiliasi dengan studio Animation Do. Hingga tahun 2015, Kyoto Animation telah memimpin produksi untuk 21 seri anime dan beberapa film. Para juru animasi dari Kyoto Animation merupakan pekerja yang digaji, alih-alih juru animasi paruh waktu yang dibayar per bingkai (frame). Dengan demikian, para juru animasi Kyoto Animation lebih mampu untuk fokus pada kualitas dari masing-masing bingkai daripada kuantitas bingkai yang mereka produksi', '102', 'kyotoani@gmail.com', NULL, 'perusahaan_68a5720c62d419.18815165.jpg', 'umkm', 'lokal', 'Violet Evergarden\r\nHyouka\r\nKoe no Katachi');
INSERT INTO `perusahaan` VALUES (15, 'Studio Ghibli', 'Koganei', 'Tokyo', 'Studio Ghibli, Inc. (Jepang: 株式会社スタジオジブリ, Hepburn: Kabushiki-gaisha Sutajio Jiburi)[3] adalah studio animasi Jepang yang berbasis di Koganei, Tokyo.[4] Perusahaan ini memiliki kehadiran yang kuat dalam industri animasi dan telah memperluas portofolionya untuk mencakup berbagai media seperti subjek pendek, iklan televisi dan dua film televisi. Karya mereka diterima dengan baik oleh penonton dan diakui dengan berbagai penghargaan. Maskot dan simbol mereka yang paling dikenal, karakter Totoro dari film tahun 1988 My Neighbor Totoro, adalah roh raksasa yang terinspirasi oleh anjing rakun (tanuki) dan kucing (neko).[5] Di antara film terlaris studio tersebut adalah Princess Mononoke (1997), Spirited Away (2001), Howl\'s Moving Castle (2004), Ponyo (2008), and The Boy and the Heron (2023).[6] Studio Ghibli didirikan pada tanggal 15 Juni 1985, oleh sutradara Hayao Miyazaki dan Isao Takahata dan produser Toshio Suzuki, setelah mengakuisisi aset Topcraft.', '103', 'ghibli@gmail.com', NULL, 'perusahaan_68a572fcb931d0.88872761.jpg', 'startup', 'provinsi', 'Howl\'s Moving Castle');
INSERT INTO `perusahaan` VALUES (16, 'CoMix Wave Films', 'Chiyoda', 'Tokyo', 'CoMix Wave Films, Inc. adalah studio film dan perusahaan distribusi film animasi Jepang yang terletak di Chiyoda, Tokyo, Jepang. Studio ini dikenal akan film tuturan, film pendek, dan iklan televisi berbentuk animenya, terutama yang dibuat oleh sutradara Makoto Shinkai.', '104', 'comixwave@gmail.com', NULL, 'perusahaan_68a573acdbd353.67910419.jpg', 'startup', 'nasional', 'Weathering with You\r\nYour Name.');

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
