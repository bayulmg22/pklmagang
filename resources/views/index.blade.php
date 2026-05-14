
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Magang Digital - Kab. Lamongan</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fbff; }
        .navbar { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .hero-section { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white; padding: 60px 0; border-radius: 0 0 50px 50px; margin-bottom: -50px; }
        .card-custom { border: none; border-radius: 20px; transition: all 0.3s ease; }
        .card-custom:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
        .search-box { border-radius: 15px; padding: 12px 20px; border: 2px solid #eef2f7; }
        .action-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 15px; font-size: 1.5rem; margin-bottom: 15px; }
        .status-badge { padding: 8px 16px; border-radius: 50px; font-weight: 600; font-size: 0.8rem; }
        .logo-navbar { height: 40px; margin-right: 10px; }
        .logo-hero { height: 80px; margin-bottom: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm px-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="index.php">
            <!-- Menambahkan Logo di Navbar -->
            <img src="logo.png" alt="Logo Lamongan" class="logo-navbar"> 
            <span>MAGANG</span>
        </a>
        <a href="admin_login.php" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold"><i class="bi bi-person-lock me-1"></i> Admin</a>
    </div>
</nav>

<div class="hero-section text-center">
    <div class="container">
        <!-- Menambahkan Logo di Hero Section -->
        <img src="logo.png" alt="Logo Lamongan" class="logo-hero">
        <h1 class="fw-bold display-5">DINAS SOSIAL</h1>
        <p class="lead opacity-75">Kabupaten Lamongan</p>
    </div>
</div>

<div class="container mt-5 pt-4">
    <div class="row g-4 justify-content-center">
        
        <!-- Sisi Kiri: Pendaftaran -->
        <div class="col-lg-4">
            <div class="card card-custom shadow-sm p-4 h-100 bg-white border-0 text-center">
                <h5 class="fw-bold mb-3">Pendaftaran Baru</h5>
                <img src="https://illustrations.popsy.co/blue/work-from-home.svg" alt="work" class="img-fluid mb-4" style="max-height: 150px;">
                <a href="daftar.php" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm mt-auto">Mulai Daftar <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>

        <!-- Sisi Kanan: Cek Status -->
        <div class="col-lg-7">
            <div class="card card-custom shadow-sm p-4 bg-white mb-4 border-0">
                <h5 class="fw-bold mb-4"><i class="bi bi-search me-2"></i>Cek Status & Akses Fitur</h5>
                <form method="GET" class="row g-2">
                    <div class="col-8 col-md-9">
                        <input type="text" name="nim" class="form-control search-box" placeholder="Masukkan NIM kamu..." value="<?= @$_GET['nim'] ?>" required>
                    </div>
                    <div class="col-4 col-md-3">
                        <button class="btn btn-dark w-100 py-3 rounded-pill fw-bold">Cek</button>
                    </div>
                </form>

                <?php 
                if(isset($_GET['nim'])):
                    $nim = mysqli_real_escape_string($conn, $_GET['nim']);
                    $res = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
                    $m = mysqli_fetch_assoc($res);
                    
                    if($m): ?>
                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h6 class="text-muted mb-1">Peserta:</h6>
                                    <h5 class="fw-bold mb-0 text-uppercase"><?= $m['nama'] ?></h5>
                                </div>
                                <?php if($m['status'] == 'pending'): ?>
                                    <span class="status-badge bg-warning text-dark">PENDING</span>
                                <?php elseif($m['status'] == 'aktif'): ?>
                                    <span class="status-badge bg-success text-white">AKTIF</span>
                                <?php else: ?>
                                    <span class="status-badge bg-primary text-white">SELESAI</span>
                                <?php endif; ?>
                            </div>

                            <?php if($m['status'] == 'pending'): ?>
                                <div class="alert alert-light border-warning text-center py-4 rounded-4">
                                    <p class="mb-0 fw-bold">Pendaftaranmu sedang ditinjau Admin.</p>
                                </div>

                            <?php elseif($m['status'] == 'selesai'): ?>
                                <div class="alert alert-primary text-center py-4 rounded-4 shadow-sm border-0">
                                    <i class="bi bi-trophy-fill display-5 mb-3 d-block"></i>
                                    <p class="mb-0 fw-bold fs-5">Selamat! Magang Kamu Telah Selesai.</p>
                                    <p class="small text-muted mb-3">Silakan lihat hasil penilaian kamu di bawah ini:</p>
                                    <a href="lihat_nilai.php?id=<?= $m['id'] ?>&ref=user" class="btn btn-primary px-5 py-2 rounded-pill fw-bold">Lihat Nilai Akhir</a>
                                </div>

                            <?php else: ?>
                                <div class="row g-3">
                                    <div class="col-md-4 text-center">
                                        <a href="cetak_card.php?id=<?= $m['id'] ?>" class="text-decoration-none">
                                            <div class="card card-custom border shadow-sm p-3 bg-light">
                                                <div class="action-icon bg-primary text-white mx-auto shadow"><i class="bi bi-person-badge"></i></div>
                                                <h6 class="fw-bold text-dark mb-0">ID Card</h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="absensi.php?id=<?= $m['id'] ?>" class="text-decoration-none">
                                            <div class="card card-custom border shadow-sm p-3 bg-light">
                                                <div class="action-icon bg-success text-white mx-auto shadow"><i class="bi bi-qr-code-scan"></i></div>
                                                <h6 class="fw-bold text-dark mb-0">Absensi</h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="jurnal.php?id=<?= $m['id'] ?>" class="text-decoration-none">
                                            <div class="card card-custom border shadow-sm p-3 bg-light">
                                                <div class="action-icon bg-info text-white mx-auto shadow"><i class="bi bi-journal-check"></i></div>
                                                <h6 class="fw-bold text-dark mb-0">Jurnal</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger mt-4"><i class="bi bi-exclamation-octagon me-2"></i>NIM Tidak Terdaftar.</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<footer class="text-center mt-5 pb-4 text-muted small">
    <p>&copy; <?= date('Y') ?> Portal Magang Digital Kab. Lamongan.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>