<?php
include "../connection.php";

$id = $_GET['id'];
$query = "SELECT * FROM jurnal_pembina WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if ($data) {
    echo '<div class="modal-content-wrapper">';
    echo '<h3 class="modal-title">Detail Jurnal Pembina</h3>';
    echo '<div class="modal-sections">';
    
    // Sections and their respective fields
    $sections = [
        'Informasi Umum' => ['tanggal', 'jumlah_santri', 'jumlah_santri_sakit', 'jumlah_santri_izin'],
        'Kegiatan Pagi' => ['membangunkan_santri', 'shalat_tahajjud_santri', 'santri_ke_masjid', 'shalat_shubuh_santri', 'tahfizh_santri', 'setoran_shubuh', 'sarapan', 'piket', 'sarana_prasarana', 'merapikan_kamar', 'berangkat_sekolah', 'berpakaian_rapi'],
        'Kegiatan Siang' => ['tutor_bahasa', 'shalat_dzuhur_santri', 'makan_siang', 'makan_siang_bersama', 'shalat_ashar_santri', 'membaca_almatsurat_santri'],
        'Kegiatan Malam' => ['makan_malam', 'makan_malam_bersama', 'shalat_maghrib_santri', 'halaqah_tahfizh', 'shalat_isya_santri', 'kegiatan_bakda_isya', 'evaluasi_asrama', 'penyetoran_bahasa_malam', 'berwudhu_sebelum_tidur', 'memastikan_santri_diasrama', 'sop_sandal'],
        'Tugas Pembina' => ['komunikasi_orangtua', 'dokumen_santri', 'pemanggilan_santri', 'mengisi_database_santri', 'mengontrol_laundry', 'kebersihan_malam', 'menjaga_sarana_prasarana'],
        'Ibadah Pembina' => ['bangun_sebelum_shubuh', 'shalat_tahajjud_pembina', 'shalat_shubuh_pembina', 'shalat_dhuha_pembina', 'shalat_dzuhur_pembina', 'shalat_ashar_pembina', 'membaca_almatsurat_pembina', 'shalat_maghrib_pembina', 'shalat_isya_pembina', 'tilawah', 'puasa_sunnah']
    ];

    $sectionIndex = 0;
    foreach ($sections as $section_title => $fields) {
        echo "<div class='modal-section' data-index='{$sectionIndex}'>";
        echo "<h4>{$section_title}</h4>";
        echo "<div class='modal-fields'>";
        foreach ($fields as $field) {
            $label = ucwords(str_replace('_', ' ', $field));
            $value = $data[$field];
            echo "<div class='modal-field'><strong>{$label}:</strong> <span>{$value}</span></div>";
        }
        echo "</div></div>";
        $sectionIndex++;
    }

    echo '</div></div>';

    // CSS styles
    echo "
    <style>
    .modal-content-wrapper {
        font-family: 'Arial', sans-serif;
        color: #333;
        max-height: 80vh;
        overflow-y: auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .modal-title {
        text-align: center;
        color: #2E8B57;
        margin-bottom: 20px;
        font-size: 24px;
        animation: fadeIn 0.5s ease-out;
    }
    .modal-sections {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .modal-section {
        width: calc(50% - 10px);
        margin-bottom: 20px;
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: slideIn 0.5s ease-out;
    }
    .modal-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .modal-section h4 {
        color: #2E8B57;
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
        border-bottom: 2px solid #2E8B57;
        padding-bottom: 5px;
    }
    .modal-field {
        margin-bottom: 8px;
        font-size: 14px;
        transition: background-color 0.3s ease;
        padding: 5px;
        border-radius: 4px;
    }
    .modal-field:hover {
        background-color: #f0f0f0;
    }
    .modal-field strong {
        color: #3CB371;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @media (max-width: 768px) {
        .modal-section {
            width: 100%;
        }
    }
    </style>
    ";

    // JavaScript for animations
    echo "
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var sections = document.querySelectorAll('.modal-section');
        for (var i = 0; i < sections.length; i++) {
            var section = sections[i];
            var index = section.getAttribute('data-index');
            section.style.animationDelay = (index * 0.1) + 's';
        }

        var fields = document.querySelectorAll('.modal-field');
        for (var j = 0; j < fields.length; j++) {
            var field = fields[j];
            field.addEventListener('mouseenter', function() {
                this.style.transition = 'background-color 0.3s ease';
                this.style.backgroundColor = '#f0f0f0';
            });
            field.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
        }
    });
    </script>
    ";
} else {
    echo "<p class='error-message'>Data tidak ditemukan.</p>";
    echo "
    <style>
    .error-message {
        color: #ff4136;
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
    }
    </style>
    ";
}
?>