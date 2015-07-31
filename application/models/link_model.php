<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link_model extends CI_Model {
    
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
     * 获取链接信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('link')->row();
    }
    
    /**
     * 获取链接行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('link')->num_rows();
    }
    
    /**
     * 获取链接列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'sort ASC, lid ASC') {
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get('link')->result();
	}
    
    /**
     * 删除指定链接
     * 
     * @access public
     * @params string $lid 链接ID
     * @return boolean
     */
    public function delete_by_lid($lid) {
        $this->db->delete('link', array('lid'=>(int) $lid));
        return $this->db->affected_rows();
    }

}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */