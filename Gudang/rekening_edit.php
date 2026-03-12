<?php
$id_rekening = $_GET['id'];
$id_toko = $_SESSION['user']['id_toko'];

$ambil = $koneksi->query("SELECT * FROM rekening WHERE id_rekening='$id_rekening' AND id_toko='$id_toko' ");
$rekening = $ambil->fetch_assoc();

if ($rekening['id_toko'] !==$_SESSION['user']['id_toko']){
    echo"<script>alert('Jangan Nakal!')</script>";
    echo"<script>location='index.php?page=rekening'</script>";
}
?>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Edit Rekening</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="">Bank</label>
                <input type="text" name="bank" class="form-control" value="<?php echo $rekening['bank'] ?>">
            </div>
            <div class="mb-3">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $rekening['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="">Nomor Rekening</label>
                <input type="text" name="nomor" class="form-control" value="<?php echo $rekening['nomor'] ?>">
            </div>
            <button class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</div>
<?php
if(isset($_POST['simpan']))
{
    $bank = $_POST['bank'];
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];

    $koneksi->query("UPDATE rekening SET bank='$bank',nama='$nama',nomor='$nomor' WHERE id_rekening='$id_rekening'");

    echo"<script>alert('Data Rekening Berhasil Diubah')</script>";
    echo"<script>location='index.php?page=rekening'</script>";
}
?>