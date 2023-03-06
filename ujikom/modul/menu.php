<aside class="main-sidebar sidebar-primary bg-white elevation-4">

    <a href="" class="brand-link bg-primary">
        <img src="../../assets/dist/img/icon atlantis.png" alt="Atlantis Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-white">Atlantis</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-2 pt-2 mb-3 d-flex bg-primary" style="border-radius: 10px">
            <div class="image">
                <img src="../../assets/dist/img/masjid.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white"><?= $_SESSION['username'] ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <?php if ($_SESSION['level'] == 'masyarakat') { ?>

                    <li class="nav-item">
                        <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-profile/" class="nav-link">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Profil
                            </p>
                        </a>
                    </li>

                <?php } ?>
                <li class="nav-item">
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-pengaduan" class="nav-link">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>
                            Pengaduan
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['level'] == 'admin') { ?>
                    <li class="nav-item">
                        <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-masyarakat" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Masyarakat
                            </p>
                        </a>
                    </li>

                <?php } ?>
                <li class="nav-item">
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-tanggapan" class="nav-link">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            Tanggapan
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['level'] == 'admin') { ?>

                    <li class="nav-item">
                        <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-petugas" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Petugas
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom/modul/modul-auth/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>