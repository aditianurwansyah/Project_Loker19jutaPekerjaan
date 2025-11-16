<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'] ?? 0;

// Koneksi database
require_once 'koneksi.php';

// Query data perusahaan
$stmt = $con->prepare("SELECT * FROM tbl_perusahaan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$perusahaan = $result->fetch_assoc();

if (!$perusahaan) {
    die("<div class='alert alert-danger'>Perusahaan tidak ditemukan!</div>");
}
?>
 
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($perusahaan['nama']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h2><?= htmlspecialchars($perusahaan['nama']) ?></h2>
    </div>
    <div class="card-body">
      <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($perusahaan['deskripsi'])) ?></p>
      <p><strong>Alamat:</strong> <?= htmlspecialchars($perusahaan['alamat']) ?></p>
      <p><strong>Kontak:</strong> <?= htmlspecialchars($perusahaan['kontak']) ?></p>
      
      <!-- Tombol Edit & Hapus -->
      <div class="mt-4">
        <a href="CRUD/edit.php?id=<?= $perusahaan['id'] ?>" class="btn btn-warning">✏️ Edit</a>
        <a href="CRUD/crud_perusahaan.php?id=<?= $perusahaan['id'] ?>"
           onclick="return confirm('Yakin ingin hapus perusahaan ini?')" 
           class="btn btn-danger">🗑️ Hapus</a>
        <a href="CRUD/crud_perusahaan.php" class="btn btn-secondary">📋 Lihat Semua</a>
      </div>
    </div>
  </div> 

  <!-- Kembali ke Daftar -->
  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-outline-primary">← Kembali ke Daftar Perusahaan</a>
  </div>
</div>

<footer class="text-center py-3 mt-5 bg-white border-top">
  @Copyright by 23552011329_Aditia_Nurwansyah_TIF_RP_23CNS_A
</footer>

</body>
</html> 