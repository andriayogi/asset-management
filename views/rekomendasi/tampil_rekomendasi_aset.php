<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Rekomendasi Aset</h1>
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
                            <a href="../views/media.php?page=rekomendasi_aset" class="btn btn-success"><i class="fa fa-refresh"></i> Bersihkan</a>
                        <?php } ?>
                    </div>
                </div>
                </form>
                <?php
                    include "../config/koneksi.php";
                    $detail = $_SESSION['detail'];
                    if(isset($_POST['cari'])) {
                        $periode    = $_POST['periode'];
                        $tahun      = $_POST['tahun'];
                        $query_monitoring = "
                            SELECT data_aset.id_aset, id_monitoring_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset, ajukan_aset
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
                            SELECT data_aset.id_aset, id_monitoring_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset, ajukan_aset
                            FROM data_aset
                            INNER JOIN monitoring_aset
                            ON data_aset.id_aset = monitoring_aset.id_aset
                            WHERE lokasi_aset = '$detail'
                        ";
                        echo "<br>";
                    }
                    $hasil = mysqli_query($koneksi, $query_monitoring);
                    $return = mysqli_query($koneksi, $query_monitoring);
                ?>
                <?php
                    // include "../config/koneksi.php";
                    // $query_monitoring = "
                    //     SELECT data_aset.id_aset, id_monitoring_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset, ajukan_aset
                    //     FROM data_aset
                    //     INNER JOIN monitoring_aset
                    //     ON data_aset.id_aset = monitoring_aset.id_aset
                    // ";
                    // $hasil = mysqli_query($koneksi, $query_monitoring);
                    // $return = mysqli_query($koneksi, $query_monitoring);
                ?>
                <table id="example1" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Lokasi Aset</th>
                            <th>Periode Monitoring</th>
                            <th>Status</th>
                            <th>Perkiraan Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
<!-- BEGIN PERHITUNGAN SAW -->
<?php 
    if($hasil != null) {
        $count = 1;
        $maxC1  = 0;
        $maxC2  = 0;
        $maxC3  = 0;
        $maxC4  = 0;
        while($kolom = mysqli_fetch_array($hasil)) {
            if($kolom['kondisi_aset'] != 'Baik') {
                // PERHITUNGAN TANGGAL SEKARANG - TANGGAL ASET
                $tgl_aset = explode("-",$kolom['tanggal_aset']);
                $year   = date('Y') - $tgl_aset[0];
                $month  = date('m') - $tgl_aset[1];
                $day    = date('d') - $tgl_aset[2];
                if($month < 0) {
                    $year   = $year - 1;
                    $month  = $month + 12;
                }
                if($day < 0) {
                    $month  = $month - 1;
                    $day    = $day + 30;
                }
                $year   = $year * 365;
                $month  = $month * 30;
                $tahun_perolehan = $year + $month + $day;
                $tahun_decimal = $tahun_perolehan / 365;
                
                // MENGHITUNG C1
                if($tahun_decimal > 3) {
                    $c1 = 4;
                } else if($tahun_decimal > 2 ||$tahun_decimal <= 3) {
                    $c1 = 3;
                } else if($tahun_decimal > 1 ||$tahun_decimal <= 2) {
                    $c1 = 2;
                } else if($tahun_decimal > 0 ||$tahun_decimal <= 1) {
                    $c1 = 1;
                }
                
                // PERHITUNGAN HARGA * JUMLAH
                $harga_perolehan = $kolom['harga_aset'] * $kolom['jumlah_aset'];
                
                // MENGHITUNG C2
                if($harga_perolehan > 10000000) {
                    $c2 = 4;
                } else if($harga_perolehan > 5000000 ||$harga_perolehan <= 10000000) {
                    $c2 = 3;
                } else if($harga_perolehan > 1000000 ||$harga_perolehan <= 5000000) {
                    $c2 = 2;
                } else if($harga_perolehan >= 0 ||$harga_perolehan <= 1000000) {
                    $c2 = 1;
                }

                // MENGHITUNG C3
                if($kolom['kondisi_aset'] == "Sangat Rusak") {
                    $c3 = 4;
                } else if($kolom['kondisi_aset'] == "Rusak") {
                    $c3 = 3;
                } else if($kolom['kondisi_aset'] == "Kurang Baik") {
                    $c3 = 2;
                } else if($kolom['kondisi_aset'] == "Baik") {
                    $c3 = 1;
                }

                // MENGHITUNG C4
                if($kolom['prioritas_aset'] == "Sangat Berprioritas") {
                    $c4 = 4;
                } else if($kolom['prioritas_aset'] == "Berprioritas") {
                    $c4 = 3;
                } else if($kolom['prioritas_aset'] == "Cukup Berprioritas") {
                    $c4 = 2;
                } else if($kolom['prioritas_aset'] == "Kurang Berprioritas") {
                    $c4 = 1;
                }

                while($cek = mysqli_fetch_array($return)) {
                    if($cek['kondisi_aset'] != 'Baik') {
                        // PERHITUNGAN TANGGAL SEKARANG - TANGGAL ASET
                        $tgl_aset = explode("-",$cek['tanggal_aset']);
                        $year   = date('Y') - $tgl_aset[0];
                        $month  = date('m') - $tgl_aset[1];
                        $day    = date('d') - $tgl_aset[2];
                        if($month < 0) {
                            $year   = $year - 1;
                            $month  = $month + 12;
                        }
                        if($day < 0) {
                            $month  = $month - 1;
                            $day    = $day + 30;
                        }
                        $year   = $year * 365;
                        $month  = $month * 30;
                        $tahun_perolehan = $year + $month + $day;
                        $tahun_decimal = $tahun_perolehan / 365;
                        
                        // MENGHITUNG C1
                        if($tahun_decimal > 3) {
                            $c1 = 4;
                        } else if($tahun_decimal > 2 ||$tahun_decimal <= 3) {
                            $c1 = 3;
                        } else if($tahun_decimal > 1 ||$tahun_decimal <= 2) {
                            $c1 = 2;
                        } else if($tahun_decimal > 0 ||$tahun_decimal <= 1) {
                            $c1 = 1;
                        }
                        
                        // PERHITUNGAN HARGA * JUMLAH
                        $harga_perolehan = $cek['harga_aset'] * $cek['jumlah_aset'];
                        
                        // MENGHITUNG C2
                        if($harga_perolehan > 10000000) {
                            $c2 = 4;
                        } else if($harga_perolehan > 5000000 ||$harga_perolehan <= 10000000) {
                            $c2 = 3;
                        } else if($harga_perolehan > 1000000 ||$harga_perolehan <= 5000000) {
                            $c2 = 2;
                        } else if($harga_perolehan >= 0 ||$harga_perolehan <= 1000000) {
                            $c2 = 1;
                        }
        
                        // MENGHITUNG C3 DAN C4
                        if($cek['kondisi_aset'] == "Sangat Rusak") {
                            $c3 = 4;
                            $c4 = 4;
                        } else if($cek['kondisi_aset'] == "Rusak") {
                            $c3 = 3;
                            $c4 = 3;
                        } else if($cek['kondisi_aset'] == "Kurang Baik") {
                            $c3 = 2;
                            $c4 = 2;
                        } else if($cek['kondisi_aset'] == "Baik") {
                            $c3 = 1;
                            $c4 = 1;
                        }
        
                        // MENGHITUNG MAX C1 SD C4
                        
                        if($c1 > $maxC1) {
                            $maxC1 = $c1;
                        }
                        if($c2 > $maxC2) {
                            $maxC2 = $c2;
                        }
                        if($c3 > $maxC3) {
                            $maxC3 = $c3;
                        }
                        if($c4 > $maxC4) {
                            $maxC4 = $c4;
                        }
                    }
                }

                // PERHITUNGAN DATA NORMALISASI
                $r1 = $c1 / $maxC1;
                $r2 = $c2 / $maxC2;
                $r3 = $c3 / $maxC3;
                $r4 = $c4 / $maxC4;

                // PERKALIAN HASIL NORMALISASI
                $v1 = number_format($r1 * 0.3, 2);
                $v2 = number_format($r2 * 0.2, 2);
                $v3 = number_format($r3 * 0.1, 2);
                $v4 = number_format($r4 * 0.4, 2);

                // PERHITUNGAN PERANGKINGAN
                $ranking = number_format($v1 + $v2 + $v3 + $v4, 2);

                // STATUS PELAKSANAAN
                if($ranking > 0.7) {
                    $status = "Diganti";
                } else if($ranking >= 0.5 && $ranking <= 0.7) {
                    $status = "Diperbaiki";
                } else if($ranking < 0.5) {
                    $status = "Ditangguhkan";
                }

                // VARIABLE IHK TAHUN PEROLEHAN
                if($kolom['tahun_aset'] == '2014') {
                    $ihk_sebelum = 119;
                } else if($kolom['tahun_aset'] == '2015') {
                    $ihk_sebelum = 122.99;
                } else if($kolom['tahun_aset'] == '2016') {
                    $ihk_sebelum = 126.71;
                } else if($kolom['tahun_aset'] == '2017') {
                    $ihk_sebelum = 131.28;
                } else if($kolom['tahun_aset'] == '2018') {
                    $ihk_sebelum = 135.39;
                } else if($kolom['tahun_aset'] == '2019') {
                    $ihk_sebelum = 139.07;
                } else if($kolom['tahun_aset'] == '2020') {
                    $ihk_sebelum = 139.84;
                }

                // VARIABLE IHK TAHUN MONITORING
                if($kolom['tahun_monitoring'] == '2014') {
                    $ihk_setelah = 119;
                } else if($kolom['tahun_monitoring'] == '2015') {
                    $ihk_setelah = 122.99;
                } else if($kolom['tahun_monitoring'] == '2016') {
                    $ihk_setelah = 126.71;
                } else if($kolom['tahun_monitoring'] == '2017') {
                    $ihk_setelah = 131.28;
                } else if($kolom['tahun_monitoring'] == '2018') {
                    $ihk_setelah = 135.39;
                } else if($kolom['tahun_monitoring'] == '2019') {
                    $ihk_setelah = 139.07;
                } else if($kolom['tahun_monitoring'] == '2020') {
                    $ihk_sebelum = 139.84;
                }

                if($status == "Diganti") {
                    $inflasi    = ($ihk_setelah - $ihk_sebelum) / $ihk_sebelum;
                    $perubahan  = $inflasi * $kolom['harga_aset'];
                    $perkiraan  = $kolom['harga_aset'] + $perubahan;
                }

?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $kolom['kode_aset']; ?></td>
                            <td><?php echo $kolom['nama_aset']; ?></td>
                            <td><?php echo strtoupper($kolom['lokasi_aset']); ?></td>
                            <td>Periode <?php echo $kolom['periode_monitoring']; ?> Tahun <?php echo $kolom['tahun_monitoring']; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $kolom['tahun_monitoring']." - ".$kolom['tahun_aset']." = Rp ".number_format($perkiraan, "0", ",", ".").",-"; ?></td>
                            <td align="center">
                            <?php if($kolom['ajukan_aset'] == "belum") { ?>
                                <a class="btn btn-primary" href="rekomendasi/aju_rekomendasi_aset.php?page=aju_rekomendasi_aset&id=<?php echo $kolom['id_monitoring_aset']; ?>&status=<?php echo $status; ?>&harga=<?php echo $perkiraan; ?>" onclick="if(confirm('Apakah anda yakin akan mengajukan aset ini?')){return true;} else {return false;}"><i class="fa fa-mail-forward"></i> Ajukan</a>
                            <?php } else { ?>
                                <span class="label label-success">SUDAH DIAJUKAN</span>
                            <?php } ?>
                            </td>
                        </tr>
<?php
            $count++;
            }
        }
    }
?>
<!-- END PERHITUNGAN SAW -->
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