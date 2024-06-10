<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Jumlah baris per halaman
$limit = 10;

// Menentukan halaman saat ini, default ke halaman 1 jika tidak ada parameter page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Menghitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data dari tabel tahfizh_data
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'nis';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Ambil data pencarian dari form
$search = $_GET['search'];

// Hapus data jika ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    $nis = $_POST['nis'];

    // Hapus data dari tabel tahfizh_data
    $query = "DELETE FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi);
    }
}

// Proses pencarian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_POST['search']);
    // Ubah query berdasarkan kata kunci pencarian
    $query = "SELECT * FROM portopolio_isi WHERE nis LIKE '%$keyword%' OR nama LIKE '%$keyword%' LIMIT $limit OFFSET $offset";
} else {
    // Ambil data dari tabel portopolio_isi jika tidak ada pencarian
    $query = "SELECT * FROM portopolio_isi";
}

$result = mysqli_query($koneksi, $query);

// Query untuk mendapatkan total jumlah data
$total_query = "SELECT COUNT(*) AS total FROM portopolio_isi WHERE nis LIKE '%$search%' OR nama LIKE '%$search%' OR asrama LIKE '%$search%' OR kelas LIKE '%$search%' ";
$total_result = mysqli_fetch_assoc(mysqli_query($koneksi, $total_query));

// Menghitung total halaman
$total_rows = $total_result['total'];
$total_pages = ceil($total_rows / $limit);

// Hitung halaman awal dan akhir yang akan ditampilkan
$start_page = max(1, $page - 1); // Menampilkan 1 halaman sebelum halaman saat ini
$end_page = min($total_pages, $page + 1); // Menampilkan 1 halaman setelah halaman saat ini

$kataPencarian = isset($_GET['search']) ? $_GET['search'] : ''; 
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
        rel="apple-touch-icon"
        sizes="76x76"
        href="img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="img/rilisan.png" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <title>Database Santri ICBS Putri</title>
    <!--     Fonts and icons     -->
    <link
        rel="stylesheet"
        type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"
    />
    <!-- Nucleo Icons -->
    <link href="css/nucleo-icons.css" rel="stylesheet" />
    <link href="css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script
        src="https://kit.fontawesome.com/42d5adcbca.js"
        crossorigin="anonymous"
    ></script>
    <!-- Material Icons -->
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Round"
        rel="stylesheet"
    />
    <!-- CSS Files -->
    <link
        id="pagestyle"
        href="css/material-kit.css"
        rel="stylesheet"
    />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script
        defer
        data-site="YOUR_DOMAIN_HERE"
        src="https://api.nepcha.com/js/nepcha-analytics.js"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
            background-image: url('backgroundgedung.jpg');
        }

    
        /* Ukuran font yang berbeda untuk tampilan yang responsif */
        @media (max-width: 576px) {
            .input-group input {
                font-size: 0.8rem; /* Ukuran font lebih kecil pada perangkat kecil */
            }

            .btn {
                font-size: 0.8rem; /* Ukuran font lebih kecil untuk tombol */
            }
        }

        @media (min-width: 768px) {
            .input-group input {
                font-size: 1rem; /* Ukuran font lebih besar pada layar besar */
            }

            .btn {
                font-size: 1rem; /* Ukuran font default */
            }
        }
        /* Responsive Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }

        /* Responsiveness for Button */
        .btn-kuning {
            padding: 16px;
            font-size: 0.8rem;
        }

        @media (max-width: 576px) {
            .btn-kuning {
                padding: 6px;
                font-size: 0.5rem;
            }

            .navbar-brand {
                font-size: 0.7rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }

        /* Responsive Text */
        .text-responsive {
            font-size: 18px;
        }

        @media (max-width: 576px) {
            .text-responsive {
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            .text-responsive {
                font-size: 20px;
            }
        }

        /* Responsive Table */
        .table {
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .table {
                font-size: 9px;
                padding: 1px;
            }
        }

        /* Responsive Card */
        .card {
            margin: 0 auto;
            overflow-x: auto;
        }

        /* Responsive Tambahdata */
        .tambahdata {
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .tambahdata {
                width: 100%;
            }
        }

        @media (min-width: 769px) {
            .tambahdata {
                width: 75%;
            }
        }

        /* Ukuran icon yang berbeda untuk tampilan yang responsif */
        @media (max-width: 576px) {
            .material-icons {
                font-size: 1rem; /* Ukuran icon lebih kecil pada perangkat kecil */
        }
    }

    </style>
</head>

<body style="overflow-x: hidden; background-image: url('backgroundgedung.jpg');">
    <nav class="navbar navbar-expand-lg position-sticky top-0 z-index-3 w-100 shadow-none" style="background-color: #fff;">
        <div class="container">
            <img src="img/rilisan.png" style="width: 4%; margin-right: 2%;" alt="logo">
            <a class="navbar-brand  text-dark fw-bold "rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank" href="homeadmin.php">
            Database Santri ICSB Putri
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                        <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
                        Program
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                        </a>
                        <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
                        <div class="d-none d-lg-block">
                            <a href="dt_kepesantrenan.php" class="dropdown-item border-radius-md">
                            <span>Kepesantrenan</span>
                            </a>
                            <a href="dt_tahfizh.php" class="dropdown-item border-radius-md">
                            <span>Tahfizh</span>
                            </a>
                            <a href="dt_prestasi.php" class="dropdown-item border-radius-md">
                            <span>Prestasi</span>
                            </a>
                            <a href="dt_disiplin.php" class="dropdown-item border-radius-md">
                            <span>Disiplin</span>
                            </a>
                            <a href="dt_perizinan.php" class="dropdown-item border-radius-md">
                            <span>Perizinan</span>
                            </a>
                            <a href="dt_minatbakat.php" class="dropdown-item border-radius-md">
                            <span>Minat</span>
                            </a>
                            <a href="dt_portopolio.php" class="dropdown-item border-radius-md">
                            <span>Portopolio</span>
                            </a>
                            <a href="rekapan_putri/rekapan.php" class="dropdown-item border-radius-md">
                            <span>Rekapan</span>
                            </a>
                        </div>
                        <div class="d-lg-none">
                        <a href="dt_kepesantrenan.php" class="dropdown-item border-radius-md">
                            <span>Kepesantrenan</span>
                            </a>
                            <a href="dt_tahfizh.php" class="dropdown-item border-radius-md">
                            <span>Tahfizh</span>
                            </a>
                            <a href="dt_prestasi.php" class="dropdown-item border-radius-md">
                            <span>Prestasi</span>
                            </a>
                            <a href="dt_disiplin.php" class="dropdown-item border-radius-md">
                            <span>Disiplin</span>
                            </a>
                            <a href="dt_perizinan.php" class="dropdown-item border-radius-md">
                            <span>Perizinan</span>
                            </a>
                            <a href="dt_minatbakat.php" class="dropdown-item border-radius-md">
                            <span>Minat</span>
                            </a>
                            <a href="dt_portopolio.php" class="dropdown-item border-radius-md">
                            <span>Portopolio</span>
                            </a>
                            <a href="rekapan_putri/rekapan.php" class="dropdown-item border-radius-md">
                            <span>Rekapan</span>
                            </a>
                        </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                        <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
                        Grafik
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                        </a>
                        <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
                        <div class="d-none d-lg-block">
                            <a href="grafik_tahfizh.php" class="dropdown-item border-radius-md">
                            <span>Grafik Tahfizh</span>
                            </a>
                            <a href="grafik_kedisiplinan.php" class="dropdown-item border-radius-md">
                            <span>Grafik Disiplin</span>
                            </a>
                        </div>
                        <div class="d-lg-none">
                        <a href="grafik_tahfizh.php" class="dropdown-item border-radius-md">
                            <span>Grafik Tahfizh</span>
                            </a>
                            <a href="grafik_kedisiplinan.php" class="dropdown-item border-radius-md">
                            <span>Grafik Disiplin</span>
                            </a>
                        </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                        <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
                        Akun
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
                        <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                        </a>
                        <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
                        <div class="d-none d-lg-block">
                            <a href="akun.php" class="dropdown-item border-radius-md">
                            <span>Kelola Akun</span>
                            </a>
                            <a href="logout.php" class="dropdown-item border-radius-md">
                            <span>Logout</span>
                            </a>
                        </div>
                        <div class="d-lg-none">
                            <a href="akun.php" class="dropdown-item border-radius-md">
                                <span>Kelola Akun</span>
                            </a>
                            <a href="logout.php" class="dropdown-item border-radius-md">
                                <span>Logout</span>
                            </a>
                        </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container py-2">
        <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Hapus Data Santri Santri</h1>
        <div class="add-santri-button text-center">
        </div>
    </div>

    <div class="container mb-6">
        <div class="card" style="overflow-x: auto;">
            <div class="add-button">
                <a class="fw-bold" style="font-size: 13px;" href="dt_portopolio.php">Kembali ke Data Santri</a>
            </div>
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded">
                <div class="container mt-2 table-responsive">
                    <!-- Formulir dengan grid sistem Bootstrap -->
                    <form method="GET" action="search_hapus_datasantri_portopolio.php">
                        <div class="row">
                            <!-- Kolom pencarian -->
                            <div class="col-12 col-md-8">
                                <div class="input-group input-group-outline">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Santri"  value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>" />
                                </div>
                            </div>
                            <!-- Kolom tombol -->
                            <div class="col-12 col-md-4">
                                <button
                                    type="submit"
                                    class="btn bg-gradient-info w-100"
                                >
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <section>
                <div class="table-responsive">
                    <ul class="pagination pagination-info m-4 justify-content-end">
                        <!-- Link untuk Previous -->
                        <?php if ($page > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                    <span aria-hidden="true"><i class="material-icons">chevron_left</i></span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="page-item disabled">
                                <a class="page-link" aria-label="Previous">
                                    <span aria-hidden="true"><i class="material-icons">chevron_left</i></span>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- Pagination link dengan parameter pencarian -->
                        <?php for ($i = $start_page; $i <= $end_page; $i++)  { ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                <?php echo $i; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- Link untuk Next -->
                        <?php if ($page < $total_pages) { ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo ($page + 1); ?>" aria-label="Next">
                                    <span aria-hidden="true"><i class="material-icons">chevron_right</i></span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="page-item disabled">
                                <a class="page-link" aria-label="Next">
                                    <span aria-hidden="true"><i class="material-icons">chevron_right</i></span>
                                </a>
                            </li>
                        <?php } ?>

                        
                    </ul>
                </div>
            </section>

            <section>
                <h4 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                    Hasil Pencarian <?php if ($kataPencarian) { echo ' " ' . htmlspecialchars($kataPencarian) . ' "'; } ?></h4>
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr class="text-center">
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            // Periksa apakah ada data yang diambil
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['nis'] . '</td>';
                                    echo '<td>' . $row['nama'] . '</td>';
                                    echo '<td>';
                                    echo '<form method="POST" action="">';
                                    echo '<input type="hidden" name="nis" value="' . $row['nis'] . '">';
                                    echo '<input type="submit" name="hapus" value="Hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">Tidak ada data santri.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div> 
    </div>
        
    </div>
</body>
</html>
