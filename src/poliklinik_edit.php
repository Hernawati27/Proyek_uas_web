<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$poli = $conn->query("SELECT * FROM poliklinik WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_poli = $_POST['nama_poli'];
    $deskripsi = $_POST['deskripsi'];

    $conn->query("UPDATE poliklinik SET nama_poli='$nama_poli', deskripsi='$deskripsi' WHERE id=$id");
    header("Location: poliklinik_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Poliklinik</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_poli" class="form-label">Nama Poli</label>
                        <input type="text" name="nama_poli" id="nama_poli" class="form-control"
                            value="<?= htmlspecialchars($poli['nama_poli']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"
                            rows="4"><?= htmlspecialchars($poli['deskripsi']); ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="poliklinik_index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>