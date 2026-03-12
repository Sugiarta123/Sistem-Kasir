<?php
session_start(); // Pastikan session dimulai
include '../koneksi.php'; // Panggil koneksi ke database
include '../functions.php';

// Mendapatkan id toko si user yang login
$id_toko = $_SESSION['user']['id_toko'];
$cari = $_POST['cari'];

$produk = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_toko='$id_toko' AND nama_produk LIKE '%$cari%' ");
while ($tiap = $ambil->fetch_assoc()) {
    $produk[] = $tiap;
}
?>
<div class="row g-3">
    <?php if (empty($produk)): ?>
        <div class="col-12">
            <div class="alert alert-warning text-center" role="alert">
                Produk tidak tersedia.
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($produk as $key => $value): ?>
            <div class="col-md-3">
                <div class="card card-product border-0 shadow-sm">
                    <a href="#" class="text-decoration-none link-produk" idnya="<?php echo $value['id_produk'] ?>">
                        <img src="../assets/img/produk/<?php echo $value['foto_produk'] ?>" alt="" class="img-fluid">
                        <div class="card-body">
                            <h6 class="text-dark"><?php echo $value['nama_produk'] ?></h6>
                            <span class="text-muted small"><?php echo formatRupiah($value['jual_produk']) ?></span>
                            <p>Stok: <?php echo $value["stok_produk"] ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>
