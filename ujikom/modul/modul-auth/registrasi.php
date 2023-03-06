<?php
include('../../koneksi/koneksi.php');
if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];
    $q = mysqli_query($con, "INSERT INTO `masyarakat` (nik, nama, username, password, telp, verifikasi) VALUES ('$nik', '$nama', '$username', '$password', $telp, 0)");
    if ($q) {
        echo  '<div class="alert alert-primary alert-dismissable">
                Registrasi Berhasil Tunggu verifikasi oleh admin
                </div>';
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
    <div class="container" style="margin-left: 13%; margin-top: 20px;">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header bg-primary text-white">
                            <label for=""><i class="fas fa-user"></i> pendaftaran</label>
                        </div>
                
                        <div class="form-group">
                            <label>Nik</label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukan NIK anda">
                        </div>

                        <div class="form-group">
                           <label>Nama</label>
                           <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
                       </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukan username">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1"> Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
                        </div>

                        <div class="form-group">
                            <label>Telp</label>
                            <input type="number" name="telp" class="form-control" placeholder="Masukan Nomor telepon">
                         </div>

                        <div class="form-group mb-0">
                           <span class="">Belum punya akun ? </span><a href="login.php">login</a>
                        </div>
                        
                        <div class="form-group">
                           <button name="simpan" type="submit" class="form-control btn btn-primary">Daftar</button>
                        </div>

                    </div>
                </div>

               

            </div>
        </div>
    </div>
    </form>
</body>
</html>