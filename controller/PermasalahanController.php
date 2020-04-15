<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PermasalahanController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))

        $tanggal_permasalahan = date('Y-m-d H:i:s');
        $keterangan = $this->request->post('keterangan');
        $posisi = $this->request->post('lokasi');

        $kode_departement = $this->request->post('kode_departement');

        $status = 'Dibuat';
        $nip = $_SESSION['nip'];

        $exampleValidation = [
            'keterangan' => 'null',
            'lokasi' => 'null'
        ];

        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);

        $laporan  = $keterangan.' di '.$posisi;
        
        $model = new \model\Permasalahan();
        
        $model->fields = [$tanggal_permasalahan,$laporan,$status,$nip,$kode_departement];
        $model->save();
        
        $this->response->redirect('Permasalahan/','data berhasil ditambah');
        
    }
    
    function updateStatus(){

        $status = 'Dilihat';
        $kode_permasalahan = $request->post('kode_permasalahan');
        

        $exampleValidation = [
            'keterangan' => 'null',
        ];

        // validasi dengan data kelompok
        //$this->request->validation($exampleValidation);
        
        $model = new \model\Permasalahan();
        
        // merubah field sementara
        $model->setField(['status']);

        $model->fields = [$status];
        $model->update($id);
        
        $this->response->redirect('Permasalahan/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new \model\Permasalahan();
        
        $model->remove($id);
        
        $this->response->redirect('Permasalahan/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
    
}
