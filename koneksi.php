<?php
// Database configuration
$host = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password is empty
$database = "aurel_db";

// Create connection to MySQL server (without database)
$koneksi = mysqli_connect($host, $username, $password);

// Check connection to server
if (!$koneksi) {
    die("Koneksi ke server gagal: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$create_db_query = "CREATE DATABASE IF NOT EXISTS `$database`";
if (mysqli_query($koneksi, $create_db_query)) {
    // Select the database
    mysqli_select_db($koneksi, $database);
    // Set charset to utf8
    mysqli_set_charset($koneksi, "utf8");

    // Create the barang table if it doesn't exist
    $table_query = "CREATE TABLE IF NOT EXISTS `barang` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    if (!mysqli_query($koneksi, $table_query)) {
        die("Error creating table: " . mysqli_error($koneksi));
    }
} else {
    die("Error creating database: " . mysqli_error($koneksi));
}

// Reconnect with the database selected for use in the application
$koneksi = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset to utf8
mysqli_set_charset($koneksi, "utf8");
?>