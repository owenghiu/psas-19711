-- Database: findurbarang
CREATE DATABASE IF NOT EXISTS findurbarang;
USE findurbarang;

-- Table structure for table `barang`
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kontak` varchar(255) NOT NULL,
  `status` enum('hilang','ditemukan') NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data for testing
INSERT INTO `barang` (`nama`, `foto`, `lokasi`, `tanggal`, `deskripsi`, `kontak`, `status`) VALUES
('Buku Matematika', 'buku_matematika.jpg', 'Ruang Kelas 3A', '2025-11-15', 'Buku pelajaran warna biru dengan nama Roni ditulis di sampul', 'roni@email.com', 'hilang'),
('Dompet Coklat', 'dompet.jpg', 'Kantin Sekolah', '2025-11-18', 'Dompet kulit coklat dengan logo sekolah, berisi KTP', 'susi@email.com', 'hilang'),
('Jaket Sekolah', 'jaket.jpg', 'Lapangan Basket', '2025-11-10', 'Jaket warna biru dengan lambang sekolah di dada', 'andi@email.com', 'hilang'),
('Pensil Warna', 'pensil_warna.jpg', 'Ruang Seni', '2025-11-20', 'Kotak pensil warna Faber-Castell, 24 warna', 'dina@email.com', 'ditemukan'),
('Kacamata', 'kacamata.jpg', 'Perpustakaan', '2025-11-12', 'Kacamata minus frame hitam tipis', 'budi@email.com', 'ditemukan'),
('Tas Ransel', 'tas.jpg', 'Ruang Musik', '2025-11-05', 'Tas ransel hitam dengan logo musik di samping', 'joko@email.com', 'ditemukan');