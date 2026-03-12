<?php 
//mendapatkan id toko si user yang login
$id_toko = $_SESSION['user']['id_toko'];

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
    <div class="card-header bg-primary text-white">Tambah Produk</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="">Supplier</label>
                    <select name="id_supplier" id="" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php foreach($supplier as $key => $value): ?>
                        <option value="<?php echo $value["id_supplier"] ?>">
                            <?php echo $value["nama_supplier"] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Kategori</label>
                    <select name="id_kategori" id="" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php foreach($kategori as $key => $value): ?>
                        <option value="<?php echo $value["id_kategori"] ?>">
                            <?php echo $value["nama_kategori"] ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Kode Produk</label>
                    <input type="text" name="kode" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="">Beli Produk</label>
                    <input type="number" name="beli" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Jual Produk</label>
                    <input type="number" name="jual" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Stok Produk</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Foto Produk</label>
                <input type="file" name="foto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="">Keterangan Produk</label>
                <textarea name="keterangan" class="form-control" rows="3" id=""></textarea>
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
        $query = "INSERT INTO produk 
            (id_toko, id_kategori, id_supplier, nama_produk, kode_produk, beli_produk, jual_produk, stok_produk, foto_produk, keterangan_produk) 
            VALUES 
            ('$id_toko', '$id_kategori', '$id_supplier', '$nama', '$kode', '$beli', '$jual', '$stok', '$namafoto', '$keterangan')";
    } else {
        $query = "INSERT INTO produk 
            (id_toko, id_kategori, id_supplier, nama_produk, kode_produk, beli_produk, jual_produk, stok_produk, keterangan_produk) 
            VALUES 
            ('$id_toko', '$id_kategori', '$id_supplier', '$nama', '$kode', '$beli', '$jual', '$stok', '$keterangan')";
    }
    

    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data Produk Berhasil Ditambahkan');</script>";
        echo "<script>location='index.php?page=produk';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>