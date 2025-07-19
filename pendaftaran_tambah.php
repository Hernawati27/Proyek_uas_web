<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$pasien = $conn->query("SELECT * FROM pasien");
$dokter = $conn->query("SELECT * FROM dokter");
$poliklinik = $conn->query("SELECT * FROM poliklinik");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $poliklinik_id = $_POST['poliklinik_id'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    $conn->query("INSERT INTO pendaftaran (pasien_id, dokter_id, poliklinik_id, tanggal, keluhan)
                  VALUES ('$pasien_id', '$dokter_id', '$poliklinik_id', '$tanggal', '$keluhan')");
    header("Location: pendaftaran_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Pendaftaran</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="pasien" class="form-label">Pasien</label>
                        <select name="pasien_id" id="pasien" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Pasien --</option>
                            <?php while ($p = $pasien->fetch_assoc()): ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dokter" class="form-label">Dokter</label>
                        <select name="dokter_id" id="dokter" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Dokter --</option>
                            <?php while ($d = $dokter->fetch_assoc()): ?>
                                <option value="<?= $d['id']; ?>"><?= $d['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="poliklinik" class="form-label">Poliklinik</label>
                        <select name="poliklinik_id" id="poliklinik" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Poliklinik --</option>
                            <?php while ($pl = $poliklinik->fetch_assoc()): ?>
                                <option value="<?= $pl['id']; ?>"><?= $pl['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="pendaftaran_index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>