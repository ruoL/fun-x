<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index($cate = 'index', $start = 0) {

        $where = array('a.index'=>1, 'a.state'=>1, 'a.aid !='=>81);

        if( $cate !== 'index' ) {

            $c = $this->category_model->get_info(array('link'=>$cate));

    	           if( ! $c ) show_404();

            $this->keyword = $c->keyword;
            $this->description = $c->description;

            $where = array('c.link'=>$cate, 'a.state'=>1);
        }

        $this->load->library('pagination');
        $config['base_url']     = site_url('category/' . $cate);
        $config['total_rows']   = $this->article_model->get_rows($where);
        $config['per_page']     = 100;
        $config['num_links']    = 5;
        $config['uri_segment']  = 3;
        $config['suffix']       = config_item('url_suffix');
        $this->pagination->initialize($config);

        $data['rows'] = $config['total_rows'];
                $data['page'] = $this->pagination->create_links();

                $data['list'] = $this->article_model->get_list($start, $config['per_page'], $where);

        $data['cate'] = $cate;

        $data['link'] = $this->link_model->get_list(0, 100);

        $data['nav_list']=$this->category_model->get_list(0,20);

        $sql="SELECT aid,title FROM big_article ORDER BY views DESC LIMIT 10";

        $query = $this->db->query($sql);

        $data['news_list']=$query->result_array();

       $this->load->view('site_news', $data);


        }   
}