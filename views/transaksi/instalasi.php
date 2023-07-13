<?php hakAkses(['admin']); 
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Instalasi</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#instalasi_modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <a href="<?=base_url();?>process/cetak_instalasi.php" target="_blank" class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>NO TELEPON</th>
                            <th>EMAIL</th>
                            <th>JUMLAH SAKLAR</th>
                            <th>JUMLAH STOPKONTAK</th>
                            <th>JUMLAH FITTING</th>
                            <th>JUMLAH MCB</th>
                            <th>JUMLAH TITIK INSTALASI</th>
                            <th>TEKNISI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        $query = mysqli_query($con, "SELECT * FROM instalasi ORDER BY id_instalasi DESC") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query)) :
                            $jumlahSaklar = $row['saklar'];
                            $jumlahStopkontak = $row['stopkontak'];
                            $jumlahFitting = $row['fitting'];
                            $jumlahMCB = $row['mcb'];
                            $jumlahTitikInstalasi = $jumlahSaklar + $jumlahStopkontak + $jumlahFitting + $jumlahMCB;
                            $id_teknisi = $row['id_users'];
                            $teknisi_query = mysqli_query($con, "SELECT * FROM users WHERE id_users = '$id_teknisi' AND level = 'teknisi'") or die(mysqli_error($con));
                            $teknisi = mysqli_fetch_assoc($teknisi_query);
                        ?>
                            <tr>
                                <td><?= $n++; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['no_telepon']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $jumlahSaklar; ?></td>
                                <td><?= $jumlahStopkontak; ?></td>
                                <td><?= $jumlahFitting; ?></td>
                                <td><?= $jumlahMCB; ?></td>
                                <td><?= $jumlahTitikInstalasi; ?></td>
                                <td><?= $teknisi['nama']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Modal Tambah Instalasi -->
<div class="modal fade" id="instalasi_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/tambah_instalasi.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Instalasi Listrik</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="saklar">Jumlah Saklar<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="saklar" name="saklar" min="0" required>
                                <select name="barang_id_saklar" id="barang_id_saklar" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?= list_barang(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stopkontak">Jumlah Stopkontak<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stopkontak" name="stopkontak" min="0" required>
                                <select name="barang_id_stopkontak" id="barang_id_stopkontak" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?= list_barang(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fitting">Jumlah Fitting<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="fitting" name="fitting" min="0" required>
                                <select name="barang_id_fitting" id="barang_id_fitting" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?= list_barang(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mcb">Jumlah MCB<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="mcb" name="mcb" min="0" required>
                                <select name="barang_id_mcb" id="barang_id_mcb" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?= list_barang(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telepon">Nomor Telepon<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_titik_instalasi">Jumlah Titik Instalasi<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="jumlah_titik_instalasi" name="jumlah_titik_instalasi" min="0" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="teknisi">Teknisi<span class="text-danger">*</span></label>
                                <select name="teknisi" id="teknisi" class="form-control" required>
                                    <option value="">-- Pilih Teknisi --</option>
                                    <?php
                                    $query_teknisi = mysqli_query($con, "SELECT * FROM users WHERE level = 'teknisi'") or die(mysqli_error($con));
                                    while ($teknisi = mysqli_fetch_array($query_teknisi)) :
                                    ?>
                                        <option value="<?= $teknisi['id_users']; ?>"><?= $teknisi['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit" name="tambah">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal -->
<!-- End of Main Content -->
<script>
    // Ambil referensi input jumlah saklar, stopkontak, fitting, dan MCB
var saklarInput = document.getElementById('saklar');
var stopkontakInput = document.getElementById('stopkontak');
var fittingInput = document.getElementById('fitting');
var mcbInput = document.getElementById('mcb');

// Ambil referensi input jumlah titik instalasi
var jumlahTitikInstalasiInput = document.getElementById('jumlah_titik_instalasi');

// Tambahkan event listener untuk menghitung jumlah titik instalasi saat input berubah
saklarInput.addEventListener('input', hitungJumlahTitikInstalasi);
stopkontakInput.addEventListener('input', hitungJumlahTitikInstalasi);
fittingInput.addEventListener('input', hitungJumlahTitikInstalasi);
mcbInput.addEventListener('input', hitungJumlahTitikInstalasi);

// Fungsi untuk menghitung jumlah titik instalasi
function hitungJumlahTitikInstalasi() {
    var jumlahSaklar = parseInt(saklarInput.value) || 0;
    var jumlahStopkontak = parseInt(stopkontakInput.value) || 0;
    var jumlahFitting = parseInt(fittingInput.value) || 0;
    var jumlahMCB = parseInt(mcbInput.value) || 0;

    var jumlahTitikInstalasi = jumlahSaklar + jumlahStopkontak + jumlahFitting + jumlahMCB;

    jumlahTitikInstalasiInput.value = jumlahTitikInstalasi;
}


</script>
<!-- /.modal -->
<!-- End of Main Content -->