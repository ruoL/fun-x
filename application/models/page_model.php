<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {
    
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
     * 获取页面信息
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_info($where) {
		return $this->db->where($where)->get('page')->row();
    }
    
    /**
     * 获取页面行数
     * 
     * @access public
     * @params array $where 查询条件
     * @return array
     */
    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('page')->num_rows();
    }
    
    /**
     * 获取页面列表
     * 
     * @access public
     * @params int $start 超始位置
     * @params int $offset 查询偏移
     * @params array $where 查询条件
     * @params string $order 排序方式
     * @return array
     */
	public function get_list($start, $offset, $where = array(), $order = 'sort ASC, pid ASC') {
		if($where) $this->db->where($where);
		return $this->db->limit($offset, $start)->order_by($order)->get('page')->result();
	}
    
    /**
     * 删除指定页面
     * 
     * @access public
     * @params string $pid 页面ID
     * @return boolean
     */
    public function delete_by_pid($pid) {
        $this->db->delete('page', array('pid'=>(int) $pid));
        return $this->db->affected_rows();
    }

}

/* End of file page_model.php */
/* Location: ./application/models/page_model.php */