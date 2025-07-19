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
    $poli_id = $_POST['poli_id'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tanggal_periksa = $_POST['tanggal_periksa'];

    $conn->query("INSERT INTO rekam_medis (pasien_id, dokter_id, poli_id, keluhan, diagnosa, tanggal_periksa)
                  VALUES ('$pasien_id', '$dokter_id', '$poli_id', '$keluhan', '$diagnosa', '$tanggal_periksa')");
    header("Location: rekam_medis_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Tambah Rekam Medis</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">Pasien</label>
                        <select name="pasien_id" id="pasien_id" class="form-select" required>
                            <?php while ($p = $pasien->fetch_assoc()): ?>
                                <option value="<?= $p['id']; ?>"><?= htmlspecialchars($p['nama']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dokter_id" class="form-label">Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="form-select" required>
                            <?php while ($d = $dokter->fetch_assoc()): ?>
                                <option value="<?= $d['id']; ?>"><?= htmlspecialchars($d['nama']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="poli_id" class="form-label">Poliklinik</label>
                        <select name="poli_id" id="poli_id" class="form-select" required>
                            <?php while ($pl = $poliklinik->fetch_assoc()): ?>
                                <option value="<?= $pl['id']; ?>"><?= htmlspecialchars($pl['nama_poli']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                        <input type="date" name="tanggal_periksa" id="tanggal_periksa" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="rekam_medis_index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>