<?php
require_once 'koneksi.php';

// Get item ID from URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get item details
    $query = "SELECT * FROM barang WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $item = mysqli_fetch_assoc($result);
    
    if(!$item) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - FindMySchoolStuff</title>
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

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container">
            <div class="detail-card">
                <div class="detail-image">
                    <img src="uploads/<?php echo htmlspecialchars($item['foto'] ? $item['foto'] : 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>">
                </div>
                
                <div class="detail-info">
                    <?php if (isset($_GET['message']) && $_GET['message'] == 'updated'): ?>
                    <div class="alert alert-success">
                        Status barang telah diperbarui menjadi ditemukan!
                    </div>
                    <?php endif; ?>

                    <h2><?php echo htmlspecialchars($item['nama']); ?></h2>

                    <div class="detail-item">
                        <strong>Deskripsi & Ciri-ciri:</strong>
                        <p><?php echo htmlspecialchars($item['deskripsi'] ? $item['deskripsi'] : 'Tidak ada deskripsi'); ?></p>
                    </div>

                    <div class="detail-item">
                        <strong>Lokasi <?php echo $item['status'] == 'hilang' ? 'Hilang' : 'Ditemukan'; ?>:</strong>
                        <p><?php echo htmlspecialchars($item['lokasi']); ?></p>
                    </div>

                    <div class="detail-item">
                        <strong>Tanggal <?php echo $item['status'] == 'hilang' ? 'Hilang' : 'Ditemukan'; ?>:</strong>
                        <p><?php echo date('d M Y', strtotime($item['tanggal'])); ?></p>
                    </div>

                    <div class="detail-item">
                        <strong>Status Barang:</strong>
                        <span class="status <?php echo $item['status']; ?>"><?php echo ucfirst($item['status']); ?></span>
                    </div>

                    <div class="detail-item">
                        <strong>Kontak Pelapor:</strong>
                        <p><?php echo htmlspecialchars($item['kontak']); ?></p>
                    </div>

                    <div class="detail-actions">
                        <?php if($item['status'] == 'ditemukan'): ?>
                        <a href="mailto:<?php echo htmlspecialchars($item['kontak']); ?>" class="btn btn-claim">Klaim Barang</a>
                        <?php endif; ?>
                        <?php if($item['status'] == 'hilang'): ?>
                        <a href="proses_lapor.php?id=<?php echo $item['id']; ?>&action=set_found" class="btn btn-success">Tandai Barang Ditemukan</a>
                        <?php endif; ?>
                    </div>
                </div>
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