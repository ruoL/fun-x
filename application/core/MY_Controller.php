<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header('Content-Type:text/html; charset=utf-8');
    }

}


class A extends C {

    public function __construct() {
        parent::__construct();

        if ( ! $this->auth->islogin() ) {
           redirect( admin_site_url('sign') );
        }

        //检测是否有权限登录管理后台
        $arr = explode('|', config_item('site_admin_uid'));
        $uid = (int) $this->auth->user('uid');

        if( ! $uid OR ! in_array($uid, $arr) ) {
           redirect( admin_site_url('sign') );
        }
    }

}

class S extends C {

    public function __construct() {
        parent::__construct();
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */