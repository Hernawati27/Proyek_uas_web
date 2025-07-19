<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$pembayaran = $conn->query("SELECT * FROM pembayaran WHERE id=$id")->fetch_assoc();
$rekam_medis = $conn->query("SELECT rm.id, p.nama FROM rekam_medis rm JOIN pasien p ON rm.pasien_id = p.id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rekam_medis_id = $_POST['rekam_medis_id'];
    $total = $_POST['total'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $status = $_POST['status'];

    $conn->query("UPDATE pembayaran SET rekam_medis_id='$rekam_medis_id', total='$total',
                  tanggal_bayar='$tanggal_bayar', status='$status' WHERE id=$id");
    header("Location: pembayaran_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Pembayaran</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Rekam Medis (Pasien)</label>
                        <select name="rekam_medis_id" class="form-select" required>
                            <?php while ($rm = $rekam_medis->fetch_assoc()): ?>
                                <option value="<?= $rm['id']; ?>" <?= $pembayaran['rekam_medis_id'] == $rm['id'] ? 'selected' : ''; ?>>
                                    #<?= $rm['id']; ?> - <?= $rm['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <input type="number" name="total" class="form-control" value="<?= $pembayaran['total']; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="form-control"
                            value="<?= $pembayaran['tanggal_bayar']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Lunas" <?= $pembayaran['status'] == 'Lunas' ? 'selected' : ''; ?>>Lunas</option>
                            <option value="Belum Lunas" <?= $pembayaran['status'] == 'Belum Lunas' ? 'selected' : ''; ?>>
                                Belum Lunas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="pembayaran_index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>