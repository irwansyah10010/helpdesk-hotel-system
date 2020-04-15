<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DDLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of Perbaikan
 *
 * @author Irwansyah
 */
class Perbaikan {
    //put your code here
    public $ddl,$other,
            $tableName = "Perbaikan";
    
    
    
    public function __construct() {
        $this->ddl = new DDLQuery();
        $this->other = new OtherQuery();
    }
    
    public function create() {
        // (nama kolom,kosong atau tidak atau default,panjang length,nilai default,autoIncrement{khusus int})
        
        $this->ddl->integer("kode_perbaikan","not null",10,"","autoIncrement");
        $this->ddl->typeData("tanggal_perbaikan","datetime", "null");
        $this->ddl->text("keterangan");
        $this->ddl->varchar("status","not null",15);
        $this->ddl->integer("kode_peralatan","not null",10,"");
        $this->ddl->varchar("nip","not null",8);

        /*
        $this->ddl->varchar("varchar","not null",10);
        $this->ddl->integer("int","not null",10,"","autoIncrement");
        $this->ddl->floats("float","default",10,6.5);
        $this->ddl->char("char","null");
        $this->ddl->text("text");
        $this->ddl->typeData("columnName","date", "null", 20,"autoIncrement");
        */

        $this->ddl->primaryKey("kode_perbaikan");
        $this->ddl->foreignKey("kode_peralatan","peralatan","kode_peralatan");
        $this->ddl->foreignKey("nip","pegawai","nip");
        //$this->ddl->unique("columnName");
        
        $this->ddl->createTable($this->tableName)->ready();
    }
    
    public function alter(){
        $this->ddl->alterTable($this->tableName)->add("vendor","varchar(20)");
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
