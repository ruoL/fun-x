<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
    
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
     * 获取分类信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('category')->row();
    }
    
    /**
     * 获取分类行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('category')->num_rows();
    }
    
    /**
     * 获取分类列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'sort ASC, cid ASC') {
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get('category')->result();
	}
    
    /**
     * 删除指定分类
     * 
     * @access public
     * @params string $cid 标签ID
     * @return boolean
     */
    public function delete_by_cid($cid) {
        $this->db->delete('category', array('cid'=>(int) $cid));
        
        if( ! $this->db->affected_rows() ) {
            return false;
        }
        
		$this->db->where(array('pid'=>$cid))->delete('category');
        return true;
    }

}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */