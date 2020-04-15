<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PerbaikiController extends Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        // post(requestData,tipeData yang diinginkan(string,angka),validasi satuan(null,string,number))
        
        $tanggal_perbaikan = date('Y-m-d H:i:s');
        $keterangan = $this->request->post('keterangan');
        $lama_penanganan = $this->request->post('lama_perbaikan');
        $status = "Diperiksa";

        $kode_permasalahan = $this->request->post('kode_permasalahan');
        $nip = $this->request->post('nip');
        $vendor = "no_vendor";
        
        $exampleValidation = [
            'keterangan' => 'null',
            'kode_permasalahan' => 'null',
            'nip' => 'null',
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        $keterangan = $keterangan." lama penanganan ".$lama_penanganan;

        // update status pada permasalahan
        $permasalahan = new \model\Permasalahan();
        $permasalahan->setField(['status']);

        $permasalahan->fields = ['Ditanggapi'];
        $permasalahan->update($kode_permasalahan);

        // simpan perbaikan
        $model = new \model\Perbaikan();
        $model->fields = [$tanggal_perbaikan,$keterangan,$status,$kode_permasalahan,$nip,$vendor];
        $model->save();
        
        $this->response->redirect('Perbaikan/','data berhasil ditambah');
        
    }
    
    function update() {
        $id = $this->request->post('kode_perbaikan','null');
        
        $tanggal_perbaikan = date('Y-m-d H:i:s');
        $keterangan = $this->request->post('keterangan');
        $lama_penanganan = $this->request->post('lama_perbaikan');
        $status = $this->request->post('status');
        $kode_permasalahan = $this->request->post('kode_permasalahan');
        $nip = $this->request->post('nip');
        $vendor = $this->request->post('vendor');

        $penanganan = $this->request->post('penanganan');
        
        $exampleValidation = [
            'keterangan' => 'null',
            'kode_permasalahan' => 'null',
        ];
        
        // validasi dengan data kelompok
        $this->request->validation($exampleValidation);
        $keterangan = $keterangan." lama penanganan ".$lama_penanganan;

        if($penanganan == 'vendor'){
            $nip = $_SESSION['nip'];
            
        }else if($penanganan == 'pegawai'){
            $vendor = "no vendor";
        }

        // update status pada permasalahan
        $permasalahan = new \model\Permasalahan();
        $permasalahan->setField(['status']);

        $permasalahan->fields = [$status];
        $permasalahan->update($kode_permasalahan);

        // perbarui perbaikan
        $model = new \model\Perbaikan();
        $model->fields = [$tanggal_perbaikan,$keterangan,$status,$kode_permasalahan,$nip,$vendor];
        $model->update($id);
        
        $this->response->redirect('Perbaikan/','data berhasil diperbarui');
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $model = new \model\Perbaikan();
        
        $model->remove($id);
        
        $this->response->redirect('Perbaikan/','data berhasil di hapus');
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }
    
}
