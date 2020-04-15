<?php
    $session = new \engine\http\Session();
    incOnce('include/PerhitunganTanggal');
    $hakAkses = $session->getValue("hak_akses");
    $hariIni = new DateTime();

?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php  url("") ?>">Sistem Informasi Helpdesk Hotel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                    <?php 
                        $permasalahan = new \model\Permasalahan();
                        $permasalahan->select("permasalahan_pegawai")->sorting("kode_permasalahan","DESC")->limit(1,3)
                        ->ready();
                        while($row = $permasalahan->getStatement()->fetch()){ ?>
                        <li>
                            <a href="#">
                                <div>
                                    <div><?php echo $row['keterangan'] ?></div>

                                    <strong><?php  echo $row['status'] ?></strong>
                                    <br>
                                    <span class="pull-right text-muted">
                                    <?php   
                                    $tanggalPermasalahan = new DateTime($row['tanggal_permasalahan']);
                                    $selisihWaktu = $hariIni->diff($tanggalPermasalahan);

                                    ?>
                                        <em><?php echo cetakTanggal($selisihWaktu); ?></em>
                                    </span>
                                </div>
                                
                            </a>
                        </li><br>
                        <li class="divider"></li>
                    <?php }
                    ?>
                        <li>
                            <a class="text-center" href="<?php url("Permasalahan/") ?>">
                                <strong>Lihat semua pesan</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <?php if($_SESSION['hak_akses'] == 'ITO' || $_SESSION['hak_akses'] == 'E'){ ?>
                <li class="dropdown">
                    
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" style="height: 500%; overflow-y : scroll;">
                    <?php 
                    $count = 0;

                    $permasalahan = new \model\Permasalahan();
                    $permasalahan->select("departement_pegawai_permasalahan")->where()
                    ->comparing("kode_departement",$_SESSION['hak_akses'])->sorting("tanggal_permasalahan","DESC")->ready();
                    while($row = $permasalahan->getStatement()->fetch()){ 
                        $count++;
                        
                        ?>
                        <li>
                            <div>
                                <i class="fa fa-comment fa-fw"></i> <?php echo $row['keterangan'] ?><br><br>
                                &nbsp<b><?php echo $row['status'] ?></b><br><br>
                                
                                <?php if($row['status'] == 'Dibuat'){ ?>
                                &nbsp<a href="<?php url("Perbaikan/add/".$row['kode_permasalahan']."/"); ?>" class="btn btn-primary" type="button">Tanggani</a> <br><br>

                                <?php   
                                }else if($row['status'] == 'Ditanggapi' || $row['status'] == 'Ditunggu'){ ?>
                                    &nbsp<a href="<?php url("Perbaikan/perbarui/".$row['kode_permasalahan']."/"); ?>" class="btn btn-primary" type="button">laporkan</a> <br><br>
                                <?php 
                                }else if($row['status'] == 'Ditunggu'){ ?>
                                    &nbsp<a href="#" class="btn btn-succes" type="button">Selesai</a>
                                <?php
                                } 
                                    $tanggalPermasalahan = new DateTime($row['tanggal_permasalahan']);
                                    $selisihWaktu = $hariIni->diff($tanggalPermasalahan);
                                ?>
                                <span class="pull-right text-muted small"><?php //echo cetakTanggal($selisihWaktu); ?></span>
                            </div><br>
                        </li>
                        <li class="divider"></li>
                    <?php 
                    
                    }
                    ?>
                        <li>
                            <a class="text-center" href="<?php url("Perbaikan/") ?>">
                                <strong>Lihat semua pemberitahuan</strong> <?php echo $count ?>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li><?php } ?>
                <!-- /.dropdown -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php url('UserProfile/') ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php url('Logout/') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">

                        <li>
                            <img src="<?php echo getFiles($_SESSION['gambar']) ?>" alt="Notting" style="width: 20%; margin: 2% 3%;">
                            <?php echo $_SESSION['nama_pegawai']; ?>
                        </li>
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php  url("") ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php 
                            switch ($hakAkses) {
                                case 'ITO':
                                ?>
                        <li>
                            <a href="<?php  url("Pegawai/") ?>"><i class="fa fa-group fa-fw"></i> Pegawai</a>
                        </li>
                        <li>
                            <a href="<?php  url("Departement/") ?>"><i class="fa fa-users fa-fw"></i> Departemen</a>
                        </li>
                        <li>
                            <a href="<?php  url("Perbaikan/") ?>"><i class="fa fa-wrench fa-fw"></i> Perbaikan</a>
                        </li>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>
                        <li>
                            <a href="<?php  url("User/") ?>"><i class="fa fa-user-md fa-fw"></i> User</a>
                        </li>          
                                <?php 
                                break;
                                case 'O':
                                ?>
                        <li>
                            <a href="<?php  url("Pegawai/") ?>"><i class="fa fa-group fa-fw"></i> Pegawai</a>
                        </li>
                        <li>
                            <a href="<?php  url("Departement/") ?>"><i class="fa fa-users fa-fw"></i> Departemen</a>
                        </li>
                        <li>
                            <a href="<?php  url("Perbaikan/") ?>"><i class="fa fa-wrench fa-fw"></i> Perbaikan</a>
                        </li>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>
                                <?php 
                                    break;
                                case 'HK':
                                ?>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>        
                                <?php
                                    # code...
                                    break;
                                case 'KTC':
                                ?>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>            
                                <?php
                                    # code...
                                    break;
                                case 'FO':
                                ?>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>            
                                <?php
                                    # code...
                                    break;
                                case 'E':
                                ?>
                        <li>
                            <a href="<?php  url("Perbaikan/") ?>"><i class="fa fa-wrench fa-fw"></i> Perbaikan</a>
                        </li>
                        <li>
                            <a href="<?php  url("Permasalahan/") ?>"><i class="fa fa-gears fa-fw"></i> Permasalahan</a>
                        </li>            
                                <?php
                                    # code...
                                    break;
                                
                                default:
                                ?>
                                    
                                <?php
                                    # code...
                                    break;
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>