<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class DepartementController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        $kode_departement = $this->request->post('kode_departement');
        $nama_departement = $this->request->post('nama_departement');
        $keterangan = $this->request->post('keterangan');
        
        $exampleValidation = [
            'kode_departement' => 'number/null',
            'nama_departement' => 'number/null',
            'keterangan' => 'number/null'
        ];
        
        $this->request->validation($exampleValidation);
        
        $model = new \model\Departement();
        
        $model->fields = [$kode_departement,$nama_departement,$keterangan];
        $model->save();
        
        $this->response->redirect('Departement/','data berhasil ditambah');
    }
    
    function update() {
        $kode_departement = $this->request->post('kode_departement');
        
        $nama_departement = $this->request->post('nama_departement');
        $keterangan = $this->request->post('keterangan');
        
        $id = $this->request->post('kode_departement','string');

        $exampleValidation = [
            'kode_departement' => 'number/null',
            'nama_departement' => 'number/null',
            'keterangan' => 'number/null'
        ];
        
        $this->request->validation($exampleValidation);
        
        $model = new \model\Departement();
        
        $model->fields = [$kode_departement,$nama_departement,$keterangan];
        $model->update($id);
        
        $this->response->redirect('Departement/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new \model\Departement();
        
        $model->remove($id,'string');
        
        $this->response->redirect('Departement/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
    
}
