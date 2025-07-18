<?php
include 'config.php';

$result = $conn->query("SELECT * FROM lukisan ORDER BY id DESC");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
