<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fuwu extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        //var_dump($this->uri->segment(1,0));
        $this->load->view('site_mfuwu');

    }

}
