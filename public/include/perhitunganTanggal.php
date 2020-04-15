<?php 

function cetakTanggal($tanggal){
    $pesan = "";
    if($tanggal->i != 0){
        $pesan = "$tanggal->i Menit $tanggal->s Detik yang lalu";
        if($tanggal->h != 0){
            $pesan = "$tanggal->h Jam $tanggal->i Menit yang lalu";
            if($tanggal->d != 0){
                $pesan = "$tanggal->d Hari $tanggal->h Jam yang lalu";
                if($tanggal->m != 0){
                    $pesan = "$tanggal->m Bulan $tanggal->d Hari yang lalu";
                }
            }
        }
    }

    return $pesan;
}

?>