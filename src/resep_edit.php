<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$resep = $conn->query("SELECT * FROM resep WHERE id=$id")->fetch_assoc();

$rekam_medis = $conn->query("SELECT rm.id, p.nama FROM rekam_medis rm JOIN pasien p ON rm.pasien_id = p.id");
$obat = $conn->query("SELECT * FROM obat");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rekam_medis_id = $_POST['rekam_medis_id'];
    $obat_id = $_POST['obat_id'];
    $dosis = $_POST['dosis'];
    $jumlah = $_POST['jumlah'];

    $conn->query("UPDATE resep SET rekam_medis_id='$rekam_medis_id', obat_id='$obat_id',
                  dosis='$dosis', jumlah='$jumlah' WHERE id=$id");
    header("Location: resep_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Resep</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="rekam_medis_id" class="form-label">Rekam Medis (Pasien)</label>
                        <select name="rekam_medis_id" id="rekam_medis_id" class="form-select" required>
                            <?php while ($rm = $rekam_medis->fetch_assoc()): ?>
                                <option value="<?= $rm['id']; ?>" <?= $resep['rekam_medis_id'] == $rm['id'] ? 'selected' : ''; ?>>
                                    #<?= $rm['id']; ?> - <?= htmlspecialchars($rm['nama']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="obat_id" class="form-label">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-select" required>
                            <?php while ($o = $obat->fetch_assoc()): ?>
                                <option value="<?= $o['id']; ?>" <?= $resep['obat_id'] == $o['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($o['nama_obat']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dosis" class="form-label">Dosis</label>
                        <input type="text" name="dosis" id="dosis" class="form-control"
                            value="<?= htmlspecialchars($resep['dosis']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control"
                            value="<?= $resep['jumlah']; ?>">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="resep_index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>