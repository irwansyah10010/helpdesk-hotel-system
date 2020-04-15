<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PeralatanController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        $nama_peralatan = $this->request->post('nama_peralatan');
        $jenis_peralatan = $this->request->post('jenis_peralatan');
        $models = $this->request->post('model');
        $keterangan = $this->request->post('keterangan');
        
        $exampleValidation = [
            'nama_peralatan' => 'number/null',
            'jenis_peralatan' => 'number/null',
            'keterangan' => 'number/null',
            'model' => 'null'
        ];
        
        $this->request->validation($exampleValidation);
        
        $model = new \model\Peralatan();
        
        $model->fields = [$nama_peralatan,$jenis_peralatan,$models,$keterangan];
        $model->save();
        
        $this->response->redirect('Peralatan/','data berhasil ditambah');
        
    }
    
    function update() {
        $kode_peralatan = $this->request->post('kode_peralatan');
        $nama_peralatan = $this->request->post('nama_peralatan');
        $models = $this->request->post('model');
        $jenis_peralatan = $this->request->post('jenis_peralatan');
        $keterangan = $this->request->post('keterangan');
        
        $exampleValidation = [
            'nama_peralatan' => 'number/null',
            'jenis_peralatan' => 'number/null',
            'keterangan' => 'number/null',
            'model' => 'null'
        ];
        
        
        $this->request->validation($exampleValidation);
        
        $model = new \model\Peralatan();
        
        $model->fields = [$nama_peralatan,$jenis_peralatan,$models,$keterangan];
        $model->update($kode_peralatan);
        
        $this->response->redirect('Peralatan/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $confirm = 0;

        $model = new \model\Peralatan();
        
        echo "";

        $model->remove($id);
        
        $this->response->redirect('Peralatan/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
    
}
