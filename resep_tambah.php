<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$rekam_medis = $conn->query("SELECT rm.id, p.nama FROM rekam_medis rm JOIN pasien p ON rm.pasien_id = p.id");
$obat = $conn->query("SELECT * FROM obat");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rekam_medis_id = $_POST['rekam_medis_id'];
    $obat_id = $_POST['obat_id'];
    $dosis = $_POST['dosis'];
    $jumlah = $_POST['jumlah'];

    $conn->query("INSERT INTO resep (rekam_medis_id, obat_id, dosis, jumlah)
                  VALUES ('$rekam_medis_id', '$obat_id', '$dosis', '$jumlah')");
    header("Location: resep_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Resep</title></head>
<body>
<h1>Tambah Resep</h1>
<form method="POST">
    Rekam Medis (Pasien):
    <select name="rekam_medis_id" required>
        <?php while($rm = $rekam_medis->fetch_assoc()): ?>
        <option value="<?= $rm['id']; ?>">#<?= $rm['id']; ?> - <?= $rm['nama']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    Obat:
    <select name="obat_id" required>
        <?php while($o = $obat->fetch_assoc()): ?>
        <option value="<?= $o['id']; ?>"><?= $o['nama_obat']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    Dosis: <input type="text" name="dosis"><br><br>
    Jumlah: <input type="number" name="jumlah" value="1"><br><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>
