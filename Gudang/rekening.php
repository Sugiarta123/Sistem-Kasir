<?php
$id_toko = $_SESSION['user']['id_toko'];

$rekening = array();
$ambil = $koneksi->query("SELECT * FROM rekening WHERE id_toko='$id_toko'");
while ($tiap = $ambil->fetch_assoc())
{
    $rekening[] = $tiap;
}

// echo"<pre>";
// print_r($rekening);
// echo "</pre";
?>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Data Rekening</div>
    <div class="card-body">
        <table class="table" >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bank</th>
                    <th>Nama</th>
                    <th>Nomor Rekening</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekening as $key => $value): ?>
                    <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value['bank'] ?></td>
                        <td><?php echo $value['nama'] ?></td>
                        <td><?php echo $value['nomor'] ?></td>
                        <td>
                        <a class="btn btn-warning btn-sm" href="index.php?page=rekening_edit&id=<?php echo $value["id_rekening"] ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="index.php?page=rekening_hapus&id=<?php echo $value["id_rekening"] ?>">Hapus</a>
                        </td>
                    </tr>
                
                <?php endforeach ?>
            </tbody>
        </table>
        <a class="btn btn-primary btn-sm" href="index.php?page=rekening_tambah">Tambah</a>
    </div>
</div>