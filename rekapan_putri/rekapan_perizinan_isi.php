<?php
session_start();
include "connection.php";

// Ambil data dari tabel tahfizh_hafalan
$sql = "SELECT * FROM perizinan_isi";
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
    </style>
    <title>Rekapan Perizinan Santri</title>
</head>
<body>
    <div class="container">
    <div>
            <a href="rekapan.php"><img src="icon/back_icon.png" alt="back"></a>
        </div>
        <h1>Rekapan Perizinan Santri</h1>
        <div class="table-container">
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
                        Dari Tanggal
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 2)" alt="Sort">
                    </th>
                    <th>
                        Sampai Tanggal
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 3)" alt="Sort">
                    </th>
                    <th>
                        Keperluan
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 4)" alt="Sort">
                    </th>
                    <th>
                        Durasi (Hari)
                        <img src="icon/sort.png" width=15 class="sort-icon" onclick="toggleSortIcon(this, 5)" alt="Sort">
                    </th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nis"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["daritanggal"] . "</td>";
                        echo "<td>" . $row["sampaitanggal"] . "</td>";
                        echo "<td>" . $row["keperluan"] . "</td>";
                        echo "<td>" . $row["durasi"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data Perizinan.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
