<?php
    include "../../config/koneksi.php";

    if(isset($_GET['id'])) {
        
        $id     = $_GET['id'];
        $query  = "DELETE FROM `data_user` WHERE `id_user` = $id";
        $sql    = mysqli_query($koneksi,$query);

        if($sql) {
            header("Location:../media.php?page=user");
        } else {
            echo "<script>alert(".$sql.");</script>";
            echo "<script>document.location = '../views/media.php?page=user';</script>";    
        }
        
    } else {
        echo "<script>alert('Tidak ada data yang terpilih');</script>";
    }
?>