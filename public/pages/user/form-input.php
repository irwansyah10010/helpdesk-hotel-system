<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Form User</title>

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
        <?php inc("include/navigation") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Tambah</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                <?php 
                    $request = new \engine\http\Request;
                    $great = $request->getNotification();
                    
                    echo $great;

                ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php url("addUser/") ?>" method="post">
                                    <div class="form-group">
                                            <label>NIP</label>
                                            <select class="form-control" name="nip">
                                            <?php
                                                $pegawai = new \model\Pegawai();
                        
                                                $pegawai->select($pegawai->getTable())->ready();
                            
                                                while($rows = $pegawai->getStatement()->fetch()){
                                                    ?><option value="<?php echo $rows['nip']?>"><?php echo $rows[nip]."-".$rows[nama_pegawai] ?></option>
                                            <?php 
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" placeholder="Masukan username" name="username">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" placeholder="Masukan Password" name="password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default" name="submit">Tambahkan</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>

</body>

</html>
