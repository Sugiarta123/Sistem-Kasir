<?php
include '../koneksi.php';
$telepon = $_POST['telepon'];
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE telepon_pelanggan='$telepon'");
$pelanggan = $ambil->fetch_assoc();

echo json_encode($pelanggan);
?>