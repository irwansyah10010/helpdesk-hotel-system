<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DDLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of Peralatan
 *
 * @author Irwansyah
 */
class Peralatan {
    //put your code here
    public $ddl,$other,
            $tableName = "Peralatan";
    
    
    
    public function __construct() {
        $this->ddl = new DDLQuery();
        $this->other = new OtherQuery();
    }
    
    public function create() {
        // (nama kolom,kosong atau tidak atau default,panjang length,nilai default,autoIncrement{khusus int})
        
        $this->ddl->integer("kode_peralatan","not null",10,'',"autoIncrement");
        $this->ddl->varchar("nama_peralatan","not null",25,'');
        $this->ddl->varchar("jenis_peralatan","not null",'15');
        $this->ddl->text("keterangan","null");
        
        $this->ddl->primaryKey("kode_peralatan");
        //$this->ddl->foreignKey("columnName","tableName","columnNameTable");
        
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
