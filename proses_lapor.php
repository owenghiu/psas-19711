<?php
require_once 'koneksi.php';

// Handle the new action for updating item status to "ditemukan"
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'set_found') {
    $id = $_GET['id'];

    // Update the item status to 'ditemukan'
    $query = "UPDATE barang SET status = 'ditemukan' WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the same item detail page
        header("Location: detail.php?id=" . $id . "&message=updated");
        exit();
    } else {
        echo "Error: Could not update item status. " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $kontak = $_POST['kontak'];
    $status = $_POST['status'];

    // Handle file upload
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["foto"]["name"];
        $filetype = $_FILES["foto"]["type"];
        $filesize = $_FILES["foto"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            die("Error: Please select a valid file format.");
        }

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            die("Error: File size is larger than the allowed limit.");
        }

        // Check if the file can be uploaded - check whether file type is valid
        if (in_array($filetype, $allowed)) {
            // Define upload path
            $upload_path = "uploads/" . basename($_FILES["foto"]["name"]);

            // Move file to uploads folder
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $upload_path)) {
                $foto = basename($_FILES["foto"]["name"]);
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Error: Invalid file format.";
        }
    }

    // Insert data into database
    $query = "INSERT INTO barang (nama, foto, lokasi, tanggal, deskripsi, kontak, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $nama, $foto, $lokasi, $tanggal, $deskripsi, $kontak, $status);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to success page or back to home
        header("Location: index.php?message=success");
        exit();
    } else {
        echo "Error: Could not execute query. " . mysqli_error($koneksi);
    }

    mysqli_stmt_close($stmt);
} else {
    // If not POST method and not the new action, redirect to report form
    header("Location: laporan_hilang.php");
    exit();
}
?>