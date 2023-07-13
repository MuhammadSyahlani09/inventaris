<?php
// session_start();
include ('../config/conn.php');
include ('../config/function.php');

if (isset($_POST['tanggal_awal']) && isset($_POST['tanggal_akhir']) && isset($_POST['jenis_laporan'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $jenis_laporan = $_POST['jenis_laporan'];

    switch ($jenis_laporan) {
        case 'perhari':
            $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal = '$tanggal_awal'");
            if (mysqli_num_rows($query) > 0) {
                echo "<h5>Data Laporan Per Hari</h5>";
                echo "<div class='row'>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "ID: " . $row['id'] . "<br>";
                    echo "Tanggal: " . $row['tanggal'] . "<br>";
                    echo "Barang Keluar: " . $row['barang_keluar'] . "<br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Tidak ada data laporan per hari";
            }
            break;
        case 'perbulan':
            $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            if (mysqli_num_rows($query) > 0) {
                echo "<h5>Data Laporan Per Bulan</h5>";
                echo "<div class='row'>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "ID: " . $row['id'] . "<br>";
                    echo "Tanggal: " . $row['tanggal'] . "<br>";
                    echo "Barang Keluar: " . $row['barang_keluar'] . "<br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Tidak ada data laporan per bulan";
            }
            break;
        case 'pertahun':
            $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE YEAR(tanggal) = YEAR('$tanggal_awal')");
            if (mysqli_num_rows($query) > 0) {
                echo "<h5>Data Laporan Per Tahun</h5>";
                echo "<div class='row'>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "ID: " . $row['id'] . "<br>";
                    echo "Tanggal: " . $row['tanggal'] . "<br>";
                    echo "Barang Keluar: " . $row['barang_keluar'] . "<br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Tidak ada data laporan per tahun";
            }
            break;
        case 'pilih_tanggal':
            $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            if (mysqli_num_rows($query) > 0) {
                echo "<h5>Data Laporan Berdasarkan Tanggal</h5>";
                echo "<div class='row'>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "ID: " . $row['id'] . "<br>";
                    echo "Tanggal: " . $row['tanggal'] . "<br>";
                    echo "Barang Keluar: " . $row['barang_keluar'] . "<br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "Tidak ada data laporan berdasarkan tanggal yang dipilih";
            }
            break;
        default:
            echo "Jenis laporan tidak valid";
            break;
    }
}
?>
