<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
    
    /**
     * 当前用户 current user
     *
     * @access private
     * @var object
     */
    private $cu;
    
    /**
     * CI 句柄 codeigniter
     *
     * @access private
     * @var object
     */
    private $ci;
    
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->ci = & get_instance();
        $this->cu = unserialize( $this->ci->session->userdata('sessuser') );
    }
    
    /**
     * 获取 session 数据
     *
     * @access public
     * @return string
     */
    public function user($key = '') {
        
        if( ! $this->islogin() ) {
            return false;
        }
        
        if( empty($key) ) {
            return $this->cu;
        } else {
            return isset( $this->cu->$key ) ? $this->cu->$key : false;
        }
    }
    
    /**
     * 判断是否登录
     *
     * @access public
     * @return boolean
     */
    public function islogin() {

        if( ! empty($this->cu) && null !== $this->cu->uid) {
            $token = $this->ci->db->where( array('uid'=>$this->cu->uid) )->get('user')->row('token');
            return ( $token && $token == $this->cu->token ) ? true : false;
        }
        
        return false;
    }
    
    /**
     * 检测用户登录
     *
     * @access public
     * @params string $email 电子邮件
     * @params string $password 用户密码
     * @return void
     */
    public function checkuserlogin($email, $password) {

        $user = $this->ci->db->where( array('email'=>$email) )->get('user')->row();
    
        if( ! $user ) return false;
        
        $this->ci->load->library('phpass');
        $pass = $this->ci->phpass->CheckPassword($password, $user->password);
    
        return $pass ? $user : false;
    }

    /**
     * 处理用户登录
     *
     * @access public
     * @params object $user 用户信息
     * @return void
     */
    public function process_login($user) {
        
        $data = new stdClass();
        $data->lastlogin = time();
        $data->activity  = time();
        $data->lastip    = $this->ci->input->ip_address();
        $data->token     = random(10);
        
        /** 去除密码 */
        unset($user->password);
        
        /** 更新token */
        $user->token    = $data->token;
        
        /** 写入session */
        $this->set_session($user);

        $this->ci->db->update('user', $data, array('uid'=>$user->uid));
    }
    
    /**
     * 处理用户登出
     * 
     * @access public
     * @return void
     */
    public function process_logout() {
        $this->ci->session->sess_destroy();
    }
    
    /**
     * 设置 session 数据
     *
     * @access private
     * @return void
     */
    private function set_session($data) {
        $session_data = array( 'sessuser'=>serialize($data) );
        $this->ci->session->set_userdata($session_data);
    }

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */