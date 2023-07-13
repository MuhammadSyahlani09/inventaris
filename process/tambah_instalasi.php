<?php
session_start();
include('../config/conn.php');
include('../config/function.php');

// Proses tambah instalasi
if (isset($_POST['tambah'])) {
    $tanggal = mysqli_real_escape_string($con, $_POST['tanggal']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $saklar = $_POST['saklar'];
    $barang_id_saklar = $_POST['barang_id_saklar'];
    $stopkontak = $_POST['stopkontak'];
    $barang_id_stopkontak = $_POST['barang_id_stopkontak'];
    $fitting = $_POST['fitting'];
    $barang_id_fitting = $_POST['barang_id_fitting'];
    $mcb = $_POST['mcb'];
    $barang_id_mcb = $_POST['barang_id_mcb'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $jumlah_titik_instalasi = $_POST['jumlah_titik_instalasi'];
    $id_teknisi = mysqli_real_escape_string($con, $_POST['teknisi']);

    // Proses pengurangan stok barang
    $query_update_saklar = mysqli_query($con, "UPDATE barang SET stok = stok - $saklar WHERE idbarang = $barang_id_saklar");
    $query_update_stopkontak = mysqli_query($con, "UPDATE barang SET stok = stok - $stopkontak WHERE idbarang = $barang_id_stopkontak");
    $query_update_fitting = mysqli_query($con, "UPDATE barang SET stok = stok - $fitting WHERE idbarang = $barang_id_fitting");
    $query_update_mcb = mysqli_query($con, "UPDATE barang SET stok = stok - $mcb WHERE idbarang = $barang_id_mcb");

    // Insert data ke tabel instalasi
    $query_insert = mysqli_query($con, "INSERT INTO instalasi (tanggal, nama, alamat, saklar, stopkontak, fitting, mcb, no_telepon, email, jumlah_titik_instalasi, id_users) VALUES ('$tanggal', '$nama', '$alamat', '$saklar', '$stopkontak', '$fitting', '$mcb', '$no_telepon', '$email', '$jumlah_titik_instalasi', '$id_teknisi')");

    // Menghitung jumlah titik instalasi
    $jumlah_titik_instalasi = $saklar + $stopkontak + $fitting + $mcb;

    // Memasukkan data instalasi ke dalam tabel instalasi
    $insert = mysqli_query($con, "INSERT INTO instalasi (tanggal, nama, alamat, saklar, stopkontak, fitting, mcb, no_telepon, email, id_users, jumlah_titik_instalasi)
            VALUES ('$tanggal', '$nama', '$alamat', $saklar, $stopkontak, $fitting, $mcb, '$no_telepon', '$email', $id_teknisi, $jumlah_titik_instalasi)");

if ($query_insert && $query_update_saklar && $query_update_stopkontak && $query_update_fitting && $query_update_mcb) {
    // Jika berhasil, redirect ke halaman transaksi instalasi
    $_SESSION['success'] = 'Berhasil menambahkan data instalasi';
} else {
    // Jika gagal, set notifikasi gagal
    $_SESSION['error'] = 'Gagal menambahkan data instalasi';
}

header('Location:../admin.php?instalasi');
}
?>
