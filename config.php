<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rekam_medis";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
