<?php
require_once 'koneksi.php';

// Get search parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Build query based on filters
$query = "SELECT * FROM barang WHERE 1=1";
$params = array();

if (!empty($search)) {
    $query .= " AND nama LIKE ?";
    $params[] = "%$search%";
}

if (!empty($category)) {
    $query .= " AND status = ?";
    $params[] = $category;
}

if (!empty($location)) {
    $query .= " AND lokasi LIKE ?";
    $params[] = "%$location%";
}

if (!empty($date)) {
    $query .= " AND tanggal = ?";
    $params[] = $date;
}

$query .= " ORDER BY created_at DESC";

$stmt = mysqli_prepare($koneksi, $query);

// Bind parameters
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Barang - FindMySchoolStuff</title>
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

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <h2>Cari Barang</h2>
            <form method="GET" action="cari.php" class="search-form">
                <div class="search-inputs">
                    <input type="text" name="search" placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($search); ?>">
                    
                    <select name="category">
                        <option value="">Semua Kategori</option>
                        <option value="hilang" <?php echo ($category == 'hilang') ? 'selected' : ''; ?>>Barang Hilang</option>
                        <option value="ditemukan" <?php echo ($category == 'ditemukan') ? 'selected' : ''; ?>>Barang Ditemukan</option>
                    </select>
                    
                    <input type="text" name="location" placeholder="Lokasi..." value="<?php echo htmlspecialchars($location); ?>">
                    
                    <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
                    
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Search Results -->
    <section class="results-section">
        <div class="container">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <h3>Hasil Pencarian</h3>
                <div class="items-grid">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="item-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['foto'] ? $row['foto'] : 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>">
                        <div class="item-info">
                            <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                            <p>Lokasi: <?php echo htmlspecialchars($row['lokasi']); ?></p>
                            <p>Tanggal: <?php echo date('d M Y', strtotime($row['tanggal'])); ?></p>
                            <span class="status <?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></span>
                            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="no-results">Tidak ditemukan barang yang sesuai dengan kriteria pencarian.</p>
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