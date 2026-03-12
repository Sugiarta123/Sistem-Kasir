<?php 
//mendapatkan id toko si user yang login
$id_produk = $_GET['id'];
$id_toko = $_SESSION['user']['id_toko'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' and id_toko='$id_toko'");
$produk = $ambil->fetch_assoc();

$supplier = array();
$ambil = $koneksi->query("SELECT * FROM supplier WHERE id_toko='$id_toko' ");
while($tiap = $ambil->fetch_assoc())
{
    $supplier[] = $tiap;
}

$kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_toko='$id_toko' ");
while($tiap = $ambil->fetch_assoc())
{
    $kategori[] = $tiap;
}
?>

<div class="card border-0 shadow">
    <div class="card-header bg-primary text-white">Edit Produk</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="">Supplier</label>
                    <select name="id_supplier" id="" class="form-control">
                        <option value="">Pilih</option>
                        <?php foreach($supplier as $key => $value): ?>
                        <option value="<?php echo $value["id_supplier"] ?>" <?php echo $value['id_supplier']==$produk['id_supplier']?"selected":"" ?>>
                            <?php echo $value["nama_supplier"] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Kategori</label>
                    <select name="id_kategori" id="" class="form-control">
                        <option value="">Pilih</option>
                        <?php foreach($kategori as $key => $value): ?>
                        <option value="<?php echo $value["id_kategori"] ?>" <?php echo $value['id_kategori']==$produk['id_kategori']?"selected":"" ?>>
                            <?php echo $value["nama_kategori"] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Kode Produk</label>
                    <input type="text" name="kode" class="form-control" value="<?php echo $produk['kode_produk'] ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $produk['nama_produk'] ?>">
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="">Beli Produk</label>
                    <input type="number" name="beli" class="form-control" value="<?php echo $produk['beli_produk'] ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Jual Produk</label>
                    <input type="number" name="jual" class="form-control" value="<?php echo $produk['jual_produk'] ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Stok Produk</label>
                    <input type="number" name="stok" class="form-control" value="<?php echo $produk['stok_produk'] ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="">Foto Sebelumnya</label><br>
                <img src="../assets/img/produk/<?php echo $produk['foto_produk'] ?>" alt="" width="200">
            </div>
            <div class="mb-3">
                <label for="">Foto Produk</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Keterangan Produk</label>
                <textarea name="keterangan" class="form-control" rows="3" id=""><?php echo $produk['keterangan_produk'] ?></textarea>
            </div>
            <button class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</div>
<?php
if(isset($_POST['simpan']))
{
    $id_toko = $_SESSION['user']['id_toko'];
    $nama = $_POST['nama'];
    $id_supplier = $_POST['id_supplier'];
    $id_kategori = $_POST['id_kategori'];
    $kode = $_POST['kode'];
    $beli = $_POST['beli'];
    $jual = $_POST['jual'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "../assets/img/produk/" . $namafoto);
        $query = "UPDATE produk SET 
                id_kategori='$id_kategori',
                id_supplier='$id_supplier',
                nama_produk='$nama',
                kode_produk='$kode',
                beli_produk='$beli',
                jual_produk='$jual',
                stok_produk='$stok',
                foto_produk='$namafoto',
                keterangan_produk='$keterangan' WHERE id_produk='$id_produk' and id_toko='$id_toko'
                ";
    } else {
        $query = "UPDATE produk SET 
                id_kategori='$id_kategori',
                id_supplier='$id_supplier',
                nama_produk='$nama',
                kode_produk='$kode',
                beli_produk='$beli',
                jual_produk='$jual',
                stok_produk='$stok',
                keterangan_produk='$keterangan' WHERE id_produk='$id_produk' and id_toko='$id_toko'
                ";
    }
    

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data Produk Berhasil Diubah');</script>";
        echo "<script>location='index.php?page=produk';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>