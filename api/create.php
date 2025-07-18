<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    
    // Upload Gambar
    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "upload/";
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO lukisan (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')";
    
    if ($conn->query($sql)) {
        echo json_encode(["message" => "Lukisan berhasil ditambahkan"]);
    } else {
        echo json_encode(["message" => "Gagal: " . $conn->error]);
    }
}
?>
