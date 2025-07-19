<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$sql = "SELECT pd.id, ps.nama AS pasien, d.nama AS dokter, pl.nama AS poliklinik, pd.tanggal, pd.keluhan
        FROM pendaftaran pd
        JOIN pasien ps ON pd.pasien_id = ps.id
        JOIN dokter d ON pd.dokter_id = d.id
        JOIN poliklinik pl ON pd.poliklinik_id = pl.id
        ORDER BY pd.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Data Pendaftaran</h2>
            <div>
                <a href="pendaftaran_tambah.php" class="btn btn-primary">Tambah Pendaftaran</a>
                <a href="index.php" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Poliklinik</th>
                                <th>Tanggal</th>
                                <th>Keluhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['pasien']; ?></td>
                                    <td><?= $row['dokter']; ?></td>
                                    <td><?= $row['poliklinik']; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['keluhan']; ?></td>
                                    <td>
                                        <a href="pendaftaran_edit.php?id=<?= $row['id']; ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="pendaftaran_hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>