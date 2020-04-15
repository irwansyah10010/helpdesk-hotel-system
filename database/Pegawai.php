<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DDLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of Pegawai
 *
 * @author Irwansyah
 */
class Pegawai {
    //put your code here
    public $ddl,$other,
            $tableName = "Pegawai";
    
    
    
    public function __construct() {
        $this->ddl = new DDLQuery();
        $this->other = new OtherQuery();
    }
    
    public function create() {
        // (nama kolom,kosong atau tidak atau default,panjang length,nilai default,autoIncrement{khusus int})
        
        $this->ddl->varchar("nip","not null",8,'');
        $this->ddl->varchar("nama_pegawai","not null",8,'');
        $this->ddl->varchar("kode_departement","not null",5,'');
        $this->ddl->varchar("jabatan","not null",15);
        $this->ddl->typeData("tanggal_lahir","date", "not null", '','');
        
        $this->ddl->primaryKey("nip");
        $this->ddl->foreignKey("kode_departement","departement","kode_departement");
        
        $this->ddl->createTable($this->tableName)->ready();
    }
    
    public function alter(){
        $this->ddl->alterTable($this->tableName)->addPrimaryKey("namaKolom");
        //$this->ddl->alterTable($this->tableName)->change($columnBefore, $columnAfter);
        //$this->ddl->alterTable($this->tableName)->modify($columnBefore,$typeData);
        //$this->ddl->alterTable($this->tableName)->drop($columnName);
        
        
        $this->ddl->execute($this->ddl->executeAlter());
    }
    
    public function truncate(){
        $this->other->truncate($this->tableName);
        
        $this->other->ready();
    }

    public function drop(){
        $this->other->dropTable($this->tableName);
        
        $this->other->ready();
    }
}
