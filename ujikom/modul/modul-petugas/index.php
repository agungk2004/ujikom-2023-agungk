<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include('../../koneksi/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/login.php');
}

if (isset($_POST['hapus'])) {
    $id_petugas = $_POST['id_petugas'];
    $q = mysqli_query($con, "DELETE FROM `petugas` WHERE id_petugas = '$id_petugas'");
}
if (isset($_POST['update'])) {
    $id_petugasLama = $_POST['id_petugasLama'];
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas= $_POST['nama_petugas'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    if ($password == '') {
        $q = mysqli_query($con, "UPDATE `petugas` SET `id_petugas` = '$id_petugas', nama_petugas = '$nama_petugas', username = '$username', telp = '$telp' WHERE id_petugas = '$id_petugasLama'");
    } else {
        $q = mysqli_query($con, "UPDATE `petugas` SET `password` = '$password', id_petugas = '$id_petugas', nama = '$nama_petugas', username = '$username', telp = '$telp' WHERE id_petugas = '$id_petugasLama'");
    }
}

?>

<?php include('../penghubung.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-primary navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <h3 class="card-title mt-2">Petugas</h3><br>
            </ul>
        </nav>

        <?php include('../menu.php'); ?>
        <div class="content-wrapper">
      
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        
                            <div class="card-body">
                                <table id="dataTablesNya" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>id_petugas</th>
                                            <th>Nama petugas</th>
                                            <th>Username</th>
                                            <th>Telp</th>
                                            <th>Update</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM `petugas`");
                                        $no = 1;
                                        while ($d = mysqli_fetch_object($q)) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $d->id_petugas ?></td>
                                                <td><?= $d->nama_petugas ?></td>
                                                <td><?= $d->username ?></td>
                                                <td><?= $d->telp ?></td>
                                                <td><button data-toggle="modal" data-target="#modal-xl<?= $d->id_petugas ?>" class="btn btn-success"><i class="fa fa-pen"></i></button></td>
                                                <td>
                                                    <form action="" method="post"><input type="hidden" name="id_petugas" value="<?= $d->id_petugas ?>"><button name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                                </td>
                                            </tr>

                                    
                                            <div class="modal fade" id="modal-xl<?= $d->id_petugas ?>">
                                                <div class="modal-dialog modal-xl<?= $d->id_petugas ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id_petugasLama" value="<?= $d->id_petugas ?>">
                                                            <div class="modal-body">
                                                                <div class="form-group"><label for="id_petugas">id_petugas</label>
                                                                    <input class="form-control" type="text" name="id_petugas" value="<?= $d->id_petugas ?>">
                                                                </div>
                                                                <div class="form-group"><label for="nama_petugas">Nama_petugas</label>
                                                                    <input class="form-control" type="text" name="nama_petugas" value="<?= $d->nama_petugas ?>">
                                                                </div>
                                                                <div class="form-group"><label for="username">Username</label>
                                                                    <input class="form-control" type="text" name="username" value="<?= $d->username ?>">
                                                                </div>
                                                                <div class="form-group"><label for="username">New Password</label>
                                                                    <input class="form-control" type="password" name="password" value="">
                                                                </div>
                                                                <div class="form-group"><label for="username">Telepon</label>
                                                                    <input class="form-control" type="number" name="telp" value="<?= $d->telp ?>">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                    </div>
                                                    </form>
                                        
                                                </div>
                                        
                                            </div>

                                        <?php $no++;
                                        }
                                        ?>
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