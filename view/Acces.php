<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace view;
/**
 * Description of Acces
 *
 * @author Irwansyah
 */
class Acces {
    
    /*
     * semua value yang tersedia dalam hak akses tanpa perlu memasukan nama sessionnya
     */
    public $accesRight = [
        'ITO', // IT Office
        'O', // Office(admin)
        'HK', // house keeping
        'KTC', // Kitchen
        'FO', // Front Office
        'E' // Enginer
    ];
    
    public $accesCookie = [
        
    ];
    
    
}
