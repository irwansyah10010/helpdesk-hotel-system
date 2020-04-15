<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Form User profile</title>

    <?php
    
    inc("include/includeCSS") ?>

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
            <div class="rowPegawai">
                <div class="col-lg-12">
                    <h1 class="page-header">Form User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.rowPegawai -->
            <div class="rowPegawai">
                <?php 
                    $request = new \engine\http\Request;
                    $great = $request->getNotification();
                    
                    echo $great;


                ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Perbarui Data
                        </div>
                        <?php 
                                  
                        
                        $pegawai = new \model\Pegawai();
                        
                        $pegawai->select($pegawai->getTable())->where()
                        ->comparing("nip", $_SESSION['nip'])->ready();

                        $rowPegawai = $pegawai->getStatement()->fetch();

                        $user = new \model\User();
                        
                        $user->select($user->getTable())->where()
                        ->comparing("username", $rowPegawai['email'])->ready();

                        $rowUser = $user->getStatement()->fetch();

                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="<?php url("ubahProfilePegawai/") ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" placeholder="Masukan Kode" name="nip" value="<?php echo $rowPegawai[0]; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" placeholder="Masukan Nama" name="nama_pegawai" value="<?php echo $rowPegawai[1]; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Departement</label>
                                            <input name="kode_departement" type="text" class="form-control" value="<?php echo $rowPegawai[2]; ?>" readonly>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input name="jabatan" type="text" class="form-control" value="<?php echo $rowPegawai[3]; ?>" readonly>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>email</label>
                                            <input class="form-control" placeholder="Name@mail.com" name="email" value="<?php echo $rowPegawai[4]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $rowPegawai[5]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password" value="<?php echo $rowUser['password']; ?>">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Opsi</label>
                                            <select class="form-control" name="ubah_foto" id="foto">
                                                <option value="tidak">tidak</option>
                                                <option value="ganti">ganti</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="tidak">
                                            <input class="form-control" name="tidak_ganti" value="<?php echo $rowPegawai['foto']; ?>" readonly>
                                        </div>

                                        <div class="form-group" id="ganti">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="ganti">
                                            <img src="<?php getFiles($rowPegawai['foto'])?>" alt="None" style="width: 25%; margin: 2% 3%;">
                                        </div><br>

                                        <button type="submit" class="btn btn-default" name="submit">Perbarui</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.rowPegawai (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.rowPegawai -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php inc("include/includeJS") ?>
    <script type="text/javascript">
        $(document).ready(function () {
                /*$("div.poem-stanza").addClass("highlight");
                $("h2").addClass("highlight");
                console.log('Hai');*/

                $("#ganti").hide();

                $("#foto").change(function () {
                    var foto = $("#foto").val();

                    if(foto == "ganti"){
                        $("#ganti").show();
                        $("#tidak").hide();
                    }else if(foto == "tidak"){
                        $("#tidak").show();
                        $("#ganti").hide();
                    }
                });

                /*$("#type3").on('click', function () {
                    $('body').removeClass("fontLarge");
                });

                $("#toogle").on("click.collapse",function (){
                    $("#menu").toggleClass("hidden");
                });

                var trigger = {
                    d: 'default',
                    n: 'narrowPegawai',
                    l: 'large'
                };

                $(document).keypress(function (event) {
                    var key = String.charCodeAt(event.which);

                    $("#switch").val(key);

                });*/

            });
    </script>

</body>
</html>
