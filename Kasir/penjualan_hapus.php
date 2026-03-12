<?php
session_start(); // Pastikan session dimulai
include '../koneksi.php'; // Panggil koneksi ke database

$id_penjualan = $_GET['id']; // Pastikan ini diambil dengan benar
$id_toko = $_SESSION['user']['id_toko'];

$produk = array();
$ambil = $koneksi->query("SELECT * FROM penjualan_produk WHERE id_penjualan='$id_penjualan' AND id_toko='$id_toko'");

if ($ambil->num_rows > 0) {
    while ($tiap = $ambil->fetch_assoc()) {
        $id_produk = $tiap['id_produk'];
        $jumlah_jual = $tiap['jumlah_jual'];

        // Kembalikan stok produk
        $update = $koneksi->query("UPDATE produk SET stok_produk = stok_produk + $jumlah_jual WHERE id_produk='$id_produk'");
        if (!$update) {
            die("Gagal mengembalikan stok: " . $koneksi->error);
        }
    }

    // Hapus data penjualan dan penjualan_produk
    $hapus_produk = $koneksi->query("DELETE FROM penjualan_produk WHERE id_penjualan='$id_penjualan' AND id_toko='$id_toko'");
    $hapus_penjualan = $koneksi->query("DELETE FROM penjualan WHERE id_penjualan='$id_penjualan' AND id_toko='$id_toko'");

    if ($hapus_produk && $hapus_penjualan) {
        echo "<script>alert('Penjualan berhasil dihapus');</script>";
        echo "<script>location='penjualan.php';</script>";
    } else {
        die("Gagal menghapus penjualan: " . $koneksi->error);
    }
} else {
    echo "<script>alert('Data penjualan tidak ditemukan');</script>";
    echo "<script>location='penjualan.php';</script>";
}
?>
