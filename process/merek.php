<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');
//proses tambah
if(isset($_POST['tambah'])){
    $nama_merek = $_POST['nama_merek'];
    $keterangan = $_POST['keterangan'];

    
    $insert = mysqli_query($con,"INSERT INTO merek (nama_merek, keterangan) VALUES ('$nama_merek','$keterangan')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data merek';
    }else{
        $error = 'Gagal menambahkan data merek';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../admin.php?merek');
}
//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM merek WHERE idmerek='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data merek';
    }else{
        $error = 'Gagal menghapus data merek';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../admin.php?merek');
}

?>