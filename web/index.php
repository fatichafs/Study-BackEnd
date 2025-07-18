<?php
include '../api/config.php';
$result = $conn->query("SELECT * FROM lukisan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Lukisan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .btn {
            padding: 6px 12px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-tambah { background: #4CAF50; }
        .btn-edit { background: #2196F3; }
        .btn-hapus { background: #f44336; }
        .btn-kembali { background: #555; }
        .btn:hover { opacity: 0.8; }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        img {
            border-radius: 4px;
        }
        .notif {
            font-weight: bold;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .notif-hapus { background: #fdd; color: #a00; }
        .notif-edit { background: #ddf; color: #004; }
        .notif-tambah { background: #dfd; color: #040; }
        /* Pencarian */
        .search-box {
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .search-box input {
            padding: 6px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-box button {
            padding: 6px 10px;
            background: #555;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-box button:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎨 Daftar Lukisan</h1>

        <!-- Notifikasi -->
        <?php if (isset($_GET['pesan'])): ?>
            <?php if ($_GET['pesan'] == 'hapus'): ?>
                <div class="notif notif-hapus">❌ Lukisan berhasil dihapus!</div>
            <?php elseif ($_GET['pesan'] == 'edit'): ?>
                <div class="notif notif-edit">✏️ Lukisan berhasil diperbarui!</div>
            <?php elseif ($_GET['pesan'] == 'tambah'): ?>
                <div class="notif notif-tambah">✅ Lukisan berhasil ditambahkan!</div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Tombol Tambah dan Refresh -->
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Lukisan</a>
        <a href="index.php" class="btn btn-kembali">🔄 Refresh</a>

        <!-- Tabel -->
        <table>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
            <?php $no=1; while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><b><?= htmlspecialchars($row['judul']) ?></b></td>
                <td><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></td>
                <td>
                    <?php if (!empty($row['gambar'])): ?>
                        <img src="../api/upload/<?= $row['gambar'] ?>" width="100">
                    <?php else: ?>
                        <i>Tidak ada gambar</i>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?judul=<?= urlencode($row['judul']) ?>" class="btn btn-edit">Edit</a>
                    <a href="../api/delete.php?judul=<?= urlencode($row['judul']) ?>" 
                       class="btn btn-hapus"
                       onclick="return confirm('Yakin hapus lukisan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
