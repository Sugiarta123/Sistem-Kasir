<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Sugi Techno</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
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

// Jika user belum login, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!');</script>";
    echo "<script>location='../index.php';</script>";
    exit();
}


// Ambil id_user dan id_toko
$id_user = (int)$_SESSION['user']['id_user'];
$id_toko = (int)$_SESSION['user']['id_toko'];

// Ambil data penjualan
$penjualan = array();
$ambil = $koneksi->query("SELECT * FROM penjualan 
                        LEFT JOIN pelanggan ON penjualan.id_pelanggan=pelanggan.id_pelanggan
                        WHERE penjualan.id_user='$id_user' AND penjualan.id_toko='$id_toko' ORDER BY id_penjualan DESC");

if (!$ambil) {
    die("Kueri gagal: " . $koneksi->error);
}

if ($ambil->num_rows == 0) {
    echo "Tidak ada data penjualan ditemukan.";
} else {
    while ($tiap = $ambil->fetch_assoc()) {
        $penjualan[] = $tiap;
    }

    // echo '<pre>';
    // print_r($penjualan);
    // echo '</pre>';
}
?>

<div class="container mb-5">
<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Transaksi Penjualan</div>
    <div class="card-body">
        <table class="table table-bordered" id="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($penjualan as $key => $value): ?>
                    <tr>
                        <td><?php echo$key+1 ?></td>
                        <td><?php echo date("d M Y H:i", strtotime($value["tanggal_penjualan"])) ?></td>
                        <td>
                            <?php echo $value["nama_pelanggan"] ?> <br>
                            <?php echo $value["telepon_pelanggan"] ?> <br>
                            <?php echo $value["email_pelanggan"] ?> <br>
                            <?php echo $value["alamat_pelanggan"] ?>
                        </td>
                        <td><?php echo formatRupiah($value["total_penjualan"]) ?></td>
                        <td><?php echo formatRupiah($value["bayar_penjualan"]) ?></td>
                        <td><?php echo formatRupiah($value["kembalian_penjualan"]) ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="penjualan_hapus.php?id=<?php echo $value["id_penjualan"] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                            <a class="btn btn-success btn-sm" href="penjualan_produk.php?id=<?php echo $value["id_penjualan"] ?>">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#tabel');
    </script>
</body>
</html>