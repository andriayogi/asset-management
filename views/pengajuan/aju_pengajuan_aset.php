<?php

    include "../../config/koneksi.php";

    // DEKLARASI VARIABLE
    $id          = $_GET['id'];
    $role        = $_GET['role'];
    $status      = $_GET['status'];
    $persetujuan = date('Y-m-d');
    
    if($role == "disdakmen") {
        if($status == "setuju") {
            $query = "UPDATE pengajuan_aset SET status_pengajuan = 2, tanggal_persetujuan = '$persetujuan' WHERE id_monitoring_aset = $id";
        } else {
            $query = "UPDATE pengajuan_aset SET status_pengajuan = 4, tanggal_persetujuan = '$persetujuan' WHERE id_monitoring_aset = $id";
        }
    } else if($role == "yayasan") {
        if($status == "setuju") {
            $query = "UPDATE pengajuan_aset SET status_pengajuan = 3, tanggal_persetujuan = '$persetujuan' WHERE id_monitoring_aset = $id";
        } else {
            $query = "UPDATE pengajuan_aset SET status_pengajuan = 5, tanggal_persetujuan = '$persetujuan' WHERE id_monitoring_aset = $id";
        }
    }
    
    if(isset($_GET['id'])) {
        $query_update   = mysqli_query($koneksi, $query);
        
        if($query_update) {
            echo "<script>alert('Data berhasil Diproses.');</script>";
            echo "<script>document.location = '../media.php?page=pengajuan_aset';</script>";
        } else {
            echo "<script>alert(".$query_update.");</script>";
            echo "<script>document.location = '../media.php?page=pengajuan_aset';</script>";    
        }

    } else {
        echo "<script>alert('Tidak ada data yang terpilih');</script>";
    }
    
?>