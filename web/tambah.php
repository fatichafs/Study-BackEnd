<?php
include '../api/config.php';

$pesan = "";

// Proses tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = '';

    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../api/upload/";
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    $conn->query("INSERT INTO lukisan (judul, deskripsi, gambar) 
                  VALUES ('$judul', '$deskripsi', '$gambar')");
    $pesan = "✅ Lukisan berhasil ditambahkan!";
}

// Ambil semua data lukisan untuk ditampilkan di tabel
$result = $conn->query("SELECT * FROM lukisan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Lukisan</title>
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
        .notif {
            background: #dfd; color: #040;
            font-weight: bold; padding: 8px;
            border-radius: 4px; margin-bottom: 10px;
            text-align: center;
        }
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
        button, .btn {
            padding: 8px 14px;
            background: #4CAF50;
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
        <h1>Tambah Lukisan</h1>

        <!-- Notifikasi -->
        <?php if ($pesan): ?>
            <div class="notif"><?= $pesan ?></div>
        <?php endif; ?>

        <!-- Form tambah -->
        <form method="POST" enctype="multipart/form-data">
            <label>Judul:</label>
            <input type="text" name="judul" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="4" required></textarea>

            <label>Gambar:</label>
            <input type="file" name="gambar" required>

            <button type="submit">✅ Simpan Lukisan</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-kembali">⬅️ Kembali ke Daftar Lukisan</a>
    </div>
</body>
</html>
