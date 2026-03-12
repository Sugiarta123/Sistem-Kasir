<?php 
include '../koneksi.php';
$id_produk = $_POST['id_produk'];

if($_SESSION['keranjang'][$id_produk]==1)
{
    unset($_SESSION['keranjang'][$id_produk]);
}
else
{
    $_SESSION['keranjang'][$id_produk]-=1;
}
?>