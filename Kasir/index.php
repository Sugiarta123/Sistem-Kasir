<?php 
include '../koneksi.php';

// Jika user belum login, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Anda Harus Login Terlebih Dahulu!');</script>";
  echo "<script>location='../index.php';</script>";
  exit();
}

// Mendapatkan id toko si user yang login
// $id_toko = $_SESSION['user']['id_toko'];

// $produk = array();
// $ambil = $koneksi->query("SELECT * FROM produk WHERE id_toko='$id_toko'");
// while($tiap = $ambil->fetch_assoc()) {
//     $produk[] = $tiap;
// }
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
          <a class="nav-link active" href="index.php">
            <i class="bi bi-house-door"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="penjualan.php">
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

<!-- Produk dan Keranjang -->
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <form action="" method="post" class="mb-3">
              <div class="input-group">
                <input type="text" name="cari" class="form-control input-cari">
                <button class="btn btn-primary btn-cari">Cari</button>
              </div>
          </form>
          <div class="letak-produk"></div>
          
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body keranjang">
          <div class="text-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p>Memuat keranjang...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
 <script>
  $(document).ready(function(){
    $.ajax({
      url:'tampilproduk.php',
      success:function(hasil){
        $(".letak-produk").html(hasil);
      }
    })
  })
 </script>
 <script>
  $(document).ready(function(){
    $(document).on("click",".btn-cari",function(e){
      e.preventDefault();
      var cari = $(".input-cari").val();
      $.ajax({
        type:'post',
        url:'cariproduk.php',
        data:'cari='+cari,
        success:function(hasil){
          $(".letak-produk").html(hasil);
        }
      })
    })
  })
 </script>
<script>
  $(document).ready(function() {
    // Load keranjang saat halaman dibuka
    $.ajax({
      url: 'tampilkeranjang.php',
      success: function(hasil) {
        $('.keranjang').html(hasil);
      }
    });

    // Tambah produk ke keranjang
    $(document).on('click','.link-produk', function(e) {
      e.preventDefault();
      var id_produk = $(this).attr('idnya');
      $.post('masukankeranjang.php', { id_produk: id_produk }, function() {
        updateKeranjang();
      });
    });

    // Update keranjang setelah perubahan
    function updateKeranjang() {
      $.ajax({
        url: 'tampilkeranjang.php',
        success: function(hasil) {
          $('.keranjang').html(hasil);
        }
      });
    }

    // Tambah jumlah produk
    $(document).on('click', '.tambahi', function() {
      var id_produk = $(this).attr('idnya');
      $.post('tambahkeranjang.php', { id_produk: id_produk }, function() {
        updateKeranjang();
      });
    });

    // Kurangi jumlah produk
    $(document).on('click', '.kurangi', function() {
      var id_produk = $(this).attr('idnya');
      $.post('kurangkeranjang.php', { id_produk: id_produk }, function() {
        updateKeranjang();
      });
    });

    // Hitung kembalian
    $(document).on('keyup', '.bayar', function() {
      var bayar = $(this).val();
      var total = $('.total').val();
      var kembalian = parseInt(bayar) - parseInt(total);
      $('.kembalian').val(kembalian);
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on("keyup","input[name=telepon]",function(){
      var telepon =$(this).val();
      $.ajax({
        type:'post',
        url:'pelangganbytelepon.php',
        data:'telepon='+telepon,
        dataType:'json',
        success:function(hasil){
          console.log(hasil);
          $("input[name=nama]").val(hasil.nama_pelanggan);
          $("input[name=email]").val(hasil.email_pelanggan);
          $("textarea[name=alamat]").html(hasil.alamat_pelanggan);
        }
      })
    })
  })
</script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
