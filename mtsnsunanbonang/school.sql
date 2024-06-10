-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.1.0-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for school
CREATE DATABASE IF NOT EXISTS `school` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `school`;

-- Dumping structure for table school.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.akun: ~11 rows (approximately)
DELETE FROM `akun`;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` (`username`, `password`, `level`) VALUES
	('abdulghani', '31c06adce05e5834bdbdf8f7b50e1d01', 1),
	('admin', 'c4ca4238a0b923820dcc509a6f75849b', 3),
	('admin1', 'payakumbuh123', 1),
	('dadang', 'c4ca4238a0b923820dcc509a6f75849b', 3),
	('hendika', 'c4ca4238a0b923820dcc509a6f75849b', 2),
	('Kirito', 'c4ca4238a0b923820dcc509a6f75849b', 1),
	('Naruto', 'c4ca4238a0b923820dcc509a6f75849b', 3),
	('Okky', 'c4ca4238a0b923820dcc509a6f75849b', 3),
	('pakghani', '31c06adce05e5834bdbdf8f7b50e1d01', 2),
	('roma', 'c4ca4238a0b923820dcc509a6f75849b', 1),
	('udin', 'c4ca4238a0b923820dcc509a6f75849b', 3);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;

-- Dumping structure for table school.guru
CREATE TABLE IF NOT EXISTS `guru` (
  `nip` char(10) NOT NULL,
  `nama_guru` varchar(50) DEFAULT NULL,
  `no_hp` varchar(30) NOT NULL,
  `jenkel` varchar(10) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `guru_ibfk_1` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.guru: ~4 rows (approximately)
DELETE FROM `guru`;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` (`nip`, `nama_guru`, `no_hp`, `jenkel`, `agama`, `username`) VALUES
	('1111111111', 'Hendika', '087987697658', 'Laki-Laki', 'Islam', 'hendika'),
	('1111111112', 'Roma Debrian', '087987697659', 'Laki-Laki', 'Islam', 'roma'),
	('1111111113', 'Okky', '02147483647', 'Laki-Laki', 'Islam', 'Okky'),
	('2006051101', 'Abdul Ghani, S.Kom', '089508438446', 'Laki-Laki', 'Islam', 'pakghani');
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;

-- Dumping structure for table school.mata_pelajaran
CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `kode_mata_pelajaran` varchar(50) NOT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL,
  `kelas` int(2) NOT NULL,
  `jurusan` varchar(3) NOT NULL,
  `nip` char(10) DEFAULT NULL,
  PRIMARY KEY (`kode_mata_pelajaran`),
  KEY `mata_pelajaran_ibfk_1` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.mata_pelajaran: ~5 rows (approximately)
DELETE FROM `mata_pelajaran`;
/*!40000 ALTER TABLE `mata_pelajaran` DISABLE KEYS */;
INSERT INTO `mata_pelajaran` (`kode_mata_pelajaran`, `nama_matapelajaran`, `kelas`, `jurusan`, `nip`) VALUES
	('021', 'Matematika', 11, '', '2006051101'),
	('022', 'Matematika', 10, '', '2006051101'),
	('11111111', 'Jaringan', 10, 'RPL', '1111111111'),
	('231231241234', 'C++', 10, 'RPL', '1111111111'),
	('4123124125', 'Visual Basic 1', 10, 'RPL', '1111111112'),
	('51231231123', 'Pemerograman Java', 10, 'RPL', '1111111111'),
	('51231235', 'Bisnis', 11, 'AP', '1111111113');
/*!40000 ALTER TABLE `mata_pelajaran` ENABLE KEYS */;

-- Dumping structure for table school.murid
CREATE TABLE IF NOT EXISTS `murid` (
  `nisn` char(10) NOT NULL,
  `nama_murid` varchar(50) DEFAULT NULL,
  `kota` varchar(45) DEFAULT NULL,
  `jenkel` varchar(45) DEFAULT NULL,
  `agama` varchar(45) DEFAULT NULL,
  `jurusan` varchar(3) DEFAULT NULL,
  `kelas` int(2) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nisn`),
  KEY `murid_ibfk_1` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.murid: ~14 rows (approximately)
DELETE FROM `murid`;
/*!40000 ALTER TABLE `murid` DISABLE KEYS */;
INSERT INTO `murid` (`nisn`, `nama_murid`, `kota`, `jenkel`, `agama`, `jurusan`, `kelas`, `username`) VALUES
	('1111111111', 'Udin', 'Jakarta', 'Laki-Laki', 'Islam', 'RPL', 10, 'udin'),
	('1111111119', 'Kanna Kamui', 'Tokyo', 'Perempuan', 'Hindu', 'AP', 11, NULL),
	('1234123215', 'Yasan', 'Banjarmasin', 'Laki-Laki', 'Islam', 'RPL', 10, NULL),
	('1256734563', 'Jaki', 'Bekasi', 'Laki-Laki', 'islam', 'PRL', 12, NULL),
	('15232131', 'Uzumaki Kusina', 'Konoha', 'Perempuan', 'Islam', 'AP', 11, NULL),
	('2006051101', 'joko tingkir', 'Malang', 'Laki-Laki', 'Islam', '', 10, 'Okky'),
	('3432423429', 'Hendika', 'Bekasi', 'Laki-Laki', 'Islam', 'RPL', 10, NULL),
	('3563345195', 'Jaja Tamanawa', 'Jambi', 'Laki-Laki', 'islam', 'RPL', 10, NULL),
	('3563345199', 'Najwa', 'Medan', 'Perempuan', 'islam', 'AK', 11, NULL),
	('5555554323', 'Sasa', 'Maria', 'Perempuan', 'Islam', 'AP', 12, NULL),
	('6475834759', 'Culain', 'Mataram', 'Laki-Laki', 'Hindu', 'RPL', 12, NULL),
	('6666666666', 'Hana', 'Jakarta', 'Perempuan', 'Islam', 'AP', 11, NULL),
	('8378449283', 'Uzumaki Naruto', 'Konoha', 'Laki-Laki', 'Islam', 'RPL', 11, NULL),
	('8798679869', 'Okky Pras', 'Banten', 'Laki-Laki', 'Islam', 'RPL', 10, 'Okky');
/*!40000 ALTER TABLE `murid` ENABLE KEYS */;

-- Dumping structure for table school.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `nama_murid` varchar(50) NOT NULL,
  `kelas` varchar(2) DEFAULT NULL,
  `jurusan` varchar(3) DEFAULT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL,
  `nilai_UTS` int(5) NOT NULL,
  `nilai_UAS` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.nilai: ~26 rows (approximately)
DELETE FROM `nilai`;
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
INSERT INTO `nilai` (`nama_murid`, `kelas`, `jurusan`, `nama_matapelajaran`, `nilai_UTS`, `nilai_UAS`) VALUES
	('Yasan', '10', 'RPL', 'Jaringan', 100, 100),
	('wdawd', '10', 'RPL', 'Jaringan', 77, 88),
	('Hendika', '10', 'RPL', 'Jaringan', 100, 100),
	('Jaja Tamanawa', '10', 'RPL', 'Jaringan', 110, 111),
	('Yasan', '10', 'RPL', 'Visual Basic', 77, 77),
	('wdawd', '10', 'RPL', 'Visual Basic', 88, 88),
	('Hendika', '10', 'RPL', 'Visual Basic', 100, 99),
	('Jaja Tamanawa', '10', 'RPL', 'Visual Basic', 100, 100),
	('Udin', '10', 'RPL', 'Jaringan', 77, 88),
	('Yasan', '10', 'RPL', 'Jaringan', 100, 100),
	('Hendika', '10', 'RPL', 'Jaringan', 100, 100),
	('Jaja Tamanawa', '10', 'RPL', 'Jaringan', 110, 111),
	('Udin', '10', 'RPL', 'Visual Basic', 88, 88),
	('Yasan', '10', 'RPL', 'Visual Basic', 77, 77),
	('Hendika', '10', 'RPL', 'Visual Basic', 100, 99),
	('Jaja Tamanawa', '10', 'RPL', 'Visual Basic', 100, 100),
	('Udin', '10', 'RPL', 'C++', 77, 87),
	('Yasan', '10', 'RPL', 'C++', 66, 87),
	('Hendika', '10', 'RPL', 'C++', 88, 88),
	('Jaja Tamanawa', '10', 'RPL', 'C++', 99, 89),
	('Okky Pras', '10', 'RPL', 'C++', 89, 90),
	('Udin', '10', 'RPL', 'Pemerograman Java', 77, 88),
	('Yasan', '10', 'RPL', 'Pemerograman Java', 88, 99),
	('Hendika', '10', 'RPL', 'Pemerograman Java', 99, 99),
	('Jaja Tamanawa', '10', 'RPL', 'Pemerograman Java', 77, 88),
	('Okky Pras', '10', 'RPL', 'Pemerograman Java', 98, 87);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;

-- Dumping structure for table school.pesan
CREATE TABLE IF NOT EXISTS `pesan` (
  `Tanggal` varchar(10) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `No_HP` int(50) DEFAULT NULL,
  `Isi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table school.pesan: ~2 rows (approximately)
DELETE FROM `pesan`;
/*!40000 ALTER TABLE `pesan` DISABLE KEYS */;
INSERT INTO `pesan` (`Tanggal`, `Subject`, `Nama`, `Email`, `No_HP`, `Isi`) VALUES
	('18-05-2018', 'Test', 'Roma Debrian', 'test@yahoo.com', 2147483647, 'This messege of ded'),
	('18-05-2018', 'Test', 'Roma Debrian', 'test@yahoo.com', 2147483647, 'ini adalah pesan kematian');
/*!40000 ALTER TABLE `pesan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
