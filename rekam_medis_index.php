<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$sql = "SELECT rm.id, p.nama AS pasien, d.nama AS dokter, pl.nama_poli AS poli, rm.keluhan, rm.diagnosa, rm.tanggal_periksa
        FROM rekam_medis rm
        JOIN pasien p ON rm.pasien_id = p.id
        JOIN dokter d ON rm.dokter_id = d.id
        JOIN poliklinik pl ON rm.poli_id = pl.id
        ORDER BY rm.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Rekam Medis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Rekam Medis</h2>
            <div>
                <a href="rekam_medis_tambah.php" class="btn btn-primary">Tambah Rekam Medis</a>
                <a href="index.php" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Poliklinik</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Tanggal Periksa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['pasien']); ?></td>
                            <td><?= htmlspecialchars($row['dokter']); ?></td>
                            <td><?= htmlspecialchars($row['poli']); ?></td>
                            <td><?= htmlspecialchars($row['keluhan']); ?></td>
                            <td><?= htmlspecialchars($row['diagnosa']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_periksa']); ?></td>
                            <td>
                                <a href="rekam_medis_edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="rekam_medis_hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>