<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$dokter = $conn->query("SELECT * FROM dokter WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $no_hp = $_POST['no_hp'];

    $conn->query("UPDATE dokter SET nama='$nama', spesialis='$spesialis', no_hp='$no_hp' WHERE id=$id");
    header("Location: dokter_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Data Dokter</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" name="nama" class="form-control"
                            value="<?= htmlspecialchars($dokter['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialis</label>
                        <input type="text" name="spesialis" class="form-control"
                            value="<?= htmlspecialchars($dokter['spesialis']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="<?= htmlspecialchars($dokter['no_hp']); ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="dokter_index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>