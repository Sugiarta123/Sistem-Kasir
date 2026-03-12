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
      .card-body h3{
        text-align: center;
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
          <a class="nav-link" href="laporan.php">
            <i class="bi bi-file-earmark-text"></i> Laporan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="akun.php">
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

// Jika user belum login, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!');</script>";
    echo "<script>location='../index.php';</script>";
    exit();
}

$id_user = $_SESSION['user']['id_user'];

// Ambil data user dari database
$ambil = $koneksi->query("SELECT * FROM user WHERE id_user='$id_user'");
$user = $ambil->fetch_assoc();


// echo '<pre>';
// print_r($user);
// echo '</pre>';
?>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h3>Ubah Akun</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?Php echo $user['nama_user'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="<?Php echo $user['email_user'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" >
                            <p class="text-muted small">Kosongkan Jika tidak Ingin merubah Password</p>
                        </div>
                        <button class="btn btn-primary" name="ubah">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ubah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $password = sha1($password);
        $koneksi->query("UPDATE user SET nama_user='$nama', email_user='$email', password_user='$password' WHERE id_user='$id_user'");
    } else {
        $koneksi->query("UPDATE user SET nama_user='$nama', email_user='$email' WHERE id_user='$id_user'");
    }

    echo "<script>alert('Data akun berhasil diperbarui');</script>";
    echo "<script>location='../index.php';</script>";
}
?>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>