<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "bimbingan";

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    echo json_encode(["eror" => "Koneksi Gagal: ". $conn->connect_error]);
    exit;
}

$sql = "SELECT nidn, nama, email, no_telp FROM dosen_pembimbing";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query gagal: " . $conn->error]);
    exit;
}

$dosen = [];
while ($row = $result->fetch_assoc()) {
    $dosen[] = $row;
}

if (empty($dosen)) {
    echo json_encode(["message" => "Data tidak ditemukan"]);
} else {
    echo json_encode($dosen, JSON_PRETTY_PRINT);
}

$conn->close();
?>