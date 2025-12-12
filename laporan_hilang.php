<?php
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporkan Barang Hilang - FindMySchoolStuff</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <h1>FindMySchoolStuff</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="cari.php">Cari Barang</a></li>
                    <li><a href="laporan_hilang.php">Laporkan</a></li>
                    <li><a href="barang_ditemukan.php">Barang Ditemukan</a></li>
                </ul>
            </nav>
            <div class="mobile-menu">
                <span>☰</span>
            </div>
        </div>
    </header>

    <!-- Report Form -->
    <section class="form-section">
        <div class="container">
            <h2>Laporkan Barang Hilang</h2>
            <form action="proses_lapor.php" method="POST" enctype="multipart/form-data" class="report-form">
                <div class="form-group">
                    <label for="nama">Nama Barang *</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="foto">Foto Barang</label>
                    <input type="file" id="foto" name="foto" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label for="lokasi">Lokasi Terakhir Terlihat *</label>
                    <input type="text" id="lokasi" name="lokasi" required>
                </div>
                
                <div class="form-group">
                    <label for="tanggal">Tanggal Hilang *</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi">Deskripsi & Ciri-ciri Barang</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan ciri-ciri barang, warna, merk, atau hal lain yang bisa membantu mengidentifikasi barang ini"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="kontak">Kontak Anda *</label>
                    <input type="text" id="kontak" name="kontak" placeholder="Email atau nomor telepon" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status Barang</label>
                    <select id="status" name="status">
                        <option value="hilang">Hilang</option>
                        <option value="ditemukan">Ditemukan</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 FindMySchoolStuff. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>