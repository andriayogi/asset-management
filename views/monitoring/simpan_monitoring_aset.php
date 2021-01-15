<?php

    include "../../config/koneksi.php";

    // DEKLARASI VARIABLE
    $id_aset        = $_POST['id_aset'];
    $jumlah_aset    = $_POST['jumlah_aset'];
    $kondisi_aset   = $_POST['kondisi_aset'];
    $lokasi_aset    = $_POST['lokasi_aset'];

    if($kondisi_aset == "Sangat Rusak") {
        $prioritas_aset = "Sangat Berprioritas";
    } else if($kondisi_aset == "Rusak") {
        $prioritas_aset = "Berprioritas";
    } else if($kondisi_aset == "Kurang Baik") {
        $prioritas_aset = "Cukup Berprioritas";
    } else if($kondisi_aset == "Baik") {
        $prioritas_aset = "Kurang Berprioritas";
    }

    // QUERY SIMPAN
    if(isset($_POST['simpan'])) {
        $query = mysqli_query($koneksi, "INSERT INTO `monitoring_aset`(`id_aset`, `jumlah_aset`, `kondisi_aset`, `lokasi_aset`, `prioritas_aset`) VALUES ($id_aset, $jumlah_aset, '$kondisi_aset', '$lokasi_aset', '$prioritas_aset');") or die (mysqli_error($koneksi));
?>

        <script>
            alert('Data Berhasil Disimpan');
            document.location = '../media.php?page=monitoring_aset';
        </script>

<?php
    }
?>