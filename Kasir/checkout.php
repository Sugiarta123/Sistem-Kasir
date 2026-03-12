<?php
include '../koneksi.php';

// echo "<pre>";
// print_r($_POST);
// print_r($_SESSION['keranjang']);
// echo "</pre>";
// exit();

$total = $_POST['total'];
$bayar = $_POST['bayar'];
$kembalian = $_POST['kembalian'];
$telepon = $_POST['telepon'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$id_rekening = $_POST['id_rekening'];
$tanggal = date("Y-m-d H:i:s");
$id_toko = $_SESSION['user']['id_toko'];
$id_user = $_SESSION['user']['id_user'];

//jika kosong telepon
if(empty($telepon)){
    $id_pelanggan = null;
}
else
{
    //cek ketabel pelanggan
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE telepon_pelanggan='$telepon'");
    $pelanggan = $ambil->fetch_assoc();

    if(empty($pelanggan)){
        $koneksi->query("INSERT INTO pelanggan (telepon_pelanggan,nama_pelanggan,email_pelanggan,alamat_pelanggan,id_toko) 
                        VALUES('$telepon','$nama','$email','$alamat','$id_toko')");
        $id_pelanggan = $koneksi->insert_id;
    }else{
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $koneksi->query("UPDATE pelanggan SET nama_pelanggan='$nama',email_pelanggan='$email',telepon_pelanggan='$telepon' 
                        WHERE id_pelanggan='$id_pelanggan'");
    }
}
//simpan penjualan
$koneksi->query("INSERT INTO penjualan
    (id_pelanggan,id_toko,id_user,tanggal_penjualan,total_penjualan,bayar_penjualan,kembalian_penjualan,id_rekening) 
    VALUES('$id_pelanggan','$id_toko','$id_user','$tanggal','$total','$bayar','$kembalian','$id_rekening');
    ");

// dapatkan id_penjualan barusan
$id_penjualan = $koneksi->insert_id;

//simpan penjualan produk
foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
{
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $produk = $ambil->fetch_assoc();
    $harga_beli = $produk['beli_produk'];
    $harga_jual = $produk['jual_produk'];
    $nama_jual = $produk['nama_produk'];
    $subtotal_jual = $produk['jual_produk'] * $jumlah;

    $koneksi->query("INSERT INTO penjualan_produk
    (id_penjualan,id_toko,id_produk,harga_beli,harga_jual,nama_jual,subtotal_jual,jumlah_jual)
    VALUES('$id_penjualan','$id_toko','$id_produk','$harga_beli','$harga_jual','$nama_jual','$subtotal_jual','$jumlah') ");

    // kurangi stok produk
    $koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");
}

// kosongkan keranjang
unset($_SESSION['keranjang']);

//larikan ke halaman nota
echo "<script>alert('Transaksi Berhasil!');</script>";
echo "<script>location='nota.php?id=$id_penjualan'</script>";
?>