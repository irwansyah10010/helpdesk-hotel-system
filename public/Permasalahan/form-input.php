<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Form Permasalahan</title>

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
                                    <form role="form" action="<?php url("addPermasalahan/") ?>" method="post">

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" rows="3" name="keterangan" placeholder="Permasalahan dijelaskan secara rinci"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input class="form-control" name="lokasi" placeholder="Lokasi berdasarkan lantai, nomor ruangan atau lainnya">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Departement Terkait</label>
                                            <select class="form-control" name="kode_departement" id="departement">
                                                <option value="----">------</option>
                                            <?php
                                                $departement = new \model\Departement();
                        
                                                $departement->select($departement->getTable())->where()
                                                ->comparing('kode_departement','E')->or()
                                                ->comparing('kode_departement','ITO')->ready();
                            
                                                while($row = $departement->getStatement()->fetch()){
                                                    ?><option value="<?php echo $row[0]?>"><?php echo $row[1] ?></option>
                                            <?php 
                                                }
                                            ?>
                                            </select>
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
