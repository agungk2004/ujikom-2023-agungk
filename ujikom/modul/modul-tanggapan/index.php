<?php

session_start();
include('../../koneksi/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}

if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($con, $q);
}

if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($con, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}

if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan =  $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($con, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('../penghubung.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <h3 class="card-title mt-2">Tabel tanggapan</h3><br>
            </ul>
        </nav>
        <?php include('../menu.php'); ?>
        <div class="content-wrapper">
        
            <div class="container-fluid">
                <div class="row">
                <?php if ($_SESSION['level'] !== 'masyarakat') { ?>
                    <div class="col-sm-3" style="padding:0.5%;">
                        <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success"><i class="fa fa-pen"></i>&nbsp;tambah tanggapan</button>
                    </div> 
                    <?php } ?> 
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="modal fade" id="modal-lg">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Tambah Tanggapan
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <label for="id_pengaduan"> Pilih Id Pengaduan</label>
                                            <select name="id_pengaduan" class="form-control">
                                                <?php
                                                $q = "SELECT * FROM pengaduan JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik";
                                                $r = mysqli_query($con, $q);
                                                while ($d = mysqli_fetch_object($r)) { ?>
                                                    <option value="<?= $d->id_pengaduan ?>"><?= $d->id_pengaduan . '|' . $d->nik . '|' . $d->nama ?></option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <label for="tgl_tanggapan">Tanggal</label>
                                            <input class="form-control" type="date" name="tgl_tanggapan">
                                            <label for="tanggapan">Beri Tanggapan</label>
                                            <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"></textarea>
                                            <label for="id_petugas">ID Petugas</label>
                                            <input name="id_petugas" type="text" class="form-control" value="<?= $id_petugas ?>" readonly>
                                            <br>
                                            <button name="tambah_tanggapan" type="submit" class="btn btn-info">simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="dataTablesNya" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Pengaduan</th>
                                    <th>tanggal Tanggapan</th>
                                    <th>Isi Tanggapan</th>
                                    <th>Petugas</th>
                                    <th>hapus</th>
                                    <th>edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $q = "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan`
                             WHERE tanggapan.id_petugas = petugas.id_petugas 
                             AND tanggapan.id_pengaduan = pengaduan.id_pengaduan";
                                $r = mysqli_query($con, $q);
                                while ($d = mysqli_fetch_object($r)) { ?>
                                    <tr>
                                        <td>
                                            <?= $no ?>
                                        </td>
                                        <td>
                                            <?= $d->id_pengaduan ?>
                                        </td>
                                        <td>
                                            <?= $d->tgl_tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->tanggapan ?>
                                        </td>
                                        <td>
                                            <?= $d->nama_petugas ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <form action="" method="post"><input type="hidden" name="id_tanggapan" value="<?= $d->id_tanggapan ?>"><button name="hapusTanggapan" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i>&nbsp;hapus</button></form>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg<?= $d->id_pengaduan ?>" class="btn btn-success"><i class="fa fa-pen"></i>&nbsp;Edit</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-lg<?= $d->id_pengaduan ?>">
                                        <div class="modal-dialog modal-lg<?= $d->id_pengaduan ?>">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Edit Pengaduan
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <input class="form-control" name="id_tanggapan" type="hidden" value="<?= $d->id_tanggapan ?>">
                                                        <label for="id_pengaduan">ID Pengaduan</label><br>
                                                        <select class="form-control" name="id_pengaduan">
                                                            <?php
                                                            $result = mysqli_query($con, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                            while ($data = mysqli_fetch_object($result)) { ?>
                                                                <option value="<?= $data->id_pengaduan ?>" <?php if ($d->id_pengaduan == $data->id_pengaduan) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $data->id_pengaduan . '|' . $data->nik . '|' . $data->nama ?></option>
                                                            <?php } ?>
                                                        </select><br>
                                                        <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                                        <input class="form-control" name="tgl_tanggapan" class="form-control" type="date" name="" value="<?= $d->tgl_tanggapan ?>">
                                                        <label for="tanggapan">Tanggapan</label>
                                                        <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"><?= $d->tanggapan ?></textarea>
                                                        <br>
                                                        <button name="ubahTanggapan" type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
    
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="">Atlantis</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.1
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        
        </aside>
    </div>
    <?php include('../penghubung2.php') ?>

</body>

</html>