<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "pincela"; // ganti sesuai database kamu

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
