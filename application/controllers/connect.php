<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
    
    if($this->agent->is_mobile()){
            $this->load->view('site_mconnect');
       }else{
           $this->load->view('site_connect');
       }
    
    }

    
}