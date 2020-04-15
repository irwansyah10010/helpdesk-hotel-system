<?php
$pegawai = new \model\Pegawai();
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

    <title><?php echo APP_NAME ?>Profile User</title>

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
                    <h1 class="page-header">User Profile <?php echo $_SESSION['nama_pegawai'] ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <?php 
            inc('include/NotifikasiSucces');

            $pegawai->select($pegawai->getTable())->where()
            ->comparing("nip",$_SESSION['nip'])->ready();
            
            $user->select($user->getTable())->where()
            ->comparing("nip",$_SESSION['nip'])->ready();

            $row = $pegawai->getStatement()->fetch();

            $rowUser = $user->getStatement()->fetch();


            ?>

            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Foto</th>
                                        <td><img src="<?php getFiles($row['nip'])?>" alt="None" style="width: 25%; margin: 2% 3%;"></td>
                                    </tr>
                                    <tr>
                                        <th>NIP</th>
                                        <td><?php echo $row['nip'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td><?php echo $row['nama_pegawai'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Departement</th>
                                        <td><?php echo $row['kode_departement'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td><?php echo $row['jabatan'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Email/Username</th>
                                        <td><?php echo $row['email'] ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><?php echo $rowUser['password'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td><?php echo $row['tanggal_lahir'] ?></td>                                        
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2"><a href="<?php url('Pegawai/ubah-profile/') ?>" name="ubah" class="btn btn-warning">Ubah</a></td>
                                    </tr>
                                </table>
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
