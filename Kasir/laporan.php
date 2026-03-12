<?php
session_start(); // Pastikan session dimulai
include '../koneksi.php'; // Panggil koneksi ke database
include '../functions.php';

require_once "oop/Transaksi.php";

require_once "models/Produk.php";
require_once "services/TransaksiService.php";

use Models\Produk;
use Services\TransaksiService;

// jika inputan tglm dan tgls 
if(isset($_POST['tglm']) AND $_POST['tgls'])
{
  $tglm = $_POST['tglm'];
  $tgls = $_POST['tgls'];
}
else 
{
  $tgls = date("Y-m-d");
  $tglm = (new DateTime($tgls))->modify("-1 month")->format("Y-m-d");
}

$laporan = array();
$id_toko = $_SESSION['user']['id_toko'];
$id_user = $_SESSION['user']['id_user'];
$ambil = $koneksi->query("SELECT * FROM penjualan 
                          LEFT JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan
                          WHERE penjualan.id_toko='$id_toko' AND id_user='$id_user' AND DATE(tanggal_penjualan) BETWEEN '$tglm' AND '$tgls'  ");
while($tiap = $ambil->fetch_assoc())
{
$laporan[] = $tiap;
}

// echo "<pre>";
// print_r( $laporan );
// echo "</pre>";
?>

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
          <a class="nav-link" href="penjualan.php">
            <i class="bi bi-cart"></i> Penjualan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="laporan.php">
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


<div class="container">
    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Mulai</label>
                        <input type="date" name="tglm" class="form-control" value="<?php echo $tglm ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="">Selesai</label>
                        <input type="date" name="tgls" class="form-control" value="<?php echo $tgls ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="">&nbsp;</label><br>
                        <button class="btn btn-primary" name="filter">Filter</button>
                    </div>
                </div>
            </form>
            <hr>
            <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $grandtotal = 0; ?>
              <?php foreach($laporan as $key => $value): ?>
              <?php 
                // menggunakan OOP
                $transaksi = new Transaksi("Elektronik",$value['total_penjualan'],1);
                $total = $transaksi->totalPenjualan();
                $grandtotal += $total;
              ?>
              <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo date("d M Y H:i", strtotime($value['tanggal_penjualan'])) ?></td>
                <td><?php echo $value['nama_pelanggan'] ?></td>
                <td><?php echo formatRupiah($total) ?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3">Total</td>
                <td><?php echo formatRupiah($grandtotal) ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
</div>


<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>