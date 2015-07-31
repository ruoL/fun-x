<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index($cate = 'index', $start = 0) {

        //var_dump($this->uri->segment(1,0));

		if($this->agent->is_mobile()){
            $this->load->view('site_mindex');
      }else{
          $this->load->view('site_index');
       }
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */