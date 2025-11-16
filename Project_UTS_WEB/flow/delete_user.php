<?php 
require_once '../koneksi.php';

$id = $_POST['id'] ?? '';
$stmt = $con->prepare("DELETE FROM tbl_users WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User berhasil dihapus!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus user: ' . $stmt->error]);
}
$stmt->close();
exit; 
?>