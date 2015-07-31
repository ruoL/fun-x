<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class User extends A {    private $_curruid;    private $_prepage = 10;    public function __construct() {        parent::__construct();        $this->_curruid = (int) $this->auth->user('uid');    }        public function index($start = 0) {        $this->load->library('pagination');        $config['base_url']     = admin_base_url('user/index');        $config['total_rows']   = $this->user_model->get_rows();        $config['per_page']     = $this->_prepage;        $config['num_links']    = 5;        $config['uri_segment']	= 4;        $config['suffix']       = config_item('url_suffix');        $this->pagination->initialize($config);                 $data['pres'] = $this->_prepage;        $data['page'] = $this->pagination->create_links();        $data['rows'] = $config['total_rows'];        $data['list'] = $this->user_model->get_list($start, $config['per_page']);        $this->load->view('admin_user', $data);    }        public function create() {        $this->load->view('admin_user_create');    }        public function update($uid) {                $uid = (int) $uid;                $data['user'] = $this->user_model->get_info(array('uid'=>$uid));                if( ! $data['user'] ) {            show_404();        }        if( ($uid !== $this->_curruid) AND ($this->_curruid !== 1) ) {            show_error('你没有权限修改其它用户信息！');        }                $this->load->view('admin_user_update', $data);    }        public function delete($uid) {        $user = $this->user_model->get_info(array('uid'=>(int)$uid));                if( ! $user ) {            show_404();        }                if( $this->_curruid !== 1 ) {            show_error('你没有权限删除此用户！');        }                if( $user->uid == 1 ) {            show_error('创始用户无法删除！');        }                // 查找系统用户列表        $admin_uid = explode('|', config_item('site_admin_uid'));        $admin_uid = array_unique( array_filter($admin_uid) );        $data['move'] = $this->db->where_in('uid', $admin_uid)->get('user')->result();        $data['post'] = $this->article_model->get_rows(array('uid'=>$user->uid));        $data['page'] = $this->page_model->get_rows(array('uid'=>$user->uid));        $data['user'] = $user;        $this->load->view('admin_user_delete', $data);    }    public function create_action() {        if( ! $this->input->is_ajax_request() ) {            show_404();        }                $e = $this->input->post('email', true);        $u = $this->input->post('username', true);        $p = $this->input->post('password', true);        $r = $this->input->post('repassword', true);                $u = trim($u);        $e = strtolower(trim($e));        $p = strtolower(trim($p));        $r = strtolower(trim($r));                if( ! is_email($e) ) {            JSON('error', '对不起，请填写用个可以的电子邮件！');        }                if( $this->user_model->get_info(array('email'=>$e)) ) {            JSON('error', '该电子邮件已在存，请换一个！');        }                if( ! is_username($u) ) {            JSON('error', '用户姓名可以由汉字、字母或数字组成，长度不保持 4-16 个字符！');        }                if( $this->user_model->get_info(array('username'=>$u)) ) {            JSON('error', '该用户名称已存在，请换一个！');        }                if( ! is_password($p) ) {            JSON('error', '密码必须由字母、数字和下划线组成，长度保持 6-16 个字符！');        }                if($p !== $r) {            JSON('error', '两次输入的密码不一致，请重新确认密码！');        }                $this->load->library('phpass');        $data['password']   = $this->phpass->HashPassword($p);        $data['regtime']    = $data['lastlogin']    = $data['activity'] = time();        $data['regip']      = $data['lastip']       = $this->input->ip_address();                $data['email']      = $e;        $data['username']   = $u;        $data['intro']      = $this->input->post('intro', true);        $data['token']      = random(6);                $this->db->insert('user', $data);                unset($data);                if ( $uid = $this->db->insert_id() ) {            JSON('success', '恭喜，用户 ' . $u . ' 已创建成功！');        } else {            JSON('error', '创建用户失败，请重试！');        }    }        public function update_action() {        if( ! $this->input->is_ajax_request() ) {            show_404();        }                $uid = (int) $this->input->post('uid');        $e = $this->input->post('email', true);        $u = $this->input->post('username', true);        $u = trim($u);        $e = strtolower(trim($e));                if( ! is_email($e) ) {            JSON('error', '对不起，请填写用个可以的电子邮件！');        }                if( $this->user_model->get_info(array('uid !='=>$uid, 'email'=>$e)) ) {            JSON('error', '该电子邮件已在存，请换一个！');        }                if( ! is_username($u) ) {            JSON('error', '用户姓名可以由汉字、字母或数字组成，长度不保持 4-16 个字符！');        }                if( $this->user_model->get_info(array('uid !='=>$uid, 'username'=>$u)) ) {            JSON('error', '该用户名称已存在，请换一个！');        }                $p = $this->input->post('password', true);        $r = $this->input->post('repassword', true);                $p = strtolower(trim($p));        $r = strtolower(trim($r));                if( $p !== '' ) {            if( ! is_password($p) ) {                JSON('error', '密码必须由字母、数字和下划线组成，长度保持 6-16 个字符！');            }                        if($p !== $r) {                JSON('error', '两次输入的密码不一致，请重新确认密码！');            }                        $this->load->library('phpass');            $data['password']   = $this->phpass->HashPassword($p);        }        $data['email']      = $e;        $data['username']   = $u;        $data['intro']      = $this->input->post('intro', true);        $data['state']      = (int) $this->input->post('state');        $this->db->update('user', $data, array('uid'=>$uid));                unset($data);                if ( $this->db->affected_rows() ) {            JSON('success', '恭喜，用户 ' . $u . ' 更新成功！');        } else {            JSON('error', '对不起，用户没有更新或更新失败！');        }    }        public function delete_action() {        if( ! $this->input->is_ajax_request() ) {            show_404();        }                $uid = (int) $this->input->post('uid');        $new = (int) $this->input->post('newuid');        $user = $this->user_model->get_info(array('uid'=>$uid));                if( ! $user OR ($new === 0) ) {            JSON('error', '对不起，没有找到您要删除的用户！');        }                $this->db->delete('user', array('uid'=>$uid));                if ( $this->db->affected_rows() ) {                    // 转交该用户的文章和页面            $this->db->update('article', array('uid'=>$new), array('uid'=>$uid));            $this->db->update('page', array('uid'=>$new), array('uid'=>$uid));                    JSON('success', '恭喜，用户 ' . $user->username . ' 删除成功！');        } else {            JSON('error', '对不起，删除用户失败，请重试！');        }    }}/* End of file user.php *//* Location: ./application/controllers/user.php */