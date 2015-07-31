<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Play_model extends CI_Model {
    
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
     * 获取标签信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('tag')->row();
    }
    
    /**
     * 获取标签行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('tag')->num_rows();
    }
    
    /**
     * 获取标签列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'total DESC') {
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get('tag')->result();
	}
    



}

/* End of file tag_model.php */
/* Location: ./application/models/tag_model.php */