<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Sugi Techno</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
      body {
        background-color: #f8f9fa;
      }
      
      .card-product img {
        border-radius: 10px;
        height: 150px;
        object-fit: cover;
      }
      .card-product {
        transition: transform 0.2s, box-shadow 0.2s;
      }
      .card-product:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      .keranjang {
        min-height: 300px;
      }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark mb-4 shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">
    <img src="../assets/img/logo.png" alt="" width="90" class="mb-1">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="bi bi-house-door"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="penjualan.php">
            <i class="bi bi-cart"></i> Penjualan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="laporan.php">
            <i class="bi bi-file-earmark-text"></i> Laporan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="akun.php">
            <i class="bi bi-person-circle"></i> Akun
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php 

session_start(); // Pastikan session dimulai
include '../koneksi.php'; // Panggil koneksi ke database
include '../functions.php';

//mendapatkan id toko si user yang login
$id_toko = $_SESSION['user']['id_toko'];

//mendapatkan id_penjualan 
$id_penjualan = $_GET['id'];

//ambil dari tabel penjualan yang id di url
$ambil = $koneksi->query("SELECT penjualan.*, pelanggan.*, rekening.bank, rekening.nomor 
                          FROM penjualan 
                          LEFT JOIN pelanggan ON penjualan.id_pelanggan = pelanggan.id_pelanggan
                          LEFT JOIN rekening ON penjualan.id_rekening = rekening.id_rekening
                          WHERE penjualan.id_penjualan = '$id_penjualan' 
                          AND penjualan.id_toko = '$id_toko'");
$penjualan = $ambil->fetch_assoc();

$produk = array();
$ambil = $koneksi->query("SELECT * FROM penjualan_produk WHERE id_penjualan='$id_penjualan' AND id_toko='$id_toko' ");
while ($tiap = $ambil->fetch_assoc()) 
{
$produk[] = $tiap;
}

// echo "<pre>";
// print_r($penjualan);
// print_r($produk);
// echo "</pre>";
?>

<div class="container">
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>ID Penjualan</td>
                        <td><?php echo $penjualan['id_penjualan'] ?></td>
                    </tr>
                    <tr>
                        <td>Tangal</td>
                        <td><?php echo $penjualan['tanggal_penjualan'] ?></td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>
                            <?php echo $penjualan['nama_pelanggan'] ?>
                            <?php echo $penjualan['telepon_pelanggan'] ?>
                            <?php echo $penjualan['email_pelanggan'] ?>
                            <?php echo $penjualan['alamat_pelanggan'] ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $keuntungan = 0; ?>
                <?php foreach ($produk as $key => $value):  ?>
                    <?php $keuntungan += ($value['harga_jual'] - $value['harga_beli']) * $value['jumlah_jual'] ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value["nama_jual"] ?></td>
                        <td><?php echo formatRupiah($value["harga_beli"]) ?></td>
                        <td><?php echo formatRupiah($value["harga_jual"]) ?></td>
                        <td><?php echo formatRupiah($value["jumlah_jual"]) ?></td>
                        <td><?php echo formatRupiah($value["subtotal_jual"]) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td><?php echo formatRupiah($penjualan['total_penjualan']) ?></td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>
                        <?php 
                        if (!empty($penjualan['bank'])) {
                            echo $penjualan['bank'] . " (" . $penjualan['nomor'] . ")";
                        } else {
                            echo "Metode pembayaran belum ditentukan";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Bayar</td>
                    <td><?php echo formatRupiah($penjualan['bayar_penjualan']) ?></td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td><?php echo formatRupiah($penjualan['kembalian_penjualan']) ?></td>
                </tr>
                <tr>
                    <td>Keuntungan</td>
                    <td><?php echo formatRupiah($keuntungan) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>