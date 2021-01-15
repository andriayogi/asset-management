<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Monitoring Aset</h1>
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
                <form class="form-horizontal" action="#" method="post">
                <div class="row">
                    <div class="col-md-2">
                            <select name="periode" id="periode" class="form-control">
                                <option value="1">Periode ke-1 (Januari s.d. Maret)</option>
                                <option value="2">Periode ke-2 (April s.d. Juni)</option>
                                <option value="3">Periode ke-3 (Juli s.d. September)</option>
                                <option value="4">Periode ke-4 (Oktober s.d. Desember)</option>
                            </select>
                    </div>
                    <div class="col-md-1">
                            <input type="text" class="form-control datepickertahun" id="tahun" name="tahun" placeholder="Tahun" required autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" name="cari">
                            <i class="fa fa-search"></i> Cari
                        </button>
                        <?php if(isset($_POST['cari'])) { ?>
                            <a href="../views/media.php?page=monitoring_aset" class="btn btn-success"><i class="fa fa-refresh"></i> Bersihkan</a>
                        <?php } ?>
                    </div>
                </div>
                </form>
                <?php
                    include "../config/koneksi.php";
                    if($_SESSION['role'] == 'kepsek' || $_SESSION['role'] == 'admin') {
                        $detail = $_SESSION['detail'];
                    } else {
                        $split_lokasi = explode("=", $_SERVER['REQUEST_URI']);
                        $detail = $split_lokasi[2];
                    }
                    if($_SESSION['role'] == 'disdakmen') {
                        if(isset($_POST['cari'])) {
                            $periode    = $_POST['periode'];
                            $tahun      = $_POST['tahun'];
                            $query_monitoring = "
                                SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                                FROM data_aset
                                INNER JOIN monitoring_aset
                                ON data_aset.id_aset = monitoring_aset.id_aset
                                WHERE periode_monitoring = '$periode'
                                AND tahun_monitoring = '$tahun'
                                AND lokasi_aset = '$detail'
                                AND kondisi_aset != 'Baik'
                            ";
                            echo "<h3>Periode $periode Tahun $tahun</h3>";
                        } else {
                            $query_monitoring = "
                                SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                                FROM data_aset
                                INNER JOIN monitoring_aset
                                ON data_aset.id_aset = monitoring_aset.id_aset
                                WHERE lokasi_aset = '$detail'
                                AND kondisi_aset != 'Baik'
                            ";
                            echo "<br>";
                        }
                    } else {
                        if(isset($_POST['cari'])) {
                            $periode    = $_POST['periode'];
                            $tahun      = $_POST['tahun'];
                            $query_monitoring = "
                                SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                                FROM data_aset
                                INNER JOIN monitoring_aset
                                ON data_aset.id_aset = monitoring_aset.id_aset
                                WHERE periode_monitoring = '$periode'
                                AND tahun_monitoring = '$tahun'
                                AND lokasi_aset = '$detail'
                            ";
                            echo "<h3>Periode $periode Tahun $tahun</h3>";
                        } else {
                            $query_monitoring = "
                                SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                                FROM data_aset
                                INNER JOIN monitoring_aset
                                ON data_aset.id_aset = monitoring_aset.id_aset
                                WHERE lokasi_aset = '$detail'
                            ";
                            echo "<br>";
                        }
                    }
                    $hasil = mysqli_query($koneksi, $query_monitoring);
                ?>
                <table id="example1" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <!-- <th>Tahun Perolehan</th> -->
                            <th>Jumlah</th>
                            <th>Kondisi Aset</th>
                            <th>Lokasi Aset</th>
                            <!-- <th>Prioritas Aset</th> -->
                            <!-- <th>Periode Monitoring</th> -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($hasil != null) {
                                $count = 1;
                                while($kolom = mysqli_fetch_array($hasil)) {
                                    $tahun = $kolom['tahun_monitoring'] - $kolom['tahun_aset'];
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $kolom['kode_aset']; ?></td>
                            <td><?php echo $kolom['nama_aset']; ?></td>
                            <!-- <td><?php echo $tahun; ?> Tahun</td> -->
                            <td><?php echo "1"; ?></td>
                            <td><?php echo $kolom['kondisi_aset']; ?></td>
                            <td><?php echo strtoupper($kolom['lokasi_aset']); ?> Muhammadiyah</td>
                            <!-- <td><?php echo $kolom['prioritas_aset']; ?></td> -->
                            <!-- <td>Periode <?php echo $kolom['periode_monitoring']; ?> Tahun <?php echo $kolom['tahun_monitoring']; ?></td> -->
                            <!-- <td align="center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit-data<?php echo $kolom['id_monitoring_aset']; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <a class="btn btn-danger" href="monitoring/hapus_monitoring_aset.php?page=hapus_monitoring_aset&id=<?php echo $kolom['id_monitoring_aset']; ?>" onclick="if(confirm('Apakah anda yakin akan menghapus?')){return true;} else {return false;}"><i class="fa fa-trash-o"></i> Hapus</a>
                            </td> -->
                        </tr>
                        <?php
                                    $count++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
    <!-- /.row -->

</section>
<!-- /.content -->