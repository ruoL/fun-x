<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Person extends S {
    
    public function __construct() {
        parent::__construct();
    }

    public function index($cid=1) {

    	$person[1]->id=1;
    	$person[1]->name="王一";
    	$person[1]->title="品牌策划";
    	$person[1]->head_url="mingpian_wangyi.png";
    	$person[1]->tel="18629023024";

    	$person[2]->id=2;
    	$person[2]->name="侯文钰";
    	$person[2]->title="设计指导";
    	$person[2]->head_url="m_houwenyu.png";
    	$person[2]->tel="18629042933";

    	$person[3]->id=3;
    	$person[3]->name="侯豫新";
    	$person[3]->title="创意总监";
    	$person[3]->head_url="duwei.png";
    	$person[3]->tel="18629042933";

	$person[4]->id=4;
    	$person[4]->name="杜伟";
    	$person[4]->title="总经理";
    	$person[4]->head_url="duwei.png";
    	$person[4]->tel="15771763360";


    	$data['user']=$person[$cid];

        $this->load->view('site_person',$data);

    }      
}