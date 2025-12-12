<?php
require_once 'koneksi.php';

// Get all found items
$query = "SELECT * FROM barang WHERE status = 'ditemukan' ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Ditemukan - FindMySchoolStuff</title>
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

    <!-- Found Items Section -->
    <section class="found-items-section">
        <div class="container">
            <h2>Barang Ditemukan</h2>
            <p>Daftar barang-barang yang telah ditemukan oleh siswa atau guru</p>
            
            <?php if(mysqli_num_rows($result) > 0): ?>
                <div class="items-grid">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="item-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['foto'] ? $row['foto'] : 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>">
                        <div class="item-info">
                            <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                            <p>Lokasi ditemukan: <?php echo htmlspecialchars($row['lokasi']); ?></p>
                            <p>Tanggal ditemukan: <?php echo date('d M Y', strtotime($row['tanggal'])); ?></p>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm">Lihat Detail</a>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-claim">Saya pemilik barang ini</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="no-results">Belum ada barang yang dilaporkan ditemukan.</p>
            <?php endif; ?>
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