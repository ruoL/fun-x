<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_info($where) {
        if ( $where ) $this->db->where($where);
        $res = $this->db->get('example')->row();
        if ($res) {
            $res->tag   = unserialize($res->tag);
            $res->color = unserialize($res->color);
            $res->anli  = unserialize($res->anli);
        }
        return $res;
    }

    public function get_rows($where = array()) {
        if($where) $this->db->where($where);
        return $this->db->get('example')->num_rows();
    }

    public function get_list($start = 0, $offset = 0, $where = null, $order = 'id asc') {
        if($where) $this->db->where($where);
        if($start || $offset) $this->db->limit($offset, $start);
        $this->db->order_by($order);
        $res = $this->db->get('example')->result();
        if ( $res ) {
            foreach ( $res as $value ) {
                $value->tag   = unserialize($value->tag);
                $value->color = unserialize($value->color);
                $value->anli  = unserialize($value->anli);
            }
        }
        return $res;
    }


}