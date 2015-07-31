<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends A {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['cate'] = $this->category_model->get_rows();
        $data['post'] = $this->article_model->get_rows();
        $data['user'] = $this->user_model->get_rows();
        $data['page'] = $this->page_model->get_rows();
        $data['link'] = $this->link_model->get_rows();
        $data['tags'] = $this->tag_model->get_rows();
        $this->load->view('admin_index', $data);
    }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */