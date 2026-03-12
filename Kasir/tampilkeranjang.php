<?php 
session_start(); // Tambahkan ini agar session dapat digunakan
include '../koneksi.php';
include '../functions.php';

// Pastikan keranjang terdefinisi sebagai array
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$keranjang = array();
$total = 0;

// Hanya lakukan foreach jika $_SESSION['keranjang'] tidak kosong
if (!empty($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $produk = $ambil->fetch_assoc();

        // Tambahkan jumlah produk ke dalam array
        $produk['jumlah'] = $jumlah;
        $keranjang[] = $produk;

        // Hitung total harga
        $total += $produk['jual_produk'] * $jumlah;
    }
}
$id_toko = $_SESSION['user']['id_toko'];
$rekening = array();
$jupuk = $koneksi->query("SELECT * FROM rekening WHERE id_toko='$id_toko'");
while ($tiap = $jupuk->fetch_assoc()) {
    $rekening[] = $tiap;
}

?>


<!-- Tampilkan produk dalam keranjang -->
<?php foreach ($keranjang as $key => $perproduk): ?>
<div class="row">
    <div class="col-md-9">
        <h6><?php echo $perproduk["nama_produk"] ?></h6>
        <span class="small text-muted">
            <?php echo formatRupiah($perproduk['jual_produk']) ?> X <?php echo $perproduk['jumlah'] ?>
        </span>
    </div>
    <div class="col-md-3">
        <div>
            <i class="bi bi-plus tambahi" idnya="<?php echo $perproduk['id_produk'] ?>"></i>
        </div>
        <div>
            <i class="bi bi-dash kurangi" idnya="<?php echo $perproduk['id_produk'] ?>"></i>
        </div>
    </div>
</div>
<hr>
<?php endforeach ?>

<!-- Form Checkout -->
<form method="post" action="checkout.php" target="_blank">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-primary float-right btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Pelanggan
    </button>
    </div>
    
    <div class="mb-2">
        <label for="">Total</label>
        <input type="number" name="total" class="form-control total" value="<?php echo $total ?>" readonly>
    </div>
    <div class="mb-2">
        <label for="">Bayar</label>
        <input type="number" name="bayar" class="form-control bayar" required>
    </div>
    <div class="mb-2">
        <label for="">Kembalian</label>
        <input type="number" name="kembalian" class="form-control kembalian" readonly>
    </div>
    <div class="mb-1">
        <label for="">Rekening</label>
        <select name="id_rekening" id="" class="form-control">
            <?php foreach ($rekening as $key => $value): ?>
                <option value="<?php echo $value['id_rekening'] ?>">
                    <?php echo $value['bank'] ?> - <?php echo $value['nomor'] ?> - <?php echo $value['nama'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    <hr>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Data Pelanggan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label>Telepon Pelanggan</label>
                <input type="text" name="telepon" class="form-control" placeholder="62">
            </div>
            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" >
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" >
            </div>
            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" id=""></textarea>
            </div>
            <button type="button" class="btn btn-primary btn-masuk btn-sm" data-bs-toggle="modal" data-bs-target="close">Masukan</button>
        </div>
        </div>
    </div>
    </div>
    <button class="btn btn-primary btn-sm">Checkout</button>
</form>
