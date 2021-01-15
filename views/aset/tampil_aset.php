<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Data Aset</h1>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">
                    <i class="fa fa-plus"></i> Tambah
                </button>
                <br><br>
                <?php
                    include "../config/koneksi.php";
                    $query_show = "
                        SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                        FROM data_aset
                        INNER JOIN monitoring_aset
                        ON data_aset.id_aset = monitoring_aset.id_aset
                    ";
                    $hasil = mysqli_query($koneksi, $query_show);
                ?>
                <table id="example1" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Tahun Perolehan</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Prioritas</th>
                            <th>Periode Monitoring</th>
                            <th>Aksi</th>
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
                            <td><?php echo $tahun; ?> Tahun</td>
                            <td><?php echo strtoupper($kolom['lokasi_aset']); ?></td>
                            <td><?php echo $kolom['kondisi_aset']; ?></td>
                            <td><?php echo $kolom['prioritas_aset']; ?></td>
                            <td>Periode <?php echo $kolom['periode_monitoring']; ?> Tahun <?php echo $kolom['tahun_monitoring']; ?></td>
                            <td align="center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit-data<?php echo $kolom['id_aset']; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <!-- <a class="btn btn-danger" href="aset/hapus_aset.php?page=hapus_aset&id=<?php echo $kolom['id_aset']; ?>" onclick="if(confirm('Apakah anda yakin akan menghapus?')){return true;} else {return false;}"><i class="fa fa-trash-o"></i> Hapus</a> -->
                            </td>
                        </tr>
                        <?php
                                    $count++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <!-- BEGIN MODAL TAMBAH DATA -->
                <div class="modal fade" id="tambah-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Data Aset</h4>
                            </div>
                            <div class="modal-body">
                            <!-- BEGIN BODY -->
                            <form class="form-horizontal" action="aset/simpan_aset.php" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="kode_aset" class="col-sm-3 control-label">Kode Aset</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Kode Aset" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_aset" class="col-sm-3 control-label">Nama Aset</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Nama Aset" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_aset" class="col-sm-3 control-label">Tahun Aset</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datepickertahun" id="tahun_aset" name="tahun_aset" placeholder="Tahun Aset" required autocomplete="off" pattern="[0-9]+" maxlength="4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_aset" class="col-sm-3 control-label">Harga Aset</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="harga_aset" name="harga_aset" placeholder="Harga Aset" required pattern="[0-9]+" title="Harga aset harus angka.">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_aset" class="col-sm-3 control-label">Jumlah Aset</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="jumlah_aset" name="jumlah_aset" placeholder="Jumlah Aset" required pattern="[0-9]+" title="Jumlah aset harus angka.">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="lokasi_aset" class="col-sm-3 control-label">Lokasi Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="lokasi_aset" id="lokasi_aset" required>
                                                <option value="sd">SD</option>
                                                <option value="smp">SMP</option>
                                                <option value="sma">SMA</option>
                                                <option value="smk">SMK</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="kondisi_aset" class="col-sm-3 control-label">Kondisi Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="kondisi_aset" id="kondisi_aset" required>
                                                <option value="Sangat Rusak">Sangat Rusak</option>
                                                <option value="Rusak">Rusak</option>
                                                <option value="Kurang Baik">Kurang Baik</option>
                                                <option value="Baik">Baik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="prioritas_aset" class="col-sm-3 control-label">Prioritas Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="prioritas_aset" id="prioritas_aset" required>
                                                <option value="Sangat Berprioritas">Sangat Berprioritas</option>
                                                <option value="Berprioritas">Berprioritas</option>
                                                <option value="Cukup Berprioritas">Cukup Berprioritas</option>
                                                <option value="Kurang Berprioritas">Kurang Berprioritas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_monitoring" class="col-sm-3 control-label">Periode Cek</label>
                                        <div class="col-sm-6">
                                            <select name="periode_monitoring" id="periode_monitoring" class="form-control" required>
                                                <option value="1">Periode ke-1 (Januari s.d. Maret)</option>
                                                <option value="2">Periode ke-2 (April s.d. Juni)</option>
                                                <option value="3">Periode ke-3 (Juli s.d. September)</option>
                                                <option value="4">Periode ke-4 (Oktober s.d. Desember)</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control datepickertahun" id="tahun_monitoring" name="tahun_monitoring" placeholder="Tahun Periode" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            <!-- END BODY -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- END MODAL TAMBAH DATA -->
                <!-- BEGIN MODAL EDIT DATA -->
                <?php
                    $query_modal = "
                        SELECT data_aset.id_aset, kode_aset, nama_aset, tahun_aset, harga_aset, periode_monitoring, tahun_monitoring, kondisi_aset, lokasi_aset, prioritas_aset
                        FROM data_aset
                        INNER JOIN monitoring_aset
                        ON data_aset.id_aset = monitoring_aset.id_aset
                    ";
                    $return = mysqli_query($koneksi, $query_modal);
                    if($return != null) {
                        while($modal = mysqli_fetch_array($return)) {
                ?>
                <div class="modal fade" id="edit-data<?php echo $modal['id_aset'];?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data Aset</h4>
                            </div>
                            <div class="modal-body">
                            <!-- BEGIN BODY -->
                            <form class="form-horizontal" action="aset/ubah_aset.php" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="kode_aset" class="col-sm-3 control-label">Kode Aset</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="id_aset" name="id_aset" placeholder="ID Aset" required value="<?php echo $modal['id_aset'] ?>">
                                            <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Kode Aset" required value="<?php echo $modal['kode_aset'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_aset" class="col-sm-3 control-label">Nama Aset</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Nama Aset" required value="<?php echo $modal['nama_aset'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_aset" class="col-sm-3 control-label">Tahun Aset</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datepickertahun" id="tahun_aset" name="tahun_aset" placeholder="Tahun Aset" required autocomplete="off" pattern="[0-9]+" maxlength="4" value="<?php echo $modal['tahun_aset'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_aset" class="col-sm-3 control-label">Harga Aset</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="harga_aset" name="harga_aset" placeholder="Harga Aset" required pattern="[0-9]+" title="Harga aset harus angka." value="<?php echo $modal['harga_aset'] ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="lokasi_aset" class="col-sm-3 control-label">Lokasi Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="lokasi_aset" id="lokasi_aset" required>
                                                <option value="sd" <?php if($modal['lokasi_aset'] == 'sd') {echo "selected";} ?>>SD</option>
                                                <option value="smp" <?php if($modal['lokasi_aset'] == 'smp') {echo "selected";} ?>>SMP</option>
                                                <option value="sma" <?php if($modal['lokasi_aset'] == 'sma') {echo "selected";} ?>>SMA</option>
                                                <option value="smk" <?php if($modal['lokasi_aset'] == 'smk') {echo "selected";} ?>>SMK</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="kondisi_aset" class="col-sm-3 control-label">Kondisi Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="kondisi_aset" id="kondisi_aset" required>
                                                <option <?php if($modal['kondisi_aset'] == 'Sangat Rusak') {echo "selected";} ?> value="Sangat Rusak">Sangat Rusak</option>
                                                <option <?php if($modal['kondisi_aset'] == 'Rusak') {echo "selected";} ?> value="Rusak">Rusak</option>
                                                <option <?php if($modal['kondisi_aset'] == 'Kurang Baik') {echo "selected";} ?> value="Kurang Baik">Kurang Baik</option>
                                                <option <?php if($modal['kondisi_aset'] == 'Baik') {echo "selected";} ?> value="Baik">Baik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="prioritas_aset" class="col-sm-3 control-label">Prioritas Aset</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="prioritas_aset" id="prioritas_aset" required>
                                                <option <?php if($modal['prioritas_aset'] == 'Sangat Berprioritas') {echo "selected";} ?> value="Sangat Berprioritas">Sangat Berprioritas</option>
                                                <option <?php if($modal['prioritas_aset'] == 'Berprioritas') {echo "selected";} ?> value="Berprioritas">Berprioritas</option>
                                                <option <?php if($modal['prioritas_aset'] == 'Cukup Berprioritas') {echo "selected";} ?> value="Cukup Berprioritas">Cukup Berprioritas</option>
                                                <option <?php if($modal['prioritas_aset'] == 'Kurang Berprioritas') {echo "selected";} ?> value="Kurang Berprioritas">Kurang Berprioritas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="periode_monitoring" class="col-sm-3 control-label">Periode Cek</label>
                                        <div class="col-sm-6">
                                            <select name="periode_monitoring" id="periode_monitoring" class="form-control" required>
                                                <option <?php if($modal['periode_monitoring'] == '1') {echo "selected";} ?> value="1">Periode ke-1 (Januari s.d. Maret)</option>
                                                <option <?php if($modal['periode_monitoring'] == '2') {echo "selected";} ?> value="2">Periode ke-2 (April s.d. Juni)</option>
                                                <option <?php if($modal['periode_monitoring'] == '3') {echo "selected";} ?> value="3">Periode ke-3 (Juli s.d. September)</option>
                                                <option <?php if($modal['periode_monitoring'] == '4') {echo "selected";} ?> value="4">Periode ke-4 (Oktober s.d. Desember)</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control datepickertahun" id="tahun_monitoring" name="tahun_monitoring" placeholder="Tahun Periode" required autocomplete="off" value="<?php echo $modal['tahun_monitoring'] ?>">
                                        </div>
                                    </div>
                                </div>
                            <!-- END BODY -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
                <?php
                        }
                    }
                ?>
                <!-- END MODAL EDIT DATA -->
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
    <!-- /.row -->

</section>
<!-- /.content -->