<?php
session_start();

// Koneksi ke database
require_once 'koneksi.php';

// Ambil semua perusahaan (tanpa filter)
$sql = "SELECT id, nama, deskripsi, alamat FROM tbl_perusahaan ORDER BY nama";
$result = $con->query($sql);
$perusahaan_list = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Cek apakah user sudah login
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Perusahaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-hover:hover { box-shadow: 0 6px 12px rgba(0,0,0,0.15); transform: translateY(-2px); }
  </style>
</head>
<body class="bg-light">

<!-- Navbar (opsional, tapi bagus untuk UTS) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">🏢 LOKER 19 juta pekerjaan</a>
    <div class="navbar-nav ms-auto">
      <?php if ($is_logged_in): ?>
        <span class="navbar-text me-3 text-white">Hai, <strong><?= htmlspecialchars($username) ?></strong></span>
        <a class="btn btn-outline-light btn-sm" href="menu.php">Menu</a>
        <a class="btn btn-light btn-sm ms-2" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm" href="login.html">Login</a>
        <a class="btn btn-light btn-sm ms-2" href="register.html">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav> 

<div class="container mt-4">
  <div class="text-center mb-4">
    <h1 class="display-5 fw-bold">📋 Daftar Perusahaan</h1>
    <p class="lead">Informasi perusahaan terdaftar di sistem</p>
    <?php if ($is_logged_in): ?>
      <a href="CRUD/crud_perusahaan.php" class="btn btn-success btn-lg">➕ Kelola Data Perusahaan</a>
    <?php endif; ?>
  </div>

  <?php if (empty($perusahaan_list)): ?>
    <div class="alert alert-warning text-center">
      Belum ada data perusahaan.
      <?php if ($is_logged_in): ?> 
        <a href="tambah_perusahaan.php">Tambah sekarang?</a>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($perusahaan_list as $p): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card card-hover h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($p['nama']) ?></h5>
              <p class="card-text">
                <small class="text-muted"><?= htmlspecialchars(substr($p['deskripsi'], 0, 100)) ?>...</small>
              </p>
              <p class="text-muted small">📍 <?= htmlspecialchars($p['alamat']) ?></p>
              
              <!-- Aksi -->
              <div class="text-center mt-3">
                <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                <?php if ($is_logged_in): ?>
                  <a href="CRUD/edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a> 
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<footer class="text-center py-3 mt-5 bg-white border-top">
  @Copyright by 23552011329_Aditia_Nurwansyah_TIF_RP_23CNS_A
</footer> 

</body>
</html> 