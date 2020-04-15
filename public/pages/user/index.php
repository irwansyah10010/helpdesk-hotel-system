<?php
$user = new \model\User();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>User</title>

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
                    <h1 class="page-header">User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <?php 
            inc('include/NotifikasiSucces')
            ?>
            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Hak Akses</th>
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
                                    $user->select($user->getTable())->ready();
                                    $total = $user->getstatement()->rowCount();
        
                                    $totalPage = ceil($total / $batas);
        
                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                        $nilaiAwal = ($page - 1)  * $batas;
                                        $no = $nilaiAwal+1;
                                    }
                                    $user->select($user->getTable())->limit($nilaiAwal,$batas)->ready();
                                
                                    while($row = $user->getStatement()->fetch()){ ?>
                                        <tr>
                                            <td><?php echo $no++?></td>
                                            <td><?php echo $row[0]?></td>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td><?php echo $row[3]?></td>
                                            <td><a class="btn btn-warning" href="<?php url("User/perbarui/".$row[0]."/")?>">perbarui</a></td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                                    hapus
                                                </button>
                                            </td>
                                        </tr>
                                <?php   }
                                
                                ?>
                                    </tbody>
                                </table>

                                <small> <?= $page ?> of <?= $totalPage ?></small>

                                <ul class="pagination">
                                    <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('User/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                                    <?php
                                    if($request->get(2) !== ""){
                                        $page = $request->get(2);
                                    }else{
                                        $page = 1;
                                    }
                                    
                                    for($i=1; $i <= $totalPage;$i++){ ?>
                                        <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('User/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                                    <?php } ?>

                                    <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('User/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
                                </ul>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
           
        </div>
        <!-- /#page-wrapper -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">user</h4>
                    </div>
                    <div class="modal-body">
                        Apakah anda ingin menghapus data
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>

</body>

</html>
