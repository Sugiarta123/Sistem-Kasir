<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Tambah Rekening</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="">Bank</label>
                <input type="text" name="bank" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Nomor Rekening</label>
                <input type="text" name="nomor" class="form-control">
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
    $id_toko = $_SESSION['user']['id_toko'];

    $koneksi->query("INSERT INTO rekening (id_toko,bank,nama,nomor) VALUES ('$id_toko','$bank','$nama','$nomor')");

    echo"<script>alert('Data Rekening Berhasil tersimpan')</script>";
    echo"<script>location='index.php?page=rekening'</script>";
}
?>