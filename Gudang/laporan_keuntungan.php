<?php
include '../functions.php';
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

$period = new DatePeriod(new DateTime($tglm), new DateInterval('P1D'), new DateTime($tgls));
foreach($period as $date){
    $pertanggal = array();
    $tanggal = $date->format('y-m-d');
    $keuntungantanggal = 0;
    $transaksitanggal = 0;
    $ambil = $koneksi->query("SELECT * FROM penjualan_produk
    LEFT JOIN penjualan ON penjualan_produk.id_penjualan=penjualan.id_penjualan
    where penjualan.id_toko='$id_toko' and date(tanggal_penjualan)='$tanggal'");
    while($tiap = $ambil->fetch_assoc())
    {
      $transaksitanggal += $tiap['harga_jual'];
      $keuntungantanggal +=($tiap['harga_jual'] - $tiap['harga_beli']) * $tiap['jumlah_jual'];
    }
    $pertanggal['tanggal'] = $tanggal;
    $pertanggal['keuntungan'] = $keuntungantanggal;
    $pertanggal['transaksi'] = $transaksitanggal;
    $laporan[] =$pertanggal;
}


// echo "<pre>";
// print_r( $laporan );
// echo "</pre>";
?>

<div class="card border-0 shadow">
<div class="card-header bg-primary text-white">Laporan Keuntungan</div>
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
                  <th>Tanggal</th>
                  <th>Transaksi</th>
                  <th>Keuntungan</th>
                </tr>
              </thead>
              <tbody>
                <?php $totalkeuntungan = 0; ?>
                <?php $totaltransaksi = 0; ?>
                <?php foreach ($laporan as $key => $value): ?>
                  <?php $totalkeuntungan+=$value['keuntungan'] ?>
                  <?php $totaltransaksi+=$value['transaksi'] ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo date("d M Y", strtotime($value['tanggal'])) ?></td>
                        <td><?php echo formatRupiah($value['transaksi']) ?></td>
                        <td><?php echo formatRupiah($value['keuntungan']) ?></td>
                    </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">Total Keuntungan</td>
                  <td><?php echo formatRupiah($totaltransaksi) ?></td>
                  <td><?php echo formatRupiah($totalkeuntungan) ?></td>
                </tr>
              </tfoot>
            </table>
        </div>
    </div>