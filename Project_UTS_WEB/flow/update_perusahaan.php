<?php 
require_once '../koneksi.php';

$nama = $_POST['nama'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$kontak = $_POST['kontak'] ?? '';

if (!empty($_POST['id'])) {
    // Update data perusahaan
    $id = $_POST['id'];
    $stmt = $con->prepare("UPDATE tbl_perusahaan SET nama = ?, deskripsi = ?, alamat = ?, kontak = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama, $deskripsi, $alamat, $kontak, $id);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Perusahaan berhasil diperbarui!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui perusahaan: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    // Insert data perusahaan baru
    $stmt = $con->prepare("INSERT INTO tbl_perusahaan (nama, deskripsi, alamat, kontak) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $deskripsi, $alamat, $kontak);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Perusahaan berhasil ditambahkan!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan perusahaan: ' . $stmt->error]);
    }
    $stmt->close();
}
?>