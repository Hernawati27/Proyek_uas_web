<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Dashboard</h2>
            <p class="text-muted">Selamat Datang, <span
                    class="fw-semibold text-primary"><?= htmlspecialchars($user['username']); ?></span>!</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Item Menu -->
            <div class="col-md-4 col-sm-6">
                <a href="pasien_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-person-vcard fs-1 text-primary"></i>
                            <h5 class="mt-3">Data Pasien</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6">
                <a href="dokter_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-person-badge fs-1 text-success"></i>
                            <h5 class="mt-3">Data Dokter</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6">
                <a href="poliklinik_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-hospital fs-1 text-danger"></i>
                            <h5 class="mt-3">Poliklinik</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6">
                <a href="obat_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-capsule fs-1 text-warning"></i>
                            <h5 class="mt-3">Obat</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6">
                <a href="rekam_medis_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-medical fs-1 text-info"></i>
                            <h5 class="mt-3">Rekam Medis</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6">
                <a href="pembayaran_index.php" class="text-decoration-none">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi bi-cash-coin fs-1 text-secondary"></i>
                            <h5 class="mt-3">Pembayaran</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="logout.php" class="btn btn-outline-danger px-4">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>