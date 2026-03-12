<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Tambah User</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Level</label>
                <select name="level" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="kasir">Kasir</option>
                    <option value="gudang">Gudang</option>
                </select>
            </div>
            <button class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</div>
<?php
if(isset($_POST['simpan']))
{
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];
    $id_toko = $_SESSION['user']['id_toko'];

    $koneksi->query("INSERT INTO user (id_toko,nama_user,email_user,password_user,level_user) 
    VALUES ('$id_toko','$nama','$email','$password','$level')");

    echo"<script>alert('Data User Berhasil tersimpan')</script>";
    echo"<script>location='index.php?page=user'</script>";
}
?>