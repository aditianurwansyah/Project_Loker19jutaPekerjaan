<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

require_once 'koneksi.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    die("ID perusahaan tidak valid!");
}

// Ambil data perusahaan
$stmt = $con->prepare("SELECT * FROM tbl_perusahaan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$perusahaan = $result->fetch_assoc();

if (!$perusahaan) {
    die("Perusahaan tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $kontak = trim($_POST['kontak'] ?? '');

    if (empty($nama)) {
        $error = "Nama perusahaan wajib diisi!";
    } else {
        $stmt = $con->prepare("UPDATE tbl_perusahaan SET nama=?, deskripsi=?, alamat=?, kontak=? WHERE id=?");
        $stmt->bind_param("ssssi", $nama, $deskripsi, $alamat, $kontak, $id);
        if ($stmt->execute()) {
            header("Location: crud_perusahaan.php?msg=" . urlencode("Perusahaan berhasil diperbarui!"));
            exit;
        } else {
            $error = "Gagal memperbarui perusahaan: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Perusahaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-warning text-dark">
      <h2>✏️ Edit Perusahaan: <?= htmlspecialchars($perusahaan['nama']) ?></h2>
    </div>
    <div class="card-body">
      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Perusahaan</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($perusahaan['nama']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($perusahaan['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($perusahaan['alamat']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="kontak" class="form-label">Kontak (Email/HP)</label>
          <input type="text" class="form-control" id="kontak" name="kontak" value="<?= htmlspecialchars($perusahaan['kontak']) ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Perbarui</button>
        <a href="detail.php?id=<?= $perusahaan['id'] ?>" class="btn btn-secondary ms-2">Batal</a>
      </form>
    </div>
  </div>
</div>

<footer class="text-center py-3 mt-5 bg-white border-top">
  @Copyright by 23552011329_Aditia_Nurwansyah_TIF_RP_23CNS_A
</footer>

</body>
</html> 