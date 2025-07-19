<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$pendaftaran = $conn->query("SELECT * FROM pendaftaran WHERE id=$id")->fetch_assoc();
$pasien = $conn->query("SELECT * FROM pasien");
$dokter = $conn->query("SELECT * FROM dokter");
$poliklinik = $conn->query("SELECT * FROM poliklinik");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $poliklinik_id = $_POST['poliklinik_id'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    $conn->query("UPDATE pendaftaran SET pasien_id='$pasien_id', dokter_id='$dokter_id',
                  poliklinik_id='$poliklinik_id', tanggal='$tanggal', keluhan='$keluhan'
                  WHERE id=$id");
    header("Location: pendaftaran_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Pendaftaran</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pasien</label>
                        <select name="pasien_id" class="form-select" required>
                            <?php while ($p = $pasien->fetch_assoc()): ?>
                                <option value="<?= $p['id']; ?>" <?= $pendaftaran['pasien_id'] == $p['id'] ? 'selected' : ''; ?>>
                                    <?= $p['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dokter</label>
                        <select name="dokter_id" class="form-select" required>
                            <?php while ($d = $dokter->fetch_assoc()): ?>
                                <option value="<?= $d['id']; ?>" <?= $pendaftaran['dokter_id'] == $d['id'] ? 'selected' : ''; ?>>
                                    <?= $d['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poliklinik</label>
                        <select name="poliklinik_id" class="form-select" required>
                            <?php while ($pl = $poliklinik->fetch_assoc()): ?>
                                <option value="<?= $pl['id']; ?>" <?= $pendaftaran['poliklinik_id'] == $pl['id'] ? 'selected' : ''; ?>>
                                    <?= $pl['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $pendaftaran['tanggal']; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keluhan</label>
                        <textarea name="keluhan" class="form-control"
                            rows="3"><?= $pendaftaran['keluhan']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="pendaftaran_index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>