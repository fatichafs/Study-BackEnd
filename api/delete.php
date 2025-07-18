<?php 
include 'config.php';

$judul = $_GET['judul']; // sekarang pakai judul

// Ambil nama file gambar berdasarkan judul
$old = $conn->query("SELECT gambar FROM lukisan WHERE judul='$judul'")->fetch_assoc();

// Hapus file gambar
if (!empty($old['gambar']) && file_exists("upload/".$old['gambar'])) {
    unlink("upload/".$old['gambar']);
}

// Hapus data berdasarkan judul
$conn->query("DELETE FROM lukisan WHERE judul='$judul'");

// Redirect ke tambah.php dengan notifikasi
header("Location: ../web/tambah.php?pesan=hapus");
exit();
?>
