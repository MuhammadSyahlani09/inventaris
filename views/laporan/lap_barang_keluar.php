<?php hakAkses(['admin','manager']); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="<?= base_url() ?>" class="navbar-brand">
                
            </a> Barang Keluar
        </h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url(); ?>process/lap_barang_keluar.php" method="post" target="_blank">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jenis_laporan">Jenis Laporan</label>
                            <select name="jenis_laporan" id="jenis_laporan" class="form-control">
                                <option value="perhari">Per Hari</option>
                                <option value="perbulan">Per Bulan</option>
                                <option value="pertahun">Per Tahun</option>
                                <option value="pilih_tanggal">Pilih Tanggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 p-2">
                        <button type="submit" class="btn btn-info mt-4"><i class="fas fa-print"></i> Cetak
                            Laporan</button>
                        <button type="button" name="tampilkan" class="btn btn-primary mt-4" id="tampilkanButton"><i class="fas fa-eye"></i> Tampilkan
                            Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tampilkan data laporan -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            // Proses pengecekan form laporan sudah di-submit atau belum
            if (isset($_POST['tampilkan'])) {
                $tanggal_awal = $_POST['tanggal_awal'];
                $tanggal_akhir = $_POST['tanggal_akhir'];
                $jenis_laporan = $_POST['jenis_laporan'];

                // Tampilkan data sesuai jenis laporan yang dipilih
                switch ($jenis_laporan) {
                    case 'perhari':
                        // Tampilkan data laporan per hari
                        $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal = '$tanggal_awal'");
                        if (mysqli_num_rows($query) > 0) {
                            echo "<h5>Data Laporan Per Hari</h5>";
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($query)) {
                                // Tampilkan data laporan per hari sesuai struktur tabel
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
                        // Tampilkan data laporan per bulan
                        $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                        if (mysqli_num_rows($query) > 0) {
                            echo "<h5>Data Laporan Per Bulan</h5>";
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($query)) {
                                // Tampilkan data laporan per bulan sesuai struktur tabel
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
                        // Tampilkan data laporan per tahun
                        $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE YEAR(tanggal) = YEAR('$tanggal_awal')");
                        if (mysqli_num_rows($query) > 0) {
                            echo "<h5>Data Laporan Per Tahun</h5>";
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($query)) {
                                // Tampilkan data laporan per tahun sesuai struktur tabel
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
                        // Tampilkan data laporan berdasarkan tanggal yang dipilih
                        $query = mysqli_query($con, "SELECT * FROM laporan_barang_keluar WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                        if (mysqli_num_rows($query) > 0) {
                            echo "<h5>Data Laporan Berdasarkan Tanggal</h5>";
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($query)) {
                                // Tampilkan data laporan berdasarkan tanggal yang dipilih sesuai struktur tabel
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
        </div>
    </div>
</div>

<script>
    document.getElementById('tampilkanButton').addEventListener('click', function () {
        document.querySelector('form').submit();
    });
</script>
