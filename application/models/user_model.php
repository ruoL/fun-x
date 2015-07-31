<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    
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
     * 获取用户信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('user')->row();
    }
    
    /**
     * 获取用户行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('user')->num_rows();
    }
    
    /**
     * 获取用户列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'uid DESC') {
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get('user')->result();
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */