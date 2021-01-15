<?php

    include "../../config/koneksi.php";

    //DEKLARASI VARIABLE
    if(isset($_POST['ubah'])) {
        $id_aset            = $_POST['id_aset'];
        $kode_aset          = $_POST['kode_aset'];
        $nama_aset          = $_POST['nama_aset'];
        $harga_aset         = $_POST['harga_aset'];
        $tahun_aset         = $_POST['tahun_aset'];
        $lokasi_aset        = $_POST['lokasi_aset'];
        $kondisi_aset       = $_POST['kondisi_aset'];
        $prioritas_aset     = $_POST['prioritas_aset'];
        $periode_monitoring = $_POST['periode_monitoring'];
        $tahun_monitoring   = $_POST['tahun_monitoring'];

        if(!$id_aset) {
            echo "<script>alert('Data Tidak Ada')</script>";
            header("Location:../media.php?page=aset");
        } else {
            $query_aset         = "UPDATE `data_aset` SET `kode_aset` = '$kode_aset', `nama_aset` = '$nama_aset', `tahun_aset` = '$tahun_aset', `harga_aset` = '$harga_aset' WHERE `id_aset` = '$id_aset'";
            $query_monitoring   = "UPDATE `monitoring_aset` SET `periode_monitoring` = '$periode_monitoring', `tahun_monitoring` = '$tahun_monitoring', `kondisi_aset` = '$kondisi_aset', `lokasi_aset` = '$lokasi_aset', `prioritas_aset` = '$prioritas_aset' WHERE `id_aset` = '$id_aset'";
            $ubah_aset          = mysqli_query($koneksi, $query_aset);
            $ubah_monitoring    = mysqli_query($koneksi, $query_monitoring);
?>
            <script>
                alert('Data Berhasil Diubah');
                document.location = '../media.php?page=aset';
            </script>
<?php
        }
    }
?>