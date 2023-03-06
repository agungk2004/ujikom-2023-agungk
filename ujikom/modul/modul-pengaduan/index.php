<?php

session_start();
include('../../koneksi/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}

if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];

    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($con, $q);
            if ($r) {
                move_uploaded_file($file_tmp, '../../assets/images/masyarakat/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($con, $q);
    }
}


if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($con, $q);
        $d = mysqli_fetch_object($r);
        unlink('../../assets/images/masyarakat/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($con, $q);
}


if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($con, $q);
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
                <h3 class="card-title mt-2">Pengaduan</h3><br>
            </ul>
        </nav>
        <?php include('../menu.php')
        ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <?php if ($_SESSION['level'] == 'masyarakat') { ?>

                                    <div class="card">
                                        <div class="card-header">
                                            <button data-toggle="modal" data-target="#modal-lg" class="btn btn-success">buat pengaduan&nbsp;<i class="fa fa-pen"></i></button>
                                        </div>
                                    </div>

                                <?php } ?>
                                <div class="modal fade" id="modal-lg">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Buat Pengaduan
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="nik" value="">
                                                    <div class="form-group">
                                                        <label for="isi_laporan">Isi Laporan</label>
                                                        <textarea name="isi_laporan" class="form-control" cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                                                        <input type="date" name="tgl_pengaduan" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" name="foto" class="form-control">
                                                    </div>
                                                    <input type="submit" name="tambahPengaduan" value="simpan" class="btn btn-success">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dataTablesNya" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nik</th>
                                                <th>Isi Laporan</th>
                                                <th>Foto</th>
                                                <th>Status</th>
                                                <th>hapus</th>
                                                <th>proses Pengaduan</th>
                                            </tr>
                                        </thead>
                                        <?php  ?>
                                        <tbody>
                                            <?php
                                            if ($_SESSION['level'] == 'masyarakat') {
                                                $q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
                                            } else {
                                                $q = "SELECT * FROM `pengaduan`";
                                            }
                                            $r = mysqli_query($con, $q);
                                            $no = 1;
                                            while ($d = mysqli_fetch_object($r)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $d->tgl_pengaduan ?></td>
                                                    <td><?= $d->nik ?></td>
                                                    <td><?= $d->isi_laporan ?></td>
                                                    <td><?php if ($d->foto == '') {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/no-foto.png">';
                                                        } else {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/masyarakat/' . $d->foto . '">';
                                                        } ?></td>
                                                    <td><?= $d->status ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                                                            <form action="" method="post"><input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>"><button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if ($_SESSION['level'] == 'petugas') { ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
                                                                <select class="form-control" name="status">
                                                                    <option value="0"> 0 </option>
                                                                    <option value="proses"> proses </option>
                                                                    <option value="selesai"> selesai </option>
                                                                </select><br>
                                                                <button type="submit" name="proses_pengaduan" class="btn btn-success form-control">ubah</button>
                                                            </form>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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