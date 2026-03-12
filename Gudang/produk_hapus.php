<?php
$id_produk = $_GET['id'];
$id_toko = $_SESSION['user']['id_toko'];
$koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk' AND id_toko='$id_toko' ");

echo"<script>alert('Data Produk berhasil dihapus')</script>";
echo"<script>location='index.php?page=produk'</script>";
?>