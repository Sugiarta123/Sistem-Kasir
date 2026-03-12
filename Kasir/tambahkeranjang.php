<?php 
include '../koneksi.php'; 
session_start(); // Pastikan session dimulai

$id_produk = $_POST['id_produk']; 
$id_toko = $_SESSION['user']['id_toko'];

// Ambil data produk dari database
$produk = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' AND id_toko='$id_toko'")->fetch_assoc();

// Periksa apakah produk ditemukan dan stoknya tersedia
if ($produk && $produk['stok_produk'] > 0) {
    // Jika produk belum ada di keranjang, tambahkan
    if (!isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] = 1;
    } 
    // Jika sudah ada, tambahkan jumlahnya
    else {
        $jumlahdikeranjang = $_SESSION['keranjang'][$id_produk];
        if($produk['stok_produk'] > $jumlahdikeranjang){
            $_SESSION['keranjang'][$id_produk] += 1;
        }
    }

}
?>
