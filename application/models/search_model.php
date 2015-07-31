<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_hot_list($limit = 10) {
        return $this->db->limit($limit)->order_by('total DESC')->get('search')->result();
    }

	public function insert_keyword($keyword) {
        
        $keyword = trim($keyword);
        
        $k = $this->db->where(array('keyword'=>$keyword))->get('search')->row();
        
        if( ! $k ) {
            $data['keyword']    = $keyword;
            $data['slug']       = rawurlencode($keyword);
            $data['total']      = 1;
            $this->db->insert('search', $data);
        } else {
            $this->db->set('total', 'total+1', false)->where( array('kid'=>$k->kid) )->update('search');
        }
    }

}

/* End of file search_model.php */
/* Location: ./application/models/search_model.php */