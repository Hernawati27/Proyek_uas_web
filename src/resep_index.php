<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$sql = "SELECT r.id, rm.id AS rekam_id, p.nama AS pasien, o.nama_obat, r.dosis, r.jumlah
        FROM resep r
        JOIN rekam_medis rm ON r.rekam_medis_id = rm.id
        JOIN pasien p ON rm.pasien_id = p.id
        JOIN obat o ON r.obat_id = o.id
        ORDER BY r.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Resep</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Resep</h2>
            <div>
                <a href="resep_tambah.php" class="btn btn-primary">Tambah Resep</a>
                <a href="index.php" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Obat</th>
                        <th>Dosis</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['pasien']); ?></td>
                            <td><?= htmlspecialchars($row['nama_obat']); ?></td>
                            <td><?= htmlspecialchars($row['dosis']); ?></td>
                            <td><?= htmlspecialchars($row['jumlah']); ?></td>
                            <td>
                                <a href="resep_edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="resep_hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>