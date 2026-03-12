<?php 
include '../koneksi.php';
?>
<?php 
// jika belum ada login, jika tidak ada session user, maka larikan ke halaman login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login Terlebih Dahulu!');</script>";
    echo "<script>location='../index.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUGI TECHNO Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 120vh;
            background-color: #fff;
            padding-top: 1rem;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 99;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .sidebar-heading {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .navbar-toggler {
            display: block !important; /* Pastikan tombol hamburger tampil */
        }

            .sidebar {
                position: absolute;
                left: -250px;
                width: 250px;
                transition: all 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }
        }

        main {
            padding: 20px;
            background-color: #fff;
            min-height: 100vh;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <header class="navbar navbar-dark bg-primary ">
        <img src="../assets/img/logo.png" alt="image" width="100" class="ms-4 pt-1 pb-1">
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false">
            <span data-feather="menu"></span>
        </button>
        <a class="nav-link text-white px-3" href="logout.php">Sign out <span data-feather="log-out"></span></a>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-white sidebar shadow collapse show ">
                <div class="my-3 text-center">
                    <img src="../assets/img/profil.jpg" alt="" width="90" class="mb-2">
                    <h5><b><?php echo $_SESSION['user']['nama_user'] ?></b></h5>
                    <span class="text-muted small">Admin Gudang</span>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span data-feather="home"></span> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=user">
                            <span data-feather="user"></span> User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=supplier">
                            <span data-feather="package"></span> Supplier
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=kategori">
                            <span data-feather="layers"></span> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=produk">
                            <span data-feather="shopping-cart"></span> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=pelanggan">
                            <span data-feather="users"></span> Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=penjualan">
                            <span data-feather="dollar-sign"></span> Penjualan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=rekening">
                            <span data-feather="credit-card"></span> Rekening
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>LAPORAN</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=laporan_penjualan">
                            <span data-feather="bar-chart-2"></span> Laporan Penjualan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=laporan_keuntungan">
                            <span data-feather="trending-up"></span> Laporan Keuntungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=laporan_produk">
                            <span data-feather="shopping-bag"></span> Laporan Produk
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <?php
                if (!isset($_GET['page']))
                {
                    include 'dasboard.php';
                }
                else
                {
                    if ($_GET['page']=="supplier")
                    {
                        include 'supplier.php';
                    }
                    elseif ($_GET['page']== 'kategori')
                    {
                        include 'kategori.php';
                    }
                    elseif ($_GET['page']== 'produk')
                    {
                        include 'produk.php';
                    }
                    elseif ($_GET['page']== 'pelanggan')
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['page']== 'penjualan')
                    {
                        include 'penjualan.php';
                    }
                    elseif ($_GET['page']== 'penjualan_produk')
                    {
                        include 'penjualan_produk.php';
                    }
                    elseif ($_GET['page']== 'supplier_tambah')
                    {
                        include 'supplier_tambah.php';
                    }
                    elseif ($_GET['page']== 'kategori_tambah')
                    {
                        include 'kategori_tambah.php';
                    }
                    elseif ($_GET['page']== 'produk_tambah')
                    {
                        include 'produk_tambah.php';
                    }
                    elseif ($_GET['page']== 'supplier_edit')
                    {
                        include 'supplier_edit.php';
                    }
                    elseif ($_GET['page']== 'supplier_hapus')
                    {
                        include 'supplier_hapus.php';
                    }
                    elseif ($_GET['page']== 'kategori_edit')
                    {
                        include 'kategori_edit.php';
                    }
                    elseif ($_GET['page']== 'kategori_hapus')
                    {
                        include 'kategori_hapus.php';
                    }
                    elseif ($_GET['page']== 'produk_edit')
                    {
                        include 'produk_edit.php';
                    }
                    elseif ($_GET['page']== 'laporan_penjualan')
                    {
                        include 'laporan_penjualan.php';
                    }
                    elseif ($_GET['page']== 'laporan_keuntungan')
                    {
                        include 'laporan_keuntungan.php';
                    }
                    elseif ($_GET['page']== 'user')
                    {
                        include 'user.php';
                    }
                    elseif ($_GET['page']== 'user_tambah')
                    {
                        include 'user_tambah.php';
                    }
                    elseif ($_GET['page']== 'user_edit')
                    {
                        include 'user_edit.php';
                    }
                    elseif ($_GET['page']== 'user_hapus')
                    {
                        include 'user_hapus.php';
                    }
                    elseif ($_GET['page']== 'laporan_produk')
                    {
                        include 'laporan_produk.php';
                    }
                    elseif ($_GET['page']== 'rekening')
                    {
                        include 'rekening.php';
                    }
                    elseif ($_GET['page']== 'rekening_tambah')
                    {
                        include 'rekening_tambah.php';
                    }
                    elseif ($_GET['page']== 'rekening_edit')
                    {
                        include 'rekening_edit.php';
                    }
                    elseif ($_GET['page']== 'rekening_hapus')
                    {
                        include 'rekening_hapus.php';
                    }
                    elseif ($_GET['page']== 'produk_hapus')
                    {
                        include 'produk_hapus.php';
                    }
                }
                ?>

            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#tabel');
    </script>

    <script>
        feather.replace();

        const sidebar = document.getElementById('sidebarMenu');
        const overlay = document.getElementById('overlay');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Sidebar toggle function
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        // Close sidebar when clicking on overlay (for mobile)
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

</body>

</html>
