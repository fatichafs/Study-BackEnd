<?php
include '../api/config.php';

$judulLama = $_GET['judul'];
$data = $conn->query("SELECT * FROM lukisan WHERE judul='$judulLama'")->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judulBaru = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $data['gambar'];

    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../api/upload/";
        $gambarBaru = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambarBaru;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        if (!empty($data['gambar']) && file_exists("../api/upload/".$data['gambar'])) {
            unlink("../api/upload/".$data['gambar']);
        }
        $gambar = $gambarBaru;
    }

    $conn->query("UPDATE lukisan 
                  SET judul='$judulBaru', deskripsi='$deskripsi', gambar='$gambar' 
                  WHERE judul='$judulLama'");

    header("Location: tambah.php?pesan=edit");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Lukisan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 { text-align: center; color: #333; }
        label { font-weight: bold; }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        img {
            display: block;
            margin-bottom: 10px;
            border-radius: 4px;
            max-width: 150px;
        }
        button, .btn {
            padding: 8px 14px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-kembali { background: #555; }
        button:hover, .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Lukisan</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Judul:</label>
            <input type="text" name="judul" value="<?= $data['judul'] ?>" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="4" required><?= $data['deskripsi'] ?></textarea>

            <label>Gambar Saat Ini:</label>
            <?php if (!empty($data['gambar'])): ?>
                <img src="../api/upload/<?= $data['gambar'] ?>">
            <?php else: ?>
                <p><i>Tidak ada gambar</i></p>
            <?php endif; ?>

            <label>Ganti Gambar:</label>
            <input type="file" name="gambar">

            <button type="submit">✏️ Update Lukisan</button>
        </form>
        <br>
        <a href="tambah.php" class="btn btn-kembali">⬅️ Kembali</a>
    </div>
</body>
</html>
