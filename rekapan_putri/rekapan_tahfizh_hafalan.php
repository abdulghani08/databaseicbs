<?php
session_start();
include "connection.php";

// Ambil data dari tabel tahfizh_hafalan
$sql = "SELECT * FROM tahfizh_hafalan";
$result = $conn->query($sql);

// Fungsi JavaScript untuk mengurutkan tabel berdasarkan kolom yang di-klik
echo '
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.querySelector("table");
    switching = true;
    dir = "asc"; // Urutan awal adalah ascending (A-Z)

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];

            var cmp;
            if (n === 2) { // Kolom Tanggal Setoran
                cmp = Date.parse(x.innerHTML) - Date.parse(y.innerHTML);
            } else {
                cmp = x.innerHTML.localeCompare(y.innerHTML);
            }

            if ((dir == "asc" && cmp > 0) || (dir == "desc" && cmp < 0)) {
                shouldSwitch = true;
                break;
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function toggleSortIcon(iconElement, colIndex) {
    var currentIcon = iconElement.src;

    // Hapus semua ikon sort pada header
    var allIcons = document.querySelectorAll(".sort-icon");
    allIcons.forEach(function (icon) {
        icon.src = "sort.png";
    });

    if (currentIcon.includes("asc")) {
        // Jika sedang ascending, ubah menjadi descending
        iconElement.src = "sort-desc.png";
    } else {
        // Jika sedang descending atau belum diurutkan, ubah menjadi ascending
        iconElement.src = "sort-asc.png";
    }

    // Panggil fungsi pengurutan sesuai dengan indeks kolom
    sortTable(colIndex);
}
</script>
';

// ... (Kode PHP lainnya)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 10%;
        }

        .container {
            margin: 20px;
        }

        h1 {
            font-size: 24px;
        }

        .table-container {
            overflow-x: auto; /* Mengaktifkan horizontal scrolling saat diperlukan */
        }

        .sort-icon {
            margin-left: 5px;
        }

        @media (max-width: 480px) {
            th, td {
                padding: 6px;
                font-size: 14px;
            }

            th:nth-child(1), td:nth-child(1) {
                width: 15%;
            }
        }
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination a {
        color: #333;
        text-decoration: none;
        padding: 5px 10px;
        margin: 0 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination a:hover {
        background-color: #333;
        color: #fff;
    }

    .pagination a.active {
        background-color: #333;
        color: #fff;
        font-weight: bold;
    }

    </style>
    <title>Rekapan Hafalan Tahfizh Santri</title>
</head>
<body>
    <div class="container">
    <div>
            <a href="rekapan.php"><img src="icon/back_icon.png" alt="back"></a>
        </div>
        <h1>Rekapan Hafalan Tahfizh Santri</h1>
        <div class="table-container">
            <?php
        $per_page = 30; // Jumlah data per halaman
$total_rows = $result->num_rows; // Total jumlah data

// Hitung jumlah halaman
$total_pages = ceil($total_rows / $per_page);

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = max(1, min($_GET['page'], $total_pages));
} else {
    $current_page = 1;
}

// Hitung indeks awal dan akhir data untuk halaman saat ini
$start_index = ($current_page - 1) * $per_page;
$end_index = min($start_index + $per_page - 1, $total_rows - 1);

?>
        <table>
                <tr>
                    <th>
                        NIS
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 0)" alt="Sort">
                    </th>
                    <th>
                        Nama Santri
                        <img src="icon/sort.png" width=15 class "sort-icon" onclick="toggleSortIcon(this, 1)" alt="Sort">
                    </th>
                    <th>
                        Tanggal Setoran
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 2)" alt="Sort">
                    </th>
                    <th>
                        Hafalan yang Disetor
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 3)" alt="Sort">
                    </th>
                    <th>
                        Nilai
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 4)" alt="Sort">
                    </th>
                    <th>
                        Total Halaman
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 5)" alt="Sort">
                    </th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    $counter = 0;
                    while ($row = $result->fetch_assoc()) {
                        $counter++;
                        if ($counter < $start_index + 1) {
                            continue;
                        }
                        if ($counter > $end_index + 1) {
                            break;
                        }
                
                        echo "<tr>";
                        echo "<td>" . $row["nis"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
                        echo "<td>" . $row["hafalan"] . "</td>";
                        echo "<td>" . $row["nilai"] . "</td>";
                        echo "<td>" . $row["total_hafalan"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data hafalan.</td></tr>";
                }
                
                $conn->close();
                ?>
            </table>
            <div class="pagination">
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a>';
    }
    ?>
</div>

        </div>
    </div>
</body>
</html>
