<?php
$pegawai = new \model\Pegawai();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Pegawai</title>

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
                    <h1 class="page-header">Pegawai</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php 
            
            inc('include/NotifikasiSucces')
            ?>

            <div class="panel-body">
            <a class="btn btn-primary" href="<?php url("Pegawai/add/") ?>">Tambah</a><br><br>
                    <div class="table-responsive overflow">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Departement</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Tanggal Lahir</th>
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
                            $pegawai->select("pegawai_departement")->ready();
                            $total = $pegawai->getstatement()->rowCount();

                            $totalPage = ceil($total / $batas);

                            if($request->get(2) !== ""){
                                $page = $request->get(2);
                                $nilaiAwal = ($page - 1)  * $batas;
                                $no = $nilaiAwal+1;
                            }

                            $pegawai->select("pegawai_departement")->limit($nilaiAwal,$batas)->ready();
                            while($row = $pegawai->getStatement()->fetch()){ ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><img src="<?php getFiles($row['foto'])?>" alt="None" style="width: 25%; margin: 2% 3%;"></td>
                                    <td <?php echo $no++ ?>><?php echo $row['nip']?></td>
                                    <td><?php echo $row['nama_pegawai']?></td>
                                    <td><?php echo $row['nama_departement']?></td>
                                    <td><?php echo $row['jabatan']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><?php echo $row['tanggal_lahir']?></td>
                                    <td><a class="btn btn-warning" href="<?php url("Pegawai/perbarui/".$row['nip']."/")?>">perbarui</a></td>
                                    <td>
                                        <ul style="list-style-type : none;">
                                            <li class="dropdown">
                                                <a class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="#"> hapus
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">
                                                    <li><a href="#">Apakah <br> Yakin ingin menghapus
                                                    <br> menghapus data ini juga akan menghapus data - data yang berkaitan
                                                    </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php url("hapusPegawai/".$row['nip']."/")?>">Iya</a>
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
                            <li class="page-item"><a href="<?php if($page <= 1){ echo"#"; }else{ url('Pegawai/page/'.--$page.'/'); } ?>" class="page-link">Sebelumnya</a></li>
                            <?php
                            if($request->get(2) !== ""){
                                $page = $request->get(2);
                            }else{
                                $page = 1;
                            }
                            
                            for($i=1; $i <= $totalPage;$i++){ ?>
                                <li class="page-item <?php if($page == $i){?> active <?php } ?>"><a href="<?php url('Pegawai/page/'.$i.'/') ?>" class="page-link"><?= $i ?></a></li>
                            <?php } ?>
                            <li class="page-item"><a href="<?php if($page >= $totalPage){ echo"#"; }else{ url('Pegawai/page/'.++$page.'/'); } ?>" class="page-link">Setelahnya</a></li>
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
    $(document).ready(function() {
        $("button[data-toggle]").click(function(){
            var b = $("#list0").html();
            var c = $("button[data-toggle]").html();
            
        });

        $('#example').DataTable({
            
        });
    });
    </script>

</body>

</html>
