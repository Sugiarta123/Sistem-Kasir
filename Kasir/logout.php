<?php
include '../koneksi.php';

session_destroy();
echo "<script>alert('Logout successful! Thank you, Kasir. See you next time!');</script>";
echo "<script>location='../index.php';</script>";
?>