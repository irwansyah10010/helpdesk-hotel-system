<?php
$departement = new \model\Departement();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Departement</title>

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
                    <h1 class="page-header">Departement</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <?php 
            inc('include/NotifikasiSucces')
            ?>
            

            <div class="panel-body">
            <a class="btn btn-primary" href="<?php url("Departement/add/") ?>">Tambah</a><br><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Departement</th>
                                            <th>Nama Departement</th>
                                            <th>Keterangan</th>
                                            <th colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

                                    $request = new \engine\http\Request();
                                    $page = 1;

                                    $no = 1;
                                    $batas = 5;

                                    $nilaiAwal = 0;
                                    $departement->select($departement->getTable())->ready();
                                    $total = $departement->getstatement()->rowCount();

                                    $totalPage = ceil($total / $batas);

                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                        $nilaiAwal = ($page - 1)  * $batas;
                                        $no = $nilaiAwal+1;
                                    }

                                    $departement->select($departement->getTable())->limit($nilaiAwal,$batas)->ready();
                                
                                    while($row = $departement->getStatement()->fetch()){ ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $row[0]?></td>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td><a class="btn btn-warning" href="<?php url("Departement/perbarui/".$row[0]."/")?>">perbarui</a></td>
                                            <td>
                                                <ul style="list-style-type : none;">
                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="#"> hapus
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li><a href="#">Apakah Yakin ingin menghapus</a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li><a href="<?php url("hapusDepartement/".$row['kode_departement']."/")?>">Iya</a>
                                                            </li>
                                                            <li><a href="#">Tidak</a>
                                                            </li>
                                                        </ul>
                                                        <!-- /.dropdown-user -->
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                <?php   }
                                
                                ?>
                                    </tbody>
                                </table>

                                <small> <?= $page ?> of <?= $totalPage ?></small>

                                <ul class="pagination">
                                    <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('Departement/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                                    <?php
                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                    }else{
                                        $page = 1;
                                    }
                                    
                                    for($i=1; $i <= $totalPage;$i++){ ?>
                                        <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('Departement/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                                    <?php } ?>

                                    <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('Departement/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
                                </ul>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
           
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>

</body>

</html>
