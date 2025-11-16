<?php
require_once '../koneksi.php';

$nama_lengkap = $_POST['nama_lengkap'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $con->prepare("INSERT INTO tbl_users (nama_lengkap, email, username, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama_lengkap, $email, $username, $hashed_password);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User berhasil ditambahkan!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan user: ' . $stmt->error]);
}
$stmt->close();
exit; 
?>