<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Dashboard</title>

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
        <?php inc("include/navigation") ;
        
        ?>
        <?php $session = new engine\http\Session(); 
            
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                    <?php 
                    
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php inc('include/list-data') ?>

                <?php 
                    $model = new \model\Pegawai();
                    $model->queryCustom("select count(*) from pegawai")->ready();

                    $row = $model->getStatement()->fetch();

                    if($_SESSION['hak_akses'] == 'ITO' || $_SESSION['hak_akses'] == 'O'){
                        listAtribut("red","group",$row[0],"Pegawai","Pegawai/"); 
                    }
                ?>

                <?php 
                    $model = new \model\Departement();
                    $model->queryCustom("select count(*) from departement")->ready();

                    $row = $model->getStatement()->fetch();

                    if($_SESSION['hak_akses'] == 'ITO' || $_SESSION['hak_akses'] == 'O'){
                        listAtribut("grey","group",$row[0],"Departement","Pegawai/"); 
                    }
                ?>

                <?php 
                    $model = new \model\User();
                    $model->queryCustom("select count(*) from user")->ready();

                    $row = $model->getStatement()->fetch();
                    if($_SESSION['hak_akses'] == 'ITO'){
                        listAtribut("primary","user",$row[0],"User Pengelola","User/"); 
                    }
                ?>
                <?php 
                    $model = new \model\Permasalahan();
                    $model->queryCustom("select count(*) from permasalahan")->ready();

                    $row = $model->getStatement()->fetch();

                    listAtribut("yellow","gears",$row[0],"Permasalahan","Permasalahan/"); 
                ?>

                <?php 
                    $model = new \model\Perbaikan();
                    $model->queryCustom("select count(*) from perbaikan")->ready();

                    $row = $model->getStatement()->fetch();
                    
                    if($_SESSION['hak_akses'] == 'ITO' || $_SESSION['hak_akses'] == 'E'){
                        listAtribut("green","support",$row[0],"Perbaikan","Perbaikan/"); 
                    }
                ?>
            </div>
            <div class="row">
                <h3 class="page-header">Permasalahan</h3>
            </div>
            <!-- /.row -->
            <div class="row">        
                <div class="panel-body">
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $permasalahan = new \model\Permasalahan();
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
                                </tr>
                        <?php   }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>

</body>
</html>
