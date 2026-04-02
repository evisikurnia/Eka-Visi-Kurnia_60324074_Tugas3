<?php
// Data Anggota
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5;

// Aturan
$max_pinjaman = 3;
$denda_per_hari = 1000;
$max_denda = 50000;

// Hitung denda
$total_denda = 0;
if ($buku_terlambat > 0) {
    $total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;
    if ($total_denda > $max_denda) {
        $total_denda = $max_denda;
    }
}

// Status peminjaman
if ($buku_terlambat > 0) {
    $status = "Tidak Bisa Pinjam";
    $badge = "danger";
    $icon = "x-circle";
    $pesan = "Masih ada buku yang terlambat";
} elseif ($total_pinjaman >= $max_pinjaman) {
    $status = "Limit Tercapai";
    $badge = "warning";
    $icon = "exclamation-triangle";
    $pesan = "Sudah mencapai batas maksimal peminjaman";
} else {
    $status = "Boleh Pinjam";
    $badge = "success";
    $icon = "check-circle";
    $pesan = "Silakan meminjam buku";
}

// Level member (SWITCH)
switch (true) {
    case ($total_pinjaman <= 5):
        $level = "Bronze";
        break;
    case ($total_pinjaman <= 15):
        $level = "Silver";
        break;
    default:
        $level = "Gold";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">
        <i class="bi bi-person-circle"></i> Status Peminjaman Anggota
    </h2>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= $nama_anggota; ?></h5>
        </div>

        <div class="card-body">
            <div class="row">
                
                <!-- Info -->
                <div class="col-md-8">
                    <p><strong>Total Pinjaman:</strong> <?= $total_pinjaman; ?></p>
                    <p><strong>Buku Terlambat:</strong> <?= $buku_terlambat; ?></p>
                    <p><strong>Hari Terlambat:</strong> <?= $hari_keterlambatan; ?> hari</p>
                    <p><strong>Level Member:</strong> 
                        <span class="badge bg-secondary"><?= $level; ?></span>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-<?= $badge; ?>">
                            <i class="bi bi-<?= $icon; ?>"></i> <?= $status; ?>
                        </span>
                    </p>

                    <p class="text-muted"><em><?= $pesan; ?></em></p>

                    <?php if ($buku_terlambat > 0): ?>
                        <div class="alert alert-danger">
                            <strong>Denda:</strong> Rp <?= number_format($total_denda, 0, ',', '.'); ?><br>
                            ⚠ Harap segera mengembalikan buku!
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tombol -->
                <div class="col-md-4 text-end">
                    <?php if ($buku_terlambat == 0 && $total_pinjaman < $max_pinjaman): ?>
                        <button class="btn btn-success">
                            <i class="bi bi-book"></i> Pinjam Buku
                        </button>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-lock"></i> Tidak Bisa Pinjam
                        </button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>