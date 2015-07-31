<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index($link = '') {

        $page = $this->page_model->get_info(array('link'=>$link));
        
        if( ! $page ) show_404();
        
        $this->db->set('views', 'views+1', false)->where( array('pid'=>$page->pid) )->update('page');
        
        $this->title        = $page->name;
		$this->keyword      = $page->keyword;
		$this->description  = $page->description;
        
        $page->title = $page->name;
        
        $data['article'] = $page;
    
        $this->load->view('site_article_page', $data);
    }

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */