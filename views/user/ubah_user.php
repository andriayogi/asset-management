<?php

    include "../../config/koneksi.php";

    //DEKLARASI VARIABLE
    if(isset($_POST['ubah'])) {
        $id_user    = $_POST['id_user'];
        $nama_user  = $_POST['nama_user'];
        $nip        = $_POST['nip'];
        if($_POST['password'] != "") {
            $password   = sha1($_POST['password']);
        } else {
            $password   = "";
        }
        $nama_role  = $_POST['nama_role'];
        if($nama_role == 'kepsek' || $nama_role == 'admin') {
            $role_location = $_POST['role_location'];
        } else {
            $role_location = '-';
        }

        if(!$id_user) {
            echo "<script>alert('Data Tidak Ada')</script>";
            header("Location:../media.php?page=user");
        } else {
            if($password != "") {
                $query  = "UPDATE `data_user` SET `nama_user` = '$nama_user', `nip` = '$nip', `password` = '$password', `nama_role` = '$nama_role', `role_location` = '$role_location' WHERE `id_user` = '$id_user'";
            } else {
                $query  = "UPDATE `data_user` SET `nama_user` = '$nama_user', `nip` = '$nip', `nama_role` = '$nama_role', `role_location` = '$role_location' WHERE `id_user` = '$id_user'";
            }
            $sql    = mysqli_query($koneksi, $query);
?>
            <script>
                alert('Data Berhasil Diubah');
                document.location = '../media.php?page=user';
            </script>
<?php
        }
    }
           
?>