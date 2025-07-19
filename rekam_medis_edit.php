<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$rekam = $conn->query("SELECT * FROM rekam_medis WHERE id=$id")->fetch_assoc();

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

    $conn->query("UPDATE rekam_medis SET pasien_id='$pasien_id', dokter_id='$dokter_id',
                  poli_id='$poli_id', keluhan='$keluhan', diagnosa='$diagnosa',
                  tanggal_periksa='$tanggal_periksa' WHERE id=$id");
    header("Location: rekam_medis_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Rekam Medis</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">Pasien</label>
                        <select name="pasien_id" id="pasien_id" class="form-select" required>
                            <?php while ($p = $pasien->fetch_assoc()): ?>
                                <option value="<?= $p['id']; ?>" <?= $rekam['pasien_id'] == $p['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($p['nama']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dokter_id" class="form-label">Dokter</label>
                        <select name="dokter_id" id="dokter_id" class="form-select" required>
                            <?php while ($d = $dokter->fetch_assoc()): ?>
                                <option value="<?= $d['id']; ?>" <?= $rekam['dokter_id'] == $d['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($d['nama']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="poli_id" class="form-label">Poliklinik</label>
                        <select name="poli_id" id="poli_id" class="form-select" required>
                            <?php while ($pl = $poliklinik->fetch_assoc()): ?>
                                <option value="<?= $pl['id']; ?>" <?= $rekam['poli_id'] == $pl['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($pl['nama_poli']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" class="form-control"
                            rows="3"><?= htmlspecialchars($rekam['keluhan']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control"
                            rows="3"><?= htmlspecialchars($rekam['diagnosa']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                        <input type="date" name="tanggal_periksa" id="tanggal_periksa" class="form-control"
                            value="<?= $rekam['tanggal_periksa']; ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="rekam_medis_index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>