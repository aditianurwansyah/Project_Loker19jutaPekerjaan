<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $username     = trim($_POST['usrname'] ?? '');
    $password     = $_POST['password'] ?? '';
    $konfirmasi   = $_POST['konfirmasiPassword'] ?? '';

    // Debug: hapus setelah berhasil
    // echo "<pre>"; var_dump($_POST); die();

    if (empty($nama_lengkap) || empty($email) || empty($username) || empty($password)) {
        die("<script>alert('Semua field wajib diisi!'); history.back();</script>");
    }

    if ($password !== $konfirmasi) {
        die("<script>alert('❌ Password dan konfirmasi tidak sama!'); history.back();</script>");
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $con->prepare("INSERT INTO tbl_users (nama_lengkap, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama_lengkap, $email, $username, $hashed);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Registrasi berhasil!'); window.location='login.html';</script>";
    } else {
        echo "<script>alert('❌ Gagal: " . $stmt->error . "'); history.back();</script>";
    }
    $stmt->close();
}
$con->close(); 
?> 