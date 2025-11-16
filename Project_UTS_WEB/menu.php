<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Jika belum login, redirect ke login.html
    header("Location: login.html");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menu Utama</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .card { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-success text-white text-center">
      <h2>🔐 Menu Utama</h2>
    </div>
    <div class="card-body text-center">
      <h3>👋 Selamat Datang, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</h3>
      
      <div class="row mt-4">
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5>🏠 Beranda</h5>
              <a href="index.php" class="btn btn-outline-primary w-100">Lihat Data</a> 
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5>👤 Profil</h5>
              <a href="#" class="btn btn-outline-info w-100 disabled" title="Fitur belum tersedia">Lihat Profil</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5>📊 Dashboard</h5>
              <a href="#" class="btn btn-outline-secondary w-100 disabled" title="Fitur belum tersedia">Dashboard</a>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4">
        <a href="logout.php" class="btn btn-danger px-4 py-2">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
  </div>
</div>

<footer class="text-center py-3 mt-4 text-muted bg-light border-top">
  @Copyright by 23552011329_Aditia_Nurwansyah_TIF_RP_23CNS_A 
</footer> 

</body>
</html> 