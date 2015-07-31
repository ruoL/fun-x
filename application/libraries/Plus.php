<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plus {

    private $ci;

    public function __construct() {
		$this->ci = & get_instance();
    }
    
    public function get_site_menu() {
        return $this->ci->category_model->get_list(0, 100);
    }
    
    public function get_site_page() {
        return $this->ci->page_model->get_list(0, 100);
    }
    
    public function get_article_publish() {
        return $this->ci->article_model->get_rows(array('a.state'=>1));
    }

    public function get_article_draft() {
        return $this->ci->article_model->get_rows(array('a.state'=>0));
    }
    
    public function get_article_trash() {
        return $this->ci->article_model->get_rows(array('a.state'=>2));
    }
    
    public function get_hot_article($limit = 8) {
        return $this->ci->article_model->get_list(0, $limit, array('a.state'=>1), 'a.views DESC');
    }
    
    public function get_dom_article($limit = 8) {
        return $this->ci->db->query('
            SELECT a.*, c.link AS cat_link, c.name AS cat_name
            FROM ' . prefix('article') . ' AS a JOIN ' . prefix('category') . ' AS c
            ON a.cid=c.cid
            WHERE a.state=1
            ORDER BY rand()
            DESC LIMIT ' . $limit
        )->result();
    }
    
    public function get_hot_tag($limit = 16) {
        return $this->ci->tag_model->get_list(0, $limit);
    }
    
    public function get_tag_by_aid($aid) {
        return $this->ci->tag_model->select_by_aid($aid);
    }
    
    public function get_username_by_uid($uid) {
        $user = $this->ci->user_model->get_info(array('uid'=>$uid));
        return $user ? $user->username : 'NULL';
    }

}

/* End of file Plus.php */
/* Location: ./application/libraries/Plus.php */