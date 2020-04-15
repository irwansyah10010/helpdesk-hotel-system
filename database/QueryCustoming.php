<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\OtherQuery;
/**
 * Description of Dosen
 *
 * @author Irwansyah
 */
class QueryCustoming {
    //put your code here
    
    public function exe() {
        $other = new OtherQuery();
        
        $other->setQuery("create view pegawai_departement as SELECT `nip`,`nama_pegawai`,departement.kode_departement,departement.nama_departement,`jabatan`,`email`,`tanggal_lahir`,`foto`
        from pegawai JOIN departement ON departement.kode_departement = pegawai.kode_departement");
        
        $other->execute($other->exeQuery());
    }
    
}

?>