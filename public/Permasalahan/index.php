<?php
$permasalahan = new \model\Permasalahan();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME; ?>Permasalahan</title>

    <?php inc("include/includeCSS") ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php inc("include/navigation") 

        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Permasalahan</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <?php 
                $hak_akses = $_SESSION['hak_akses'];
                $request = new \engine\http\Request;
                $notifikasi = $request->getNotification();
                
                if($notifikasi != ''){
            ?>
                <br><div class="alert alert-succes alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $notifikasi; ?> 
                </div><br>
            <?php } ?>


            <div class="panel-body">
            <a class="btn btn-primary" href="<?php url("Permasalahan/add/") ?>">Tambah</a><br><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Permasalahan</th>
                                            <th>Tanggal Permasalahan</th>
                                            <th>Keterangan</th>
                                            <th>status</th>
                                            <th>Nip</th>
                                            <th>Kode Departement</th>
                                            <?php if($hak_akses == 'O' || $hak_akses == 'ITO'){ ?>
                                                <!--<td><a class="btn btn-primary" href="<?php //url("Permasalahan/perbarui/".$row[0]."/")?>">Lihat</a></td>-->
                                                <th>Aksi</th>
                                            <?php } ?>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $request = new \engine\http\Request();
                                    $page = 1;
        
                                    $no = 1;
                                    $batas = 5;
        
                                    $nilaiAwal = 0;
                                    $permasalahan->select($permasalahan->getTable())->ready();
                                    $total = $permasalahan->getstatement()->rowCount();
        
                                    $totalPage = ceil($total / $batas);
        
                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                        $nilaiAwal = ($page - 1)  * $batas;
                                        $no = $nilaiAwal+1;
                                    }

                                    $permasalahan->select($permasalahan->getTable())->limit($nilaiAwal,$batas)->ready();
                                
                                    while($row = $permasalahan->getStatement()->fetch()){ ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?php echo $row['kode_permasalahan']?></td>
                                            <td><?php echo $row['tanggal_permasalahan']?></td>
                                            <td><?php echo $row['keterangan']?></td>
                                            <td><?php echo $row['status']?></td>
                                            <td><?php
                                                $pegawai= new \model\Pegawai();
                                                $pegawai->select($pegawai->getTable())->where()->comparing('nip',$row['nip'])->ready();
                                                $rowPegawai = $pegawai->getStatement()->fetch();
                                                echo $row['nip'].'-'.$rowPegawai['nama_pegawai']?></td>
                                            <td><?php echo $row['kode_departement']?></td>
                                            <?php if($hak_akses == 'O' || $hak_akses == 'ITO'){ ?>
                                                <!--<td><a class="btn btn-primary" href="<?php //url("Permasalahan/perbarui/".$row[0]."/")?>">Lihat</a></td>-->
                                                <td>
                                                <ul style="list-style-type : none;">
                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="#"> hapus
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li><a href="#">Apakah Yakin ingin menghapus</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li><a href="<?php url("Permasalahan/hapus/".$row['nip']."/")?>">Iya</a>
                                                            </li>
                                                            <li><a href="#">Tidak</a>
                                                            </li>
                                                        </ul>
                                                        <!-- /.dropdown-user -->
                                                    </li>
                                                </ul>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                <?php   }
                                ?>
                                    </tbody>
                                </table>

                                <small> <?= $page ?> of <?= $totalPage ?></small>

                                <ul class="pagination">
                                    <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('Permasalahan/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                                    <?php
                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                    }else{
                                        $page = 1;
                                    }
                                    
                                    for($i=1; $i <= $totalPage;$i++){ ?>
                                        <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('Permasalahan/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                                    <?php } ?>

                                    <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('Permasalahan/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
                                </ul>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>
    <script>
    $("document").ready(function(){

    });
    </script>
</body>

</html>
