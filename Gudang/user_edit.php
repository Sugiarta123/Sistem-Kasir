<?php
$id_user = $_GET['id'];
$id_toko = $_SESSION['user']['id_toko'];

$ambil = $koneksi->query("SELECT * FROM user WHERE id_user='$id_user' AND id_toko='$id_toko' ");
$user = $ambil->fetch_assoc();
?>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Edit User</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $user['nama_user'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user['email_user'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
                <p class="text-muted small">Kosongkan Jika tidak Ingin merubah Password</p>
            </div>
            <div class="mb-3">
                <label for="">Level</label>
                <select name="level" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="kasir" <?php echo $user['level_user']=='kasir'?"selected":"" ?> >Kasir</option>
                    <option value="gudang" <?php echo $user['level_user']=='gudang'?"selected":"" ?> >Admin Gudang</option>
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
    $level = $_POST['level'];
    $id_toko = $_SESSION['user']['id_toko'];
    if(!empty($_POST['password'])){
        $password = sha1($_POST['password']);
        $koneksi->query("UPDATE user SET
                        nama_user='$nama',
                        email_user= '$email',
                        password_user='$password',
                        level_user= '$level' WHERE id_user='$id_user' AND id_toko='$id_toko' ");
    }else{
        $koneksi->query("UPDATE user SET
                        nama_user='$nama',
                        email_user= '$email',
                        level_user= '$level' WHERE id_user='$id_user' AND id_toko='$id_toko' ");
    }


    echo"<script>alert('Data User Berhasil Diperbarui')</script>";
    echo"<script>location='index.php?page=user'</script>";
}
?>