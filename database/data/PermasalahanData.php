<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use engine\database\order\DMLQuery;
use engine\database\order\OtherQuery;
/**
 * Description of PermasalahanData
 *
 * Column is kode_permasalahan tanggal_permasalahan keterangan status nip 
 * 
 * @author Irwansyah
 */
class PermasalahanData {
    //put your code here
    public $dml,$other,
    $tableName = "PermasalahanData",
    $columnData = array(),$dataList = array();
    
    public function __construct() {
        $this->dml = new DMLQuery();
        $this->other= new OtherQuery();
        
        $desc = $this->other->describe($this->tableName);
        $this->other->execute($desc);

        while($row = $this->other->getStatement()->fetch()){
            $this->columnData[] = $row[0];
        }
    }
    
    public function setDataList($dataList) {
        $this->dataList = $dataList;
    }
    
    public function go(){
        
        $this->setDataList(['isi 1','isi 2','isi 3']);
        
        $this->dml->save($this->tableName, $this->columnData);
        
        $this->dml->execute($this->dml->exeQuery(), $this->dataList);
    }
    
    public function update($columnKey,$key){
        
        $this->setDataList(['isi 1','isi 2','isi 3']);
        
        $this->dml->update($this->tableName, $this->columnData, $columnKey, $key);
        
        $this->dml->execute($this->dml->exeQuery(), $this->dataList);
    }
    
    public function delete($columnKey,$key){
        $this->dml->delete($this->tableName, $columnKey,$key);
        $this->dml->execute($this->dml->exeQuery());
    }
    
}
