<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_poli = $_POST['nama_poli'];
    $deskripsi = $_POST['deskripsi'];

    $conn->query("INSERT INTO poliklinik (nama_poli, deskripsi)
                  VALUES ('$nama_poli', '$deskripsi')");
    header("Location: poliklinik_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Poliklinik</title></head>
<body>
<h1>Tambah Poliklinik</h1>
<form method="POST">
    Nama Poli: <input type="text" name="nama_poli" required><br><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>
