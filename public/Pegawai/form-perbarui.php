<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME ?>Form Pegawai</title>

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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Perbarui</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
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
                        ->comparing("nip", $request->get(2))->ready();

                        $row = $pegawai->getStatement()->fetch();

                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php url("perbaruiPegawai/") ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" placeholder="Masukan Kode" name="nip" value="<?php echo $row[0]; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" placeholder="Masukan Nama" name="nama_pegawai" value="<?php echo $row[1]; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Departement</label>
                                            <select class="form-control" name="kode_departement">
                                            <?php
                                                $departement = new \model\Departement();
                        
                                                $departement->select($departement->getTable())->ready();
                            
                                                while($rows = $departement->getStatement()->fetch()){
                                                    ?><option value="<?php echo $rows[0]?>" <?php if($rows[0] == $row[2]){?> selected  <?php } ?>><?php echo $rows[1] ?></option>
                                            <?php 
                                                }
                                            ?>
                                            </select>
                                            <p class="help-block">Select : <?php echo $row[2]; ?></p>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="jabatan">
                                                <option value="Kepala Bagian">Kepala Bagian</option>
                                                <option value="Bagian">Bagian</option>
                                            </select>
                                            <p class="help-block">Select : <?php echo $row[3]; ?></p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>email</label>
                                            <input class="form-control" placeholder="Name@mail.com" name="email" value="<?php echo $row[4]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $row[5]; ?>">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Opsi</label>
                                            <select class="form-control" name="ubah_foto" id="foto">
                                                <option value="tidak">tidak</option>
                                                <option value="ganti">ganti</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="tidak">
                                            <input class="form-control" name="tidak_ganti" value="<?php echo $row['foto']; ?>" readonly>
                                        </div>

                                        <div class="form-group" id="ganti">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="ganti">
                                            <img src="<?php getFiles($row['foto'])?>" alt="None" style="width: 25%; margin: 2% 3%;">
                                        </div><br>

                                        <button type="submit" class="btn btn-default" name="submit">Perbarui</button>
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
                    n: 'narrow',
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
