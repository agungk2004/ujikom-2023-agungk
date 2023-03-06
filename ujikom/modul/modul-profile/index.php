<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    $nik = $_SESSION['nik'];
    $nama = $_SESSION['nama'];
    $username = $_SESSION['username'];
    $telp = $_SESSION['telp'];
}
?>

<?php include('../penghubung.php') ?>
<?= $username ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-primary navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <?php include('../menu.php'); ?>
        <div class="content-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user-circle"></i><strong>Profil</strong>
                            </div>
                            <div class="card-body">
                                <div class="card col-md-auto">
                                    <div class="card-header">Nik : <?= $nik ?></div>
                                    <div class="card-header">Nama : <?= $nama ?></div>
                                    <div class="card-header">Username : <?= $username ?></div>
                                    <div class="card-header">Tlp : <?= $telp ?></div>
                                </div>
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