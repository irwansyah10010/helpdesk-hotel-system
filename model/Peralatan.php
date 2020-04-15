<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace model;

use engine\abstraction\Model;

class Peralatan extends Model {

    // Field yg di masukan ialah yang tidak mempunyai atribut Auto Increment
    function __construct() {
        $this->initial();
        
        $this->setPrimaryKey('kode_peralatan');
        
        $this->setTable("Peralatan");
        
        $this->setField(['nama_peralatan','jenis_peralatan','keterangan']);
        
    }
}
