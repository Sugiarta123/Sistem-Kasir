<?php 
//mendapatkan id toko si user yang login
$id_toko = $_SESSION['user']['id_toko'];

$pelanggan = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_toko='$id_toko' ");
while($tiap = $ambil->fetch_assoc())
{
    $pelanggan[] = $tiap;
}

// echo "<pre>";
// print_r($pelanggan);
// echo "</pre>";
?>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Pelanggan</div>
    <div class="card-body">
        <table class="table table-bordered" id="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pelanggan as $key => $value): ?>
                <tr>
                    <td><?php echo$key+1 ?></td>
                    <td><?php echo$value["nama_pelanggan"] ?></td>
                    <td><?php echo$value["email_pelanggan"] ?></td>
                    <td><?php echo$value["telepon_pelanggan"] ?></td>
                    <td><?php echo$value["alamat_pelanggan"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>