<?php
$id_rekening = $_GET['id'];
$id_toko = $_SESSION['user']['id_toko'];

$ambil = $koneksi->query("SELECT * FROM rekening WHERE id_rekening='$id_rekening' AND id_toko='$id_toko' ");
$rekening = $ambil->fetch_assoc();

if ($rekening['id_toko'] !==$_SESSION['user']['id_toko']){
    echo"<script>alert('Jangan Nakal!')</script>";
    echo"<script>location='index.php?page=rekening'</script>";
}

$koneksi->query("DELETE FROM rekening WHERE id_rekening='$id_rekening'");
echo"<script>alert('Data Rekening Berhasil Dihapus')</script>";
echo"<script>location='index.php?page=rekening'</script>";
?>