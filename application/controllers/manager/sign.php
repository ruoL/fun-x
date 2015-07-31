<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign extends C {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('admin_sign');
    }

    public function out() {
        $this->auth->process_logout();
        redirect(site_url());
    }

    public function sign_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $e = $this->input->post('name', true);
        $c = $this->input->post('captcha', true);
        $p = $this->input->post('password', true);
        
        $e = strtolower( trim($e) );
        $p = strtolower( trim($p) );
        $c = strtolower( trim($c) );

        $sess = $this->session->userdata('captcha');
        
        if( md5($c) != $sess ) {
            JSON('error', '验证码输入有误!');
        }

        /** 登录用户登录状态 */
        $user = $this->auth->checkuserlogin($e, $p);
        
        if( false === $user ) {
            JSON('error', '用户名或密码错误!');
        }
        
        $arr = explode('|', config_item('site_admin_uid'));

        if( ! $user->uid OR ! in_array($user->uid, $arr) ) {
            JSON('error', '你的账号状态不正常!');
        }
        
        /** 处理用户登录 */
        $this->auth->process_login($user);
        
        JSON('success', '登录成功!', admin_site_url());
    }

}

/* End of file sign.php */
/* Location: ./application/controllers/admin/sign.php */