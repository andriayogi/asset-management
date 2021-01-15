<?php

    include "../../config/koneksi.php";

    // DEKLARASI VARIABLE
    $nama_user  = $_POST['nama_user'];
    $nip        = $_POST['nip'];
    $password   = sha1($_POST['password']);
    $nama_role  = $_POST['nama_role'];
    if($nama_role == 'kepsek' || $nama_role == 'admin') {
        $role_location = $_POST['role_location'];
    } else {
        $role_location = '-';
    }

    // PENGECEKAN NIP
    $check = mysqli_query($koneksi, "SELECT * FROM `data_user` WHERE nip=$nip");
    $nip_cek = $check->num_rows;

    // QUERY SIMPAN
    if(isset($_POST['simpan'])) {
        if($nip_cek == 0) {
            $query = mysqli_query($koneksi, "INSERT INTO `data_user`(`nama_user`, `nip`, `password`, `nama_role`, `role_location`) VALUES ('$nama_user', '$nip', '$password', '$nama_role', '$role_location');") or die (mysqli_error($koneksi));
?>

            <script>
                alert('Data Berhasil Disimpan.');
                document.location = '../media.php?page=user';
            </script>

<?php
        } else {
?>

            <script>
                alert('Mohon maaf, NIP sudah ada.');
                document.location = '../media.php?page=user';
            </script>

<?php
        }
    }
?>