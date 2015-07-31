<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends CI_Model {
    
    /**
     * 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取文章信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('article')->row();
    }
    
    /**
     * 获取文章行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        $this->db->select('a.*, c.link AS cat_link, c.name AS cat_name');
		$this->db->from('article AS a');
		$this->db->join('category AS c', 'a.cid=c.cid');
		if($where) $this->db->where($where);
		return $this->db->get()->num_rows();
    }
    
    /**
     * 获取文章列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'a.created DESC') {
        $this->db->select('a.*, c.link AS cat_link, c.name AS cat_name');
		$this->db->from('article AS a');
		$this->db->join('category AS c', 'a.cid=c.cid');
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get()->result();
	}

	public function tag_rows($tid) {
        return $this->db->query('
            SELECT a.*, c.link AS cat_link, c.name AS cat_name
            FROM ' . prefix('relation') . ' AS r, ' . prefix('article') . ' AS a
            LEFT JOIN ' . prefix('category AS c') . ' ON a.cid=c.cid
            WHERE r.aid=a.aid AND r.tid=' . $tid . ' AND a.state=1
        ')->num_rows();
	}

	public function tag_list($tid, $start, $offset) {
        return $this->db->query('
            SELECT a.*, c.link AS cat_link, c.name AS cat_name
            FROM ' . prefix('relation') . ' AS r, ' . prefix('article') . ' AS a
            LEFT JOIN ' . prefix('category AS c') . ' ON a.cid=c.cid
            WHERE r.aid=a.aid AND r.tid=' . $tid . ' AND a.state=1
            LIMIT ' . $start . ', ' . $offset . '
        ')->result();
        
        // return $this->db->query('SELECT p.*, c.id AS cate_id, c.name AS cate_name, c.alias AS cate_alias, c.keywords AS cate_keywords, c.description
					// AS cate_description FROM '.tn('posts').' AS p, '.tn('categories').' AS c, '.tn('tagrelas').' AS t WHERE p.cid=c.id AND t.oid=p.id AND
					// t.tid='.(int) $tid.' AND p.status=1 LIMIT '.(int) $start.', '.(int) $offset);
		// return $query->result_array();
	}

}

/* End of file article_model.php */
/* Location: ./application/models/article_model.php */