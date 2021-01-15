<?php

    include "../../config/koneksi.php";

    // DEKLARASI VARIABLE
    $id         = $_GET['id'];
    $status     = $_GET['status'];
    $harga      = $_GET['harga'];
    $tanggal    = date('Y-m-d');

    //QUERY
    $update_monitoring  = "UPDATE `monitoring_aset` SET `ajukan_aset` = 'sudah' WHERE `id_monitoring_aset` = $id";
    $insert_pengajuan   = "
        INSERT INTO `pengajuan_aset`(`id_monitoring_aset`, `tanggal_pengajuan`, `status_pengajuan`, `status_aset`, `harga_perkiraan`, `id_user`)
        VALUES ($id, '$tanggal', 1, '$status', $harga, 1);
    ";

    if(isset($_GET['id'])) {
        $query_update   = mysqli_query($koneksi, $update_monitoring);
        $query_insert   = mysqli_query($koneksi, $insert_pengajuan);

        if($query_insert) {
            echo "<script>alert('Data berhasil diajukan.');</script>";
            echo "<script>document.location = '../media.php?page=rekomendasi_aset';</script>";
        } else {
            echo "<script>alert(".$query_insert.");</script>";
            echo "<script>document.location = '../media.php?page=rekomendasi_aset';</script>";    
        }

    } else {
        echo "<script>alert('Tidak ada data yang terpilih');</script>";
    }

    
?>