<?php 
require_once '../koneksi.php';

$nama_lengkap = $_POST['nama_lengkap'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (!empty($_POST['id'])) {
    // Update data user
    $id = $_POST['id'];
    $stmt = $con->prepare("UPDATE tbl_users SET nama_lengkap = ?, email = ?, username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama_lengkap, $email, $username, $hashed_password, $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User berhasil diperbarui!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui user: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID user tidak ditemukan untuk pembaruan.']);
}           
exit;
?>