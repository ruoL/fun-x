<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_model extends CI_Model {
    
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
    
    /**
     * 为指定文章创建标签
     * 
     * @access public
     * @params int $aid 文章ID
     * @params string $tag 标签
     * @return int
     */
    public function create_by_aid($aid, $tag) {
        $tag = trim($tag);
        $tid = $this->isset_tag($tag);

        if( $tid === 0 ) {
            $this->db->insert('tag', array('name'=>$tag, 'slug'=>rawurlencode($tag)));
            $tid = $this->db->insert_id();
        } else {
            $this->db->set('total', 'total+1', false)->where(array('tid'=>$tid))->update('tag');
        }

        $this->db->insert('relation', array('aid'=>$aid, 'tid'=>$tid));

        return $this->db->affected_rows() ? $tid : 0;
    }
    
    /**
     * 删除指定应用标签（如果$tid=0，则删除指定应用的全部标签，否则只删除指定应用的指定标签）
     * 
     * @access public
     * @params int $aid 应用ID
     * @params int $tid 标签ID
     * @return int
     */
    public function delete_by_aid($aid, $tid = 0) {
    
        if( $tid === 0 ) {
            if( $tag = $this->select_by_aid($aid) ) {
                foreach($tag AS $k=>$v) {
                    $this->clear_tag($v->tid);
                }
            }
            $this->db->where(array('aid'=>$aid))->delete('relation');
        } else {
            $this->clear_tag($tid);
            $this->db->where(array('aid'=>$aid, 'tid'=>$tid))->delete('relation');
        }
        
        return $this->db->affected_rows();
    }

    /**
     * 查询指定文章的标签
     * 
     * @access public
     * @params int $aid 文章ID
     * @return int
     */
    public function select_by_aid($aid) {
        $this->db->select('r.aid, t.tid, t.name, t.slug, t.total');
		$this->db->from('relation AS r');
		$this->db->join('tag AS t', 't.tid=r.tid');
        $this->db->where(array('r.aid'=>$aid));
		return $this->db->order_by('tid ASC')->get()->result();
    }

    /**
     * 彻底删除指定标签
     * 
     * @access public
     * @params int $tid 标签ID
     * @return int
     */
    public function delete_by_tid($tid) {
    
        $this->db->where(array('tid'=>$tid))->delete('relation');
        $this->db->where(array('tid'=>$tid))->delete('tag');
        return $this->db->affected_rows();
    }

    /**
     * 检查指定文章是否已有某个标签
     * 
     * @access public
     * @params int $aid 文章ID
     * @params string $tag 标签
     * @return boolean
     */
    public function isset_by_aid($aid, $tag) {
        $tag = trim($tag);
        $tid = $this->isset_tag($tag);
        
        if($tid === 0) return false;
        
        $row = $this->db->where(array('aid'=>$aid, 'tid'=>$tid))->get('relation')->num_rows();
        return $row ? true : false;
    }

    /**
     * 检查标签是否已存在
     * 
     * @access public
     * @params string $tag 标签
     * @return int
     */
    public function isset_tag($tag) {
        $tag = $this->db->where(array('name'=>rawurldecode($tag)))->get('tag')->row();
        return $tag ? $tag->tid : 0;
	}

    /**
     * 精确删除标签，如果为1则删除，否则减1
     * 
     * @access public
     * @params string $tid 标签ID
     * @return int
     */
    public function clear_tag($tid) {

        $total = (int) $this->db->where(array('tid'=>$tid))->get('tag')->row('total');

        if( $total <= 1 ) {
            $this->db->where(array('tid'=>$tid))->delete('tag');
        } else {
            $this->db->set('total', 'total-1', false)->where(array('tid'=>$tid))->update('tag');
        }

        return $this->db->affected_rows();
    }

}

/* End of file tag_model.php */
/* Location: ./application/models/tag_model.php */