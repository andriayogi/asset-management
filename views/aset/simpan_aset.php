<?php

    include "../../config/koneksi.php";

    // DEKLARASI VARIABLE
    $kode_aset          = $_POST['kode_aset'];
    $nama_aset          = $_POST['nama_aset'];
    $harga_aset         = $_POST['harga_aset'];
    $tahun_aset         = $_POST['tahun_aset'];
    $jumlah_aset        = $_POST['jumlah_aset'];
    $lokasi_aset        = $_SESSION['detail'];
    $kondisi_aset       = $_POST['kondisi_aset'];
    $prioritas_aset     = $_POST['prioritas_aset'];
    $periode_monitoring = $_POST['periode_monitoring'];
    $tahun_monitoring   = $_POST['tahun_monitoring'];

    // PENGECEKAN KODE ASET
    $check      = "SELECT kode_aset FROM data_aset WHERE kode_aset LIKE '$kode_aset%'";
    $sql_check  = mysqli_query($koneksi, $check);
    $count_aset = $sql_check->num_rows;
    
    // QUERY SIMPAN
    if(isset($_POST['simpan'])) {
        for($i = 0; $i < $jumlah_aset; $i++) {
            // INSERT ASET
            $counter    = $count_aset + $i + 1;
            $kode       = $kode_aset.".".strtoupper($lokasi_aset).".".$counter;
            $query_aset = "
                INSERT INTO `data_aset` (`kode_aset`, `nama_aset`, `harga_aset`, `tahun_aset`)
                VALUES('$kode', '$nama_aset', $harga_aset, '$tahun_aset');
            ";
            $query1 = mysqli_query($koneksi, $query_aset) or die (mysqli_error($koneksi));
            if($query1) {
                $last_id_aset = mysqli_insert_id($koneksi);
                // INSERT MONITORING ASET
                $query_monitoring = "
                    INSERT INTO `monitoring_aset` (`id_aset`, `periode_monitoring`, `tahun_monitoring`, `jumlah_aset`, `kondisi_aset`, `lokasi_aset`, `prioritas_aset`) 
                    VALUES($last_id_aset, '$periode_monitoring', '$tahun_monitoring', 1, '$kondisi_aset', '$lokasi_aset', '$prioritas_aset');
                ";
                $query2 = mysqli_query($koneksi, $query_monitoring) or die (mysqli_error($koneksi));
            }
        }
?>
        <script>
            alert('Data Berhasil Disimpan');
            document.location = '../media.php?page=aset';
        </script>
<?php
    } else {
?>
        <script>
            alert('Data Gagal Disimpan');
            document.location = '../media.php?page=aset';
        </script>
<?php
    }
?>