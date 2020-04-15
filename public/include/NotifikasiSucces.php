<?php 
    $request = new \engine\http\Request;
    $notifikasi = $request->getNotification();
    
    if($notifikasi != ''){
?>
    <br><div class="alert alert-succes alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $notifikasi; ?> 
    </div><br>
<?php } ?>
