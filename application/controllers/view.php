<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index($aid = 0) {
        
        $article = $this->article_model->get_info(array('aid'=>$aid, 'state'=>1));
        
        if( ! $article ) show_404();
        
        $this->db->set('views', 'views+1', false)->where( array('aid'=>$aid) )->update('article');
        
        $this->title        = $article->title;
		$this->keyword      = $article->keyword;
		$this->description  = $article->description;
        

        $data['nav_list']=$this->category_model->get_list(0,20);

        $sql="SELECT aid,title FROM big_article ORDER BY views DESC LIMIT 10";

        $query = $this->db->query($sql);

        $data['news_list']=$query->result_array();

        $data['article'] = $article;
        
        $this->load->view('site_news_main', $data);

    }

}

/* End of file view.php */
/* Location: ./application/controllers/view.php */