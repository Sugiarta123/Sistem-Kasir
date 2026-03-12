<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logout berhasil! Terima kasih, Admin Gudang. Semoga hari anda menyenangkan!');</script>";
echo "<script>location='../index.php';</script>";
?>
