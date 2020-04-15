<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace engine\abstraction;

use engine\http\Request;
use engine\http\Response;

class Controller {
    protected $request,$response;
    
    function __construct() {
        $this->request = new Request();
        $this->response = new Response();
    }
}