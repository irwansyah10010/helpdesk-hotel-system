<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;


use engine\abstraction\Controller;

class PegawaiController extends Controller{
    //put your code here
    public $file;

    public function __construct() {
        parent::__construct();

        $this->file = new \engine\files\Files();
    }
    
    public function create(){
        $this->response->view('help/index');
    }
    
    public function save(){
        $nip = $this->request->post('nip');
        $nama_pegawai = $this->request->post('nama_pegawai');
        $kode_departement = $this->request->post('kode_departement');
        $jabatan = $this->request->post('jabatan');
        $email = $this->request->post('email');
        $tanggal_lahir = $this->request->post('tanggal_lahir');

        $uploadFoto = $this->file->upload('foto',$nama_pegawai,"user/");


        $exampleValidation = [
            'nip' => 'null',
            'nama_pegawai' => 'null',
            'kode_departement' => 'null',
            'jabatan' => 'null',
            'email' => 'null',
            'tanggal_lahir' => 'null'
        ];
        
        $this->request->validation($exampleValidation);
        
        if($uploadFoto['pesan'] == ''){
            $pegawai = new \model\Pegawai();
        
            $pegawai->fields = [$nip,$nama_pegawai,$kode_departement,$jabatan,$email,$tanggal_lahir,$uploadFoto['file']];
            $pegawai->save();

            if($jabatan == 'Kepala Bagian'){
                $tanggalLahir =str_replace("-","",$tanggal_lahir);

                $user = new \model\User();
                $user->fields = [$nip,$email,$tanggalLahir,$kode_departement];
                $user->save();
            }
            
            $this->response->redirect('Pegawai/','data berhasil ditambah');
        }else{
            $this->response->back($uploadFoto['pesan']);
        }
    }
    
    function update() {
        $nip = $this->request->post('nip','');
        $nama_pegawai = $this->request->post('nama_pegawai','null');
        $kode_departement = $this->request->post('kode_departement','null');
        $jabatan = $this->request->post('jabatan','null');
        $email = $this->request->post('email');
        $tanggal_lahir = $this->request->post('tanggal_lahir','null');
        $ubah_foto = $this->request->post('ubah_foto','null');


        $foto = "";

        $id = $this->request->post('nip','string');
        
        if($ubah_foto == 'ganti'){
            $foto = $this->file->upload('ganti',$nama_pegawai,"user/");
        }else if($ubah_foto == 'tidak'){
            $foto = $this->request->post('tidak_ganti','null');
        }

        $exampleValidation = [
            'nip' => 'null',
            'nama_pegawai' => 'null',
            'kode_departement' => 'null',
            'jabatan' => 'null',
            'tanggal_lahir' => 'null'
        ];
        
        $this->request->validation($exampleValidation);
        $pegawai = new \model\Pegawai();

        // ganti
        if(is_array($foto)){
            if($foto['pesan'] == ''){
            
                $pegawai->fields = [$nip,$nama_pegawai,$kode_departement,$jabatan,$email,$tanggal_lahir,$foto['file']];
                $pegawai->update($id);
    
                
                if($jabatan == 'Kepala Bagian'){
                    $tanggalLahir =str_replace("-","",$tanggal_lahir);
    
                    $user = new \model\User();
                    $user->fields = [$nip,$email,$tanggalLahir,$kode_departement];
                    $user->save();
                }
                
                $this->response->redirect('Pegawai/','data berhasil diperbarui');
            }else{
                $this->response->back($uploadFoto['pesan']);
            }   
        // tidak
        }else{
            $pegawai->fields = [$nip,$nama_pegawai,$kode_departement,$jabatan,$email,$tanggal_lahir,$foto];
            $pegawai->update($id);

            if($jabatan == 'Kepala Bagian'){
                $tanggalLahir =str_replace("-","",$tanggal_lahir);

                $user = new \model\User();
                $user->fields = [$nip,$email,$tanggalLahir,$kode_departement];
                $user->save();
            }

            $this->response->redirect('Pegawai/','data berhasil diperbarui');
        }
    }
    
    function remove() {
        $id = $this->request->get(1);
        
        $pegawai = new \model\Pegawai();
        $pegawai->select($pegawai->getTable())->where()->comparing("nip",$id)->ready();
        $row = $pegawai->getStatement()->fetch();

        if($row['jabatan'] == "Kepala Bagian"){
            $user = new \model\User();
            $user->select($user->getTable())->where()->comparing("id_user",$row['nip'])->ready();
            $user->remove($id,'string');
        }

        // cek permasalahan apakah ada data pegawai terkait
        $permasalahan = new \model\Permasalahan();
        $permasalahan->select($pegawai->getTable())->where()->comparing("nip",$id)->ready();
        $rowPermasalahan = $permasalahan->getStatement()->fetch();

        $permasalahan->remove($rowPermasalahan['nip'],'string');

        // cek perbaikan apakah ada data pegawai terkait
        $perbaikan = new \model\Perbaikan();
        $perbaikan->select($perbaikan->getTable())->where()->comparing("nip",$id)->ready();
        $rowPerbaikan = $perbaikan->getStatement()->fetch();

        $perbaikan->remove($rowPerbaikan['nip'],'string');

        // hapus pegawai
        
        $pegawai->remove($id,'string');
        
        $this->response->redirect('Pegawai/','data berhasil di hapus');
    }

    function ubahProfile(){
        $nip = $this->request->post('nip','');
        $nama_pegawai = $this->request->post('nama_pegawai');
        $kode_departement = $this->request->post('kode_departement');
        $jabatan = $this->request->post('jabatan');
        $email = $this->request->post('email');
        $tanggal_lahir = $this->request->post('tanggal_lahir');
        $password = $this->request->post('password');
        $ubah_foto = $this->request->post('ubah_foto');

        $foto = "";
        $id = $this->request->post('nip','string');
        
        if($ubah_foto == 'ganti'){
            $foto = $this->file->upload('ganti',$nama_pegawai,"user/");
        }else if($ubah_foto == 'tidak'){
            $foto = $this->request->post('tidak_ganti','null');
        }

        $exampleValidation = [
            'nip' => 'null',
            'nama_pegawai' => 'null',
            'kode_departement' => 'null',
            'jabatan' => 'null',
            'password' => 'null',
            'tanggal_lahir' => 'null'
        ];
        
        $this->request->validation($exampleValidation);
        $pegawai = new \model\Pegawai();

        // ganti
        if(is_array($foto)){
            if($foto['pesan'] == ''){
            
                $pegawai->fields = [$nip,$nama_pegawai,$kode_departement,$jabatan,$email,$tanggal_lahir,$foto['file']];
                $pegawai->update($id);
    
                
                if($jabatan == 'Kepala Bagian'){
    
                    $user = new \model\User();
                    $user->fields = [$nip,$email,$password,$kode_departement];
                    $user->update($id);
                }
                
                $this->response->redirect('UserProfile/','data berhasil diperbarui');
            }else{
                $this->response->back($uploadFoto['pesan']);
            }   
        // tidak
        }else{
            $pegawai->fields = [$nip,$nama_pegawai,$kode_departement,$jabatan,$email,$tanggal_lahir,$foto];
            $pegawai->update($id);

            if($jabatan == 'Kepala Bagian'){
    
                $user = new \model\User();
                $user->fields = [$nip,$email,$password,$kode_departement];
                $user->update($id);
            }

            $this->response->redirect('UserProfile/','data berhasil diperbarui');
        }
    }
    
    function search() {
        $colom = $this->request->post('sort','mhsID');
        $type = $this->request->post('type','ASC');
        
        echo $colom;
        echo $type;
        
        $this->response->redirect('help/1/column/'.$colom.'/tipe/'.$type.'/');
    }

    
    
}
