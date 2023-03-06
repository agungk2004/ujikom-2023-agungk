<?php
include('../../koneksi/koneksi.php');
if (isset($_POST['cek'])) {
    $pilihan = $_POST['pilihan']; 
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if ($pilihan == 'masyarakat') {
        $q = mysqli_query($con, "SELECT * FROM `masyarakat` WHERE username = '$username' AND password = '$password' AND verifikasi = 1");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['nik'] = $d->nik;
            $_SESSION['username'] = $d->username;
            $_SESSION['nama'] = $d->nama;
            $_SESSION['telp'] = $d->telp;
            $_SESSION['level'] = 'masyarakat';
            @header('location:../../modul/modul-profile/');
        } else {
            echo '<div class="alert alert-danger alert-dismissable"><strong class="text-white">Data salah atau belum di verifikasi</strong></div>';
        }
    } else if ($pilihan == 'petugas') {
        $q = mysqli_query($con, "SELECT * FROM `petugas` WHERE username = '$username' AND password = '$password'");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $d->username;
            $_SESSION['level'] = $d->level;
            $_SESSION['id_petugas'] = $d->id_petugas;
            @header('location:../../modul/modul-petugas/');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/dist/css/atlantis.min.css">
</head>
<body>
<form action="" method="POST">
    <div class="container" style="margin-left: 13%; margin-top: 50px;">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header bg-primary text-white">
                            <label for=""><i class="fas fa-user"></i>  Login menu</label>
                        </div>
                    
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukan username">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
                        </div>

                        <label for="pilihan"> Login sebagai</label>
                        <div class="form-group">
                            <select name="pilihan" class="form-control" id="pilihan">
                                <option value="masyarakat">masyarakat</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                                        <span class="">Belum punya akun ? </span><a href="registrasi.php">daftar</a>
                                    </div>
                        
                        <div class="d-grid gap-2">
                            <button name="cek" type="submit" style="margin-top: 15px;" class="btn btn-login form-control btn-outline-primary">Login</button>		
                        </div>
                    </div>
                </div>

               

            </div>
        </div>
    </div>
    </form>
</body>
</html>