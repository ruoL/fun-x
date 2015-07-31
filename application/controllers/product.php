<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends S {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $row = $this->example_model->get_rows();
        $page = ceil($row / 20);
        $list = $this->example_model->get_list();

        $data['row']    = $row;
        $data['page']   = $page;
        $data['list']   = $list;
        if( $this->agent->is_mobile() ) {
            $this->load->view('site_mproduct');
        } else {
            $this->load->view('site_examples', $data);
        }
    }

    public function one()
    {
        $id = $this->input->post('id');
        $exam = $this->example_model->get_info(['id'=>$id]);
        JSON('success', '', $exam);
    }

}