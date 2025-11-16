<?php
require_once '../koneksi.php';

// Ambil semua data perusahaan
$sql = "SELECT * FROM tbl_perusahaan ORDER BY nama";
$result = $con->query($sql);
$perusahaan_list = [];
if ($result) {
    $perusahaan_list = $result->fetch_all(MYSQLI_ASSOC);
}
header('Content-Type: application/json');
echo json_encode($perusahaan_list);
exit;
?>