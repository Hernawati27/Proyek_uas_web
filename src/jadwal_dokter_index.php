<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$sql = "SELECT jd.id, d.nama AS dokter, jd.hari, jd.jam_mulai, jd.jam_selesai
        FROM jadwal_dokter jd
        JOIN dokter d ON jd.dokter_id = d.id
        ORDER BY jd.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Jadwal Dokter</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Jadwal Dokter</h2>
            <div>
                <a href="jadwal_dokter_tambah.php" class="btn btn-primary">Tambah Jadwal</a>
                <a href="index.php" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['dokter']); ?></td>
                            <td><?= htmlspecialchars($row['hari']); ?></td>
                            <td><?= htmlspecialchars($row['jam_mulai']); ?></td>
                            <td><?= htmlspecialchars($row['jam_selesai']); ?></td>
                            <td>
                                <a href="jadwal_dokter_edit.php?id=<?= $row['id']; ?>"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <a href="jadwal_dokter_hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>