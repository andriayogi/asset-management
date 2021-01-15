<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Profile</h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
    <div class="col-md-12">

        <div class="box box-primary">
        <!-- <div class="box-header">
            <h3 class="box-title">Input masks</h3>
        </div> -->
        <div class="box-body">
            NIP : <?php echo $_SESSION['nip'] ?>
            <hr>
            Nama : <?php echo $_SESSION['nama'] ?>
            <hr>
            Jabatan : <?php
                if($_SESSION['role'] == 'disdakmen') {
                    echo "Disdakmen";
                } else if($_SESSION['role'] == 'yayasan') {
                    echo "Ketua Yayasan";
                } else if($_SESSION['role'] == 'kepsek_sd') {
                    echo "Kepala Sekolah SD";
                } else if($_SESSION['role'] == 'kepsek_smp') {
                    echo "Kepala Sekolah SMP";
                } else if($_SESSION['role'] == 'kepsek_sma') {
                    echo "Kepala Sekolah SMA";
                } else if($_SESSION['role'] == 'kepsek_smk') {
                    echo "Kepala Sekolah SMK";
                }
            ?>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col (left) -->
    
    <!-- /.col (right) -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->