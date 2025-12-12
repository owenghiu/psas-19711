<?php
require_once 'koneksi.php';

// Get latest lost items
$query_hilang = "SELECT * FROM barang WHERE status = 'hilang' ORDER BY created_at DESC LIMIT 6";
$result_hilang = mysqli_query($koneksi, $query_hilang);

// Get latest found items
$query_ditemukan = "SELECT * FROM barang WHERE status = 'ditemukan' ORDER BY created_at DESC LIMIT 6";
$result_ditemukan = mysqli_query($koneksi, $query_ditemukan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindMySchoolStuff - Temukan Barang Hilangmu</title>
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

    <!-- Banner -->
    <section class="banner">
        <div class="container">
            <div class="banner-content">
                <h2>Temukan Barang Hilangmu</h2>
                <p>Platform pencarian barang hilang di lingkungan sekolah</p>
                <div class="banner-buttons">
                    <a href="cari.php" class="btn btn-primary">Cari Barang Hilang</a>
                    <a href="laporan_hilang.php" class="btn btn-secondary">Laporkan Barang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Lost Items -->
    <section class="latest-items">
        <div class="container">
            <h2>Barang Hilang Terbaru</h2>
            <div class="items-grid">
                <?php if(mysqli_num_rows($result_hilang) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result_hilang)): ?>
                    <div class="item-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['foto'] ? $row['foto'] : 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>">
                        <div class="item-info">
                            <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                            <p>Lokasi: <?php echo htmlspecialchars($row['lokasi']); ?></p>
                            <p>Tanggal: <?php echo date('d M Y', strtotime($row['tanggal'])); ?></p>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Belum ada barang hilang terbaru</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Latest Found Items -->
    <section class="latest-items">
        <div class="container">
            <h2>Barang Ditemukan Terbaru</h2>
            <div class="items-grid">
                <?php if(mysqli_num_rows($result_ditemukan) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result_ditemukan)): ?>
                    <div class="item-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['foto'] ? $row['foto'] : 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>">
                        <div class="item-info">
                            <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                            <p>Lokasi: <?php echo htmlspecialchars($row['lokasi']); ?></p>
                            <p>Tanggal: <?php echo date('d M Y', strtotime($row['tanggal'])); ?></p>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Belum ada barang ditemukan terbaru</p>
                <?php endif; ?>
            </div>
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