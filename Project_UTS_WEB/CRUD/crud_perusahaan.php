<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

require_once 'koneksi.php'; 

// Handle delete (jika ada parameter id dan action=delete)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $con->prepare("DELETE FROM tbl_perusahaan WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $msg = "Perusahaan berhasil dihapus!";
    } else {
        $msg = "Gagal menghapus perusahaan.";
    }
    // Redirect untuk hindari refresh yang mengulang delete
    header("Location: crud_perusahaan.php?msg=" . urlencode($msg));
    exit;
}

// Ambil semua data perusahaan
$sql = "SELECT * FROM tbl_perusahaan ORDER BY nama";
$result = $con->query($sql);
$perusahaan_list = [];
if ($result) {
    $perusahaan_list = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Perusahaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📋 Daftar Perusahaan</h2>
    <a href="tambah.php" class="btn btn-success">➕ Tambah Perusahaan</a>
  </div> 

  <!-- Pesan sukses/gagal -->
  <?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-info"><?= htmlspecialchars($_GET['msg']) ?></div>
  <?php endif; ?>

  <!-- Tabel Data -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="bg-light">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Alamat</th>
          <th>Kontak</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($perusahaan_list as $index => $p): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($p['nama']) ?></td>
            <td><?= substr(htmlspecialchars($p['deskripsi']), 0, 50) ?>...</td>
            <td><?= htmlspecialchars($p['alamat']) ?></td>
            <td><?= htmlspecialchars($p['kontak']) ?></td>
            <td>
              <a href="../detail.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-info">👁️</a>
              <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
              <a href="?action=delete&id=<?= $p['id'] ?>"  
                 onclick="return confirm('Yakin hapus <?= htmlspecialchars($p['nama']) ?>?')"
                 class="btn btn-sm btn-danger">🗑️</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Kembali ke Menu -->
  <div class="text-center mt-4">
    <a href="../menu.php" class="btn btn-outline-secondary">🏠 Kembali ke Menu</a>
  </div> 
</div>

<footer class="text-center py-3 mt-5 bg-white border-top">
  @Copyright by 23552011329_Aditia_Nurwansyah_TIF_RP_23CNS_A
</footer> 

</body>
</html> 