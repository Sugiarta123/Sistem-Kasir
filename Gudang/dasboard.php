<?php
$id_toko = $_SESSION['user']['id_toko'];

// Menghitung total penjualan (keseluruhan)
$ambil_penjualan = $koneksi->query("SELECT SUM(total_penjualan) AS total_penjualan 
                                     FROM penjualan 
                                     WHERE id_toko = '$id_toko'");
$total_penjualan = ($ambil_penjualan->fetch_assoc())['total_penjualan'] ?? 0;

// Menghitung total keuntungan (keseluruhan)
$ambil_keuntungan = $koneksi->query("SELECT SUM((penjualan_produk.harga_jual - penjualan_produk.harga_beli) * penjualan_produk.jumlah_jual) AS total_keuntungan 
                                      FROM penjualan_produk
                                      LEFT JOIN penjualan ON penjualan_produk.id_penjualan = penjualan.id_penjualan
                                      WHERE penjualan.id_toko = '$id_toko'");
$total_keuntungan = ($ambil_keuntungan->fetch_assoc())['total_keuntungan'] ?? 0;

// Menghitung total produk terjual (keseluruhan)
$ambil_produk_terjual = $koneksi->query("SELECT SUM(penjualan_produk.jumlah_jual) AS total_produk_terjual
                                         FROM penjualan_produk
                                         LEFT JOIN penjualan ON penjualan_produk.id_penjualan = penjualan.id_penjualan
                                         WHERE penjualan.id_toko = '$id_toko'");
$total_produk_terjual = ($ambil_produk_terjual->fetch_assoc())['total_produk_terjual'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .jumbotron {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
            border-radius: 15px;
            padding: 3rem;
            margin-bottom: 2rem; /* Tambahkan margin bawah */
        }
        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-top: 1rem; /* Memberi jarak antar card */
            margin-bottom: 1rem; /* Memberi jarak antar card */
        }
        .card-custom h5 {
            font-weight: bold;
        }
        .card-custom p {
            font-size: 1.7rem; /* Membesarkan ukuran teks */
            margin: 0;
        }
        .text-muted-small {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8); /* Memperbaiki warna teks untuk kontras lebih baik */
        }
    </style>
</head>
<body>
<div class="container my-4 ">
    <!-- Ucapan Selamat Datang -->
    <div class="jumbotron text-center border-0">
        <h1 class="display-5 pb-2">Selamat Datang <?php echo $_SESSION['user']['nama_user'] ?> di Dashboard Admin</h1>
        <p class="lead">Laporan dan analisa penjualan dalam satu tampilan.</p>
        <hr class="my-4">
        <p class="text-muted-small">Ringkasan singkat aktivitas bisnis Anda hari ini.</p>
    </div>

    <!-- Section Laporan Penjualan -->
    <div class="row text-center">
        <div class="col-md-4 ">
            <div class="card bg-primary text-white mb-4 card-custom border-0">
                <div class="card-body ">
                    <h5 class="card-title">Laporan Penjualan</h5>
                    <p class="card-text">Rp <?php echo number_format($total_penjualan, 0, ',', '.'); ?></p>
                    <span class="text-muted-small">Diperbarui hari secara realtime</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4 card-custom border-0">
                <div class="card-body">
                    <h5 class="card-title">Laporan Keuntungan</h5>
                    <p class="card-text">Rp <?php echo number_format($total_keuntungan, 0, ',', '.'); ?></p>
                    <span class="text-muted-small">Diperbarui hari secara realtime</span>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-4 card-custom border-0">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk Terjual</h5>
                    <p class="card-text"><?php echo number_format($total_produk_terjual, 0, ',', '.'); ?> Produk</p>
                    <span class="text-muted-small">Diperbarui hari secara realtime</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>