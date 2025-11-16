<?php 
require_once '../koneksi.php';

$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$kontak = $_POST['kontak'] ?? '';

$stmt = $con->prepare("INSERT INTO tbl_perusahaan (nama, deskripsi, alamat, kontak) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $deskripsi, $alamat, $kontak);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Perusahaan berhasil ditambahkan!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan perusahaan: ' . $stmt->error]);
}
$stmt->close();
exit;
?>
