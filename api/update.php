<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Ambil gambar lama
    $old = $conn->query("SELECT gambar FROM lukisan WHERE id=$id")->fetch_assoc();
    $gambar = $old['gambar'];

    // Jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "upload/";
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        // Hapus gambar lama
        if (!empty($old['gambar']) && file_exists("upload/".$old['gambar'])) {
            unlink("upload/".$old['gambar']);
        }
    }

    $sql = "UPDATE lukisan SET judul='$judul', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";

    if ($conn->query($sql)) {
        echo json_encode(["message" => "Lukisan berhasil diupdate"]);
    } else {
        echo json_encode(["message" => "Gagal: " . $conn->error]);
    }
}
?>
