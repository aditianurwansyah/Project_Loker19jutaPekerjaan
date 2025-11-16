<?php
require_once '../koneksi.php';

$id = $_POST['id'] ?? '';
$stmt = $con->prepare("DELETE FROM tbl_perusahaan WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Perusahaan berhasil dihapus!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus perusahaan: ' . $stmt->error]);
}
$stmt->close();
exit;
?>