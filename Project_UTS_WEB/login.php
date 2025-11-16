<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Cek input kosong
    if (empty($username) || empty($password)) {
        die("<script>alert('Username dan password wajib diisi!'); history.back();</script>");
    }

    // Gunakan prepared statement
    $sql = "SELECT id, username, password FROM tbl_users WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Login sukses → simpan session (opsional)
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: menu.php"); 
            exit;
        } else {
            echo "<script>alert('Password salah.'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan.'); history.back();</script>";
    }

    $stmt->close();
}

$con->close(); 

?> 