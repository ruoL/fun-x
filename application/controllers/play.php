<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Play extends S {
    
    private $_prepage = 20;
    
    public function __construct() {
        parent::__construct();
    }

    public function index($start = 0) {
        
        $this->load->view('site_play_index', $data);
    }
    
    public function name($name = '', $start = 0) {
        $tag = $this->tag_model->get_info(array('slug'=>$name));
        
        if( ! $tag ) show_404();
        
        $this->load->library('pagination');
        $config['base_url']     = site_url('tag/' . $name);
        $config['total_rows']   = $this->article_model->tag_rows($tag->tid);
        $config['per_page']     = $this->_prepage;
        $config['num_links']    = 5;
        $config['uri_segment']	= 3;
        $config['suffix']       = config_item('url_suffix');
        $this->pagination->initialize($config); 
        
        $data['pres'] = $this->_prepage;
        $data['rows'] = $config['total_rows'];
		$data['page'] = $this->pagination->create_links();
        
		$data['list'] = $this->article_model->tag_list($tag->tid, $start, $config['per_page']);
        
        $data['tag']  = $tag;

        $this->load->view('site_tag', $data);
    }

}

/* End of file tag.php */
/* Location: ./application/controllers/tag.php */