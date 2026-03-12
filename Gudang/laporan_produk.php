<?php

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

$ambil = $koneksi->query("SELECT *,SUM(jumlah_jual) as terjual FROM penjualan_produk
                        LEFT JOIN produk ON penjualan_produk.id_produk=produk.id_produk
                        LEFT JOIN penjualan ON penjualan_produk.id_penjualan=penjualan.id_penjualan
                        WHERE penjualan_produk.id_toko='$id_toko'  AND DATE(tanggal_penjualan) BETWEEN '$tglm' AND '$tgls' 
                        GROUP BY penjualan_produk.id_produk ");
while($tiap = $ambil->fetch_assoc())
{
$laporan[] = $tiap;
}

// echo "<pre>";
// print_r( $laporan );
// echo "</pre>";
?>

<div class="card border-0 shadow">
<div class="card-header bg-primary text-white">Laporan Produk</div>
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
            <table class="table table-bordered" id="tabel">
            <thead>
              <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Terjual</th>
                <th>Stok Tersisa</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $totalTerjual = 0;
              $totalStok = 0; 
              ?>
              <?php foreach ($laporan as $key => $value): ?>
                <?php 
                $totalTerjual += $value['terjual'];
                $totalStok += $value['stok_produk']; 
                ?>
                <tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><?php echo $value["nama_produk"]; ?></td>
                  <td><?php echo $value["terjual"]; ?></td>
                  <td><?php echo $value["stok_produk"]; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">Total</td>
                <td><?php echo number_format($totalTerjual); ?></td>
                <td><?php echo number_format($totalStok); ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>