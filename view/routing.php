<?php

/*
 * init variabel dengan variabel random
 * jika menampilkan data berdasarkan kategori tertentu
 * route->get(url, view, acces)
 * route->get(url data -> url default namaprojek/public/,
 *            tampilan yang ingin digunakan bisa dengan halaman web atau controller,
 *              hak akses dari halaman tersebut -> default bisa akses oleh semua, ['nama session' => 'value']);
 * 
 */

use engine\http\Route;
use engine\http\Response;
use engine\errors\ErrorCode;
use engine\errors\SessionError;

class Routing{
    public $routes,$response;
    
    public function __construct() {
        
        
        
        $this->routes = new Route();
        $this->response = new Response();
        
        $route = $this->routes;

        /*
        * set error location
        */
        ErrorCode::setPageError("error-configuration.php");
        ErrorCode::setLocationError("view");

        /*
        * set Session Error location 
        */
        SessionError::setLocationSession('Logout/');

        /*
        * Add Route this
        */

       // homepage
       $route->get('', function (){
            $this->response->view('index');
       },['hak_akses' => ['ITO','O','HK','KTC','FO','E']]);

        /*
        * Halaman login user
        */
        $route->get('User/Login/', function ($array){
            
            $this->response->view('pages/login');
        });

        $route->post('Login/', function ($array){
            $array['id'] = 1;
            
            $this->response->view('UserController&login',$array);
        },'submit');

        $route->get('Logout/', function ($array){
            $array['id'] = 1;
            
            $this->response->view('UserController&logout',$array);
        });

        /*
        * Halaman User
        */
        $route->get('User/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('pages/user/index');
        },['hak_akses' => ['ITO']]);

        $route->get('User/page/(id)/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('pages/user/index',$array);
        },['hak_akses' => ['ITO']]);
 
        $route->get('User/add/', function ($array){
             //$array['id'] = 1;
             
             $this->response->view('pages/user/form-input');
        },['hak_akses' => ['ITO']]);
 
         $route->post('addUser/', function (){
             $this->response->view('UserController&save');
         },'submit',['hak_akses' => ['ITO']]);
 
         $route->get('User/perbarui/(id)/', function ($array){
             //$array['id'] = 1;
 
             $this->response->view('pages/user/form-perbarui',$array);
         },['hak_akses' => ['ITO']]);
 
         $route->post('perbaruiUser/', function (){
             $this->response->view('UserController&update');
         },'submit',['hak_akses' => ['ITO']]);
 
         $route->get('hapusUser/(id)/', function ($array){
             $this->response->view('UserController&remove',$array);
         },['hak_akses' => ['ITO']]);

         $route->get('UserProfile/', function ($array){
            $this->response->view('pages/user/user-profile',$array);
        },['hak_akses' => ['ITO','O','HK','KTC','FO','E']]);

       /* 
        * Halaman pegawai
        */
       $route->get('Pegawai/', function ($array){
           //$array['id'] = 1;
           
           $this->response->view('Pegawai/index');
       },['hak_akses' => ['ITO','O']]);

       $route->get('Pegawai/page/(id)/', function ($array){
        //$array['id'] = 1;
        
        $this->response->view('Pegawai/index');
        },['hak_akses' => ['ITO','O']]);

       $route->get('Pegawai/add/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Pegawai/form-input');
        },['hak_akses' => ['ITO','O']]);

        $route->post('addPegawai/', function (){
            $this->response->view('PegawaiController&save');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('Pegawai/perbarui/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Pegawai/form-perbarui',$array);
        },['hak_akses' => ['ITO','O']]);

        $route->post('perbaruiPegawai/', function (){
            $this->response->view('PegawaiController&update');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('Pegawai/hapus/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Pegawai/form-hapus',$array);
        },['hak_akses' => ['ITO','O']]);

        $route->get('hapusPegawai/(id)/', function ($array){
            $this->response->view('PegawaiController&remove',$array);
        },['hak_akses' => ['ITO','O']]);

        $route->get('Pegawai/ubah-profile/', function ($array){
            $this->response->view('Pegawai/form-ubah-profile',$array);
        },['hak_akses' => ['ITO','O','HK','KTC','FO','E']]);

        $route->post('ubahProfilePegawai/', function ($array){
            $this->response->view('PegawaiController&ubahProfile',$array);
        },'submit');

        /* 
        * Halaman departement  
        */
       $route->get('Departement/', function ($array){
        //$array['id'] = 1;
        
            $this->response->view('Departement/index');
        },['hak_akses' => ['ITO','O']]);

        $route->get('Departement/page/(id)/', function ($array){
            //$array['id'] = 1;
            
                $this->response->view('Departement/index');
        },['hak_akses' => ['ITO','O']]);

        $route->get('Departement/add/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Departement/form-input');
        },['hak_akses' => ['ITO','O']]);

        $route->post('addDepartement/', function (){
            $this->response->view('DepartementController&save');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('Departement/perbarui/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Departement/form-perbarui',$array);
        },['hak_akses' => ['ITO','O']]);

        $route->post('perbaruiDepartement/', function (){
            $this->response->view('DepartementController&update');
        },'submit',['hak_akses' => ['ITO','O']]);

        $route->get('hapusDepartement/(id)/', function ($array){
            $this->response->view('DepartementController&remove',$array);
        },['hak_akses' => ['ITO','O']]);

        /*
        * Permasalahan
        */
        $route->get('Permasalahan/', function ($array){
            //$array['id'] = 1;
        
            $this->response->view('Permasalahan/index');
        },['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->get('Permasalahan/page/(id)/', function ($array){
            //$array['id'] = 1;
        
            $this->response->view('Permasalahan/index',$array);
        },['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->get('Permasalahan/add/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Permasalahan/form-input');
        },['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->post('addPermasalahan/', function (){
            $this->response->view('PermasalahanController&save');
        },'submit',['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->get('Permasalahan/perbarui/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Permasalahan/form-perbarui',$array);
        },['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->post('perbaruiPermasalahan/', function (){
            $this->response->view('PermasalahanController&update');
        },'submit',['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);

        $route->get('hapusPermasalahan/(id)/', function ($array){
            $this->response->view('PermasalahanController&remove',$array);
        },['hak_akses' => ['ITO','O','FO','KTC','E','HK']]);
       
        /*
        * Perbaikan
        */
        $route->get('Perbaikan/', function ($array){
            //$array['id'] = 1;
        
            $this->response->view('Perbaikan/index');
        },['hak_akses' => ['ITO','O','E']]);

        $route->get('Perbaikan/page/(id)/', function ($array){
            //$array['id'] = 1;
        
            $this->response->view('Perbaikan/index');
        },['hak_akses' => ['ITO','O','E']]);

        $route->get('Perbaikan/add/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Perbaikan/form-input');
        },['hak_akses' => ['ITO','O','E']]);

        $route->get('Perbaikan/add/(id)/', function ($array){
            //$array['id'] = 1;
            
            $this->response->view('Perbaikan/form-input');
        },['hak_akses' => ['ITO','O','E']]);

        $route->post('addPerbaikan/', function (){
            $this->response->view('PerbaikiController&save');
        },'submit',['hak_akses' => ['ITO','O','E']]);

        
        $route->get('Perbaikan/perbarui/(id)/', function ($array){
            //$array['id'] = 1;

            $this->response->view('Perbaikan/form-perbarui',$array);
        },['hak_akses' => ['ITO','O','E']]);

        $route->post('perbaruiPerbaikan/', function (){
            $this->response->view('PerbaikiController&update');
        },'submit',['hak_akses' => ['ITO','O','E']]);

        $route->get('hapusPerbaikan/(id)/', function ($array){
            $this->response->view('PerbaikiController&remove',$array);
        },['hak_akses' => ['ITO','O','E']]);


       // End added route
       $route->checkRoute();
    }
}
?>