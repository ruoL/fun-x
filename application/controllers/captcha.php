<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends S {

    public function __construct() {
        parent::__construct();
    }
    public function output($length = 4) {
        $rand = random((int)$length);
        $data = array('captcha'=>md5(strtolower($rand)));
        $this->session->set_userdata($data);
        return build_verify($rand);
    }

    public function upbest(){
    	//$_POST["aid"]=90;
    	$aid=$_POST["aid"];
    	$this->db->set('best', 'best+1', false)->where( array('aid'=>$aid) )->update('article');
    	$data["echo"]=1;
    	echo json_encode($data);
    }

}

/* End of file captcha.php */
/* Location: ./application/controllers/captcha.php */