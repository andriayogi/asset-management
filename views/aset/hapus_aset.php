<?php
    include "../../config/koneksi.php";

    if(isset($_GET['id'])) {
        
        $id     = $_GET['id'];
        $query  = "DELETE FROM `data_aset` WHERE `id_aset` = $id";
        $sql    = mysqli_query($koneksi,$query);

        if($sql) {
            header("Location:../media.php?page=aset");
        } else {
            echo "<script>alert(".$sql.");</script>";
            echo "<script>document.location = '../views/media.php?page=aset';</script>";    
        }
        
    } else {
        echo "<script>alert('Tidak ada data yang terpilih');</script>";
    }
?>