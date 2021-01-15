<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Data User</h1>
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
                    $hasil = mysqli_query($koneksi, "SELECT * FROM data_user");
                ?>
                <table id="example1" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama User</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($hasil != null) {
                                $count = 1;
                                while($kolom = mysqli_fetch_array($hasil)) {
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $kolom['nama_user']; ?></td>
                            <td><?php echo $kolom['nip']; ?></td>
                            <td>
                            <?php
                                if($kolom['nama_role'] == "disdakmen") {
                                    echo "Disdakmen";
                                } else if($kolom['nama_role'] == "yayasan") {
                                    echo "Ketua Yayasan";
                                } else if($kolom['nama_role'] == "kepsek" && $kolom['role_location'] == "sd") {
                                    echo "Kepala Sekolah SD";
                                } else if($kolom['nama_role'] == "kepsek" && $kolom['role_location'] == "smp") {
                                    echo "Kepala Sekolah SMP";
                                } else if($kolom['nama_role'] == "kepsek" && $kolom['role_location'] == "sma") {
                                    echo "Kepala Sekolah SMA";
                                } else if($kolom['nama_role'] == "kepsek" && $kolom['role_location'] == "smk") {
                                    echo "Kepala Sekolah SMK";
                                } else if($kolom['nama_role'] == "admin" && $kolom['role_location'] == "sd") {
                                    echo "Admin SD";
                                } else if($kolom['nama_role'] == "admin" && $kolom['role_location'] == "smp") {
                                    echo "Admin SMP";
                                } else if($kolom['nama_role'] == "admin" && $kolom['role_location'] == "sma") {
                                    echo "Admin SMA";
                                } else if($kolom['nama_role'] == "admin" && $kolom['role_location'] == "smk") {
                                    echo "Admin SMK";
                                }
                            ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit-data<?php echo $kolom['id_user']; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <a class="btn btn-danger" href="user/hapus_user.php?page=hapus_user&id=<?php echo $kolom['id_user']; ?>" onclick="if(confirm('Apakah anda yakin akan menghapus?')){return true;} else {return false;}"><i class="fa fa-trash-o"></i> Hapus</a>
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
                                <h4 class="modal-title">Tambah Data User</h4>
                            </div>
                            <div class="modal-body">
                            <!-- BEGIN BODY -->
                            <form class="form-horizontal" action="user/simpan_user.php" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="nama_user" class="col-sm-3 control-label">Nama User</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama User" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip" class="col-sm-3 control-label">NIP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" required pattern="[0-9]+" title="NIP harus angka">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_role" class="col-sm-3 control-label">Role</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="nama_role" id="role_name" onchange="disabledRole()">
                                                <option value="yayasan">Ketua Yayasan</option>
                                                <option value="disdakmen">Disdakmen</option>
                                                <option value="kepsek">Kepala Sekolah</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_location" class="col-sm-3 control-label">Lokasi</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="role_location" id="role_location" disabled>
                                                <option value="sd">SD</option>
                                                <option value="smp">SMP</option>
                                                <option value="sma">SMA</option>
                                                <option value="smk">SMK</option>
                                            </select>
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
                    $return = mysqli_query($koneksi, "SELECT * FROM data_user");
                    if($return != null) {
                        while($modal = mysqli_fetch_array($return)) {
                ?>
                <div class="modal fade" id="edit-data<?php echo $modal['id_user'];?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data User</h4>
                            </div>
                            <div class="modal-body">
                            <!-- BEGIN BODY -->
                            <form class="form-horizontal" action="user/ubah_user.php" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="nama_user" class="col-sm-3 control-label">Nama User</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="id_user" name="id_user" placeholder="ID User" required value="<?php echo $modal['id_user']; ?>">
                                            <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama User" required value="<?php echo $modal['nama_user']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip" class="col-sm-3 control-label">NIP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" required value="<?php echo $modal['nip']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password (Kosongkan bila tidak akan diubah)" title="Kosongkan bila tidak akan diubah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_role" class="col-sm-3 control-label">Role</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="nama_role" id="role_name">
                                                <option value="yayasan" <?php if($modal['nama_role'] == "yayasan") {echo "selected";} ?>>Ketua Yayasan</option>
                                                <option value="disdakmen" <?php if($modal['nama_role'] == "disdakmen") {echo "selected";} ?>>Disdakmen</option>
                                                <option value="kepsek" <?php if($modal['nama_role'] == "kepsek") {echo "selected";} ?>>Kepala Sekolah</option>
                                                <option value="admin" <?php if($modal['nama_role'] == "admin") {echo "selected";} ?>>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_location" class="col-sm-3 control-label">Lokasi</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="role_location">
                                                <option value="sd" <?php if($modal['role_location'] == "sd") {echo "selected";} ?>>SD</option>
                                                <option value="smp" <?php if($modal['role_location'] == "smp") {echo "selected";} ?>>SMP</option>
                                                <option value="sma" <?php if($modal['role_location'] == "sma") {echo "selected";} ?>>SMA</option>
                                                <option value="smk" <?php if($modal['role_location'] == "smk") {echo "selected";} ?>>SMK</option>
                                            </select>
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

<script>
    function disabledRole() {
        let role = document.getElementById('role_name').value;
        if(role == 'disdakmen' || role == 'yayasan') {
            document.getElementById('role_location').disabled = true;
        }
        if(role == 'kepsek' || role == 'admin') {
            document.getElementById('role_location').disabled = false;
        }
    }
</script>