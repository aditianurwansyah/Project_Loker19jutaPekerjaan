<?php 
require_once '../koneksi.php';

// Ambil semua data user
$sql = "SELECT * FROM tbl_users ORDER BY username";
$result = $con->query($sql); 
$user_list = [];
if ($result) {
    $user_list = $result->fetch_all(MYSQLI_ASSOC);
}
header('Content-Type: application/json');
echo json_encode($user_list);
exit; 
?>