<?php
include "config.php";
session_start();
if (!isset($_SESSION['user']))
    header("Location: login.php");

$id = $_GET['id'];
$jadwal = $conn->query("SELECT * FROM jadwal_dokter WHERE id=$id")->fetch_assoc();
$dokter = $conn->query("SELECT * FROM dokter");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokter_id = $_POST['dokter_id'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $conn->query("UPDATE jadwal_dokter SET dokter_id='$dokter_id', hari='$hari',
                  jam_mulai='$jam_mulai', jam_selesai='$jam_selesai' WHERE id=$id");
    header("Location: jadwal_dokter_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Jadwal Dokter</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Dokter</label>
                        <select name="dokter_id" class="form-select" required>
                            <?php while ($d = $dokter->fetch_assoc()): ?>
                                <option value="<?= $d['id']; ?>" <?= $jadwal['dokter_id'] == $d['id'] ? 'selected' : ''; ?>>
                                    <?= $d['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" required>
                            <?php
                            $hariList = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
                            foreach ($hariList as $h): ?>
                                <option value="<?= $h; ?>" <?= $jadwal['hari'] == $h ? 'selected' : ''; ?>><?= $h; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" value="<?= $jadwal['jam_mulai']; ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control"
                            value="<?= $jadwal['jam_selesai']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="jadwal_dokter_index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>