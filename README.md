# Sistem Kasir Sugi Techno

## Deskripsi Sistem
Sistem Kasir Sugi Techno adalah aplikasi kasir berbasis web yang dirancang untuk membantu proses pengelolaan penjualan pada toko yang menjual berbagai produk elektronik seperti Televisi (TV), Air Conditioner (AC), Handphone (HP), Kulkas, dan Mesin Cuci. Sistem ini bertujuan untuk mempermudah proses pencatatan transaksi penjualan, pengelolaan data produk, serta pembuatan laporan penjualan secara cepat dan terstruktur.

Aplikasi ini dikembangkan menggunakan bahasa pemrograman PHP dengan database MySQL sebagai media penyimpanan data. Sistem ini dijalankan melalui web browser dengan menggunakan web server lokal seperti XAMPP.

Dengan adanya sistem ini, proses pengelolaan penjualan yang sebelumnya dilakukan secara manual dapat dilakukan secara lebih efisien, cepat, dan akurat. Sistem juga membantu pengguna dalam mengelola data produk, pelanggan, supplier, serta memantau laporan penjualan dan keuntungan toko.

Sistem ini memiliki dua jenis pengguna (role) yaitu Admin dan Kasir, dimana masing-masing pengguna memiliki hak akses yang berbeda dalam mengelola sistem.

-------------------------------------------------------------------------------------------------------------------------

## Hak Akses Pengguna

### Admin
Admin memiliki akses penuh terhadap sistem, termasuk:
* Mengelola data produk
* Mengelola data pelanggan
* Mengelola data supplier
* Mengelola data kategori
* Mengelola data rekening
* Mengelola data user
* Melihat laporan penjualan
* Melihat laporan keuntungan
* Mengelola seluruh transaksi

### Kasir
Kasir memiliki akses untuk melakukan kegiatan operasional penjualan seperti:
* Melakukan transaksi penjualan
* Checkout produk
* Mencetak nota penjualan
* Melihat laporan penjualan
* Mengedit akun

-------------------------------------------------------------------------------------------------------------------------

## Fitur Sistem

### Manajemen Data Master
Sistem menyediakan fitur pengelolaan data utama yang digunakan dalam proses transaksi, yaitu:
* Data Produk (Create, Read, Update, Delete)
* Data Pelanggan (Create, Read, Update, Delete)
* Data Supplier (Create, Read, Update, Delete)
* Data Kategori Produk (Create, Read, Update, Delete)
* Data Rekening (Create, Read, Update, Delete)
* Data User (Create, Read, Update, Delete)

### Transaksi Penjualan
Fitur transaksi digunakan untuk mencatat proses penjualan produk kepada pelanggan, yang meliputi:
* Input produk yang dibeli
* Proses checkout produk
* Perhitungan total pembayaran
* Penyimpanan data transaksi
* Cetak nota penjualan

### Laporan
Sistem juga menyediakan beberapa laporan yang dapat digunakan untuk memantau perkembangan penjualan toko, yaitu:
* Laporan Penjualan
* Laporan Produk
* Laporan Keuntungan

-------------------------------------------------------------------------------------------------------------------------

## Teknologi yang Digunakan
Sistem ini dibangun menggunakan beberapa teknologi berikut:
* PHP sebagai bahasa pemrograman utama
* MySQL sebagai sistem manajemen basis data
* HTML & CSS untuk tampilan antarmuka
* Bootstrap untuk desain tampilan responsif
* JavaScript untuk interaksi pada halaman web
* XAMPP sebagai web server lokal

-------------------------------------------------------------------------------------------------------------------------

## Cara Menjalankan Sistem
Untuk menjalankan sistem ini pada komputer lokal, ikuti langkah berikut:
1. Install aplikasi XAMPP pada komputer.
2. Salin folder project ke dalam direktori: C:\xampp\htdocs\SistemKasir
3. Jalankan Apache dan MySQL melalui XAMPP Control Panel.
4. Buka phpMyAdmin melalui browser.
5. Import database sistem kasir ke dalam MySQL.
6. Setelah database berhasil diimport, buka browser dan jalankan aplikasi melalui alamat berikut: http://localhost/SistemKasir

-------------------------------------------------------------------------------------------------------------------------

## Login Sistem
Sistem memiliki dua akun pengguna yang dapat digunakan untuk login:

### Admin
Username : sugi@gmail.com <br>
Password : sugi

### Kasir
Username : ita@gmail.com <br>
Password : ita

-------------------------------------------------------------------------------------------------------------------------

## Konsep Pemrograman yang Digunakan
Dalam pengembangan sistem ini diterapkan beberapa konsep pemrograman, antara lain:
* Modular Programming menggunakan fungsi (function)
* Object Oriented Programming (OOP) dengan penggunaan class, inheritance, dan interface
* Penggunaan namespace / package untuk pengelompokan kode program
* Integrasi dengan database MySQL
* Dokumentasi kode menggunakan komentar pada source code

-------------------------------------------------------------------------------------------------------------------------

## Dokumentasi Interface Sistem Kasir
Halaman Login
![alt text](<assets/img/Doumentasi/Halaman Login.png>)

## Author
Nama : I Putu Gede Sugiarta <br>
Project : Sistem Kasir Sugi Techno <br>
Skema Sertifikasi : Programmer

-------------------------------------------------------------------------------------------------------------------------