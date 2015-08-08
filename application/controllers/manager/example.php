<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends A {

    private $_prepage = 20;
    public function __construct() {
        parent::__construct();
    }

    public function index($start){
        $this->load->library('pagination');
        $config['base_url']     = admin_base_url('example/index');
        $config['total_rows']   = $this->example_model->get_rows();
        $config['per_page']     = $this->_prepage;
        $config['num_links']    = 5;
        $config['uri_segment']  = 4;
        $config['suffix']       = config_item('url_suffix');
        $this->pagination->initialize($config);

        $data['pres'] = $this->_prepage;
        $data['page'] = $this->pagination->create_links();
        $data['rows'] = $config['total_rows'];
        $data['list'] = $this->example_model->get_list($start, $config['per_page']);

        $this->load->view('admin_example', $data);
    }

    public function create()
    {
        $this->load->view('admin_example_create');
    }

    public function createAction()
    {

        var_dump($_POST);exit;
        $name       = $this->input->post('name');
        $sort       = $this->input->post('sort');
        $tag        = $this->input->post('tag');
        $zhaiyao    = $this->input->post('zhaiyao');
        $jianjie    = $this->input->post('jianjie');
        $color      = $this->input->post('color');
        $fengmian   = $this->input->post('fengmian');
        $anli       = $this->input->post('anli');

        $name       = trim($name);
        $zhaiyao    = trim($zhaiyao);
        $jianjie    = trim($jianjie);
        $tag        = serialize($tag);
        $color      = serialize($color);
        $anli       = serialize($anli);

        if ( $name == '' ) {
            JSON('error', '请填写名称!');
        }
        if ( $zhaiyao == '' ) {
            JSON('error', '请填写摘要!');
        }
        if ( $jianjie == '' ) {
            JSON('error', '请填写简介!');
        }
        if ( $this->example_model->get_info(['name'=>$name]) )
        {
            JSON('error', '名称已经存在!');
        }

        $data['name']       = $name;
        $data['sort']       = $sort ? intval($sort) : 0;
        $data['tag']        = $tag;
        $data['zhaiyao']    = $zhaiyao;
        $data['jianjie']    = $jianjie;
        $data['color']      = $color;
        $data['fengmian']   = $fengmian;
        $data['anli']       = $anli;

        $this->db->insert('example', $data);
        $id = $this->db->insert_id();
        if ( $id ) {
            JSON('success', '添加成功!');
        }
        JSON('error', '添加失败!');
    }

    public function update($id)
    {
        $exam               = $this->example_model->get_info(['id'=>$id]);
        $data['example']    = $exam;
        $this->load->view('admin_example_update', $data);
    }

    public function updateAction()
    {
        $id         = $this->input->post('id');
        $name       = $this->input->post('name');
        $sort       = $this->input->post('sort');
        $tag        = $this->input->post('tag');
        $zhaiyao    = $this->input->post('zhaiyao');
        $jianjie    = $this->input->post('jianjie');
        $color      = $this->input->post('color');
        $fengmian   = $this->input->post('fengmian');
        $anli       = $this->input->post('anli');

        // $id         = intval($id);
        $name       = trim($name);
        $zhaiyao    = trim($zhaiyao);
        $jianjie    = trim($jianjie);
        $tag        = serialize($tag);
        $color      = serialize($color);
        $anli       = serialize($anli);

        if ( $name == '' ) {
            JSON('error', '请填写名称!');
        }
        if ( $zhaiyao == '' ) {
            JSON('error', '请填写摘要!');
        }
        if ( $jianjie == '' ) {
            JSON('error', '请填写简介!');
        }
        $exam = $this->example_model->get_info(['name'=>$name]);
        if (  $exam && $exam->id != $id  )
        {
            JSON('error', '名称已经存在!');
        }

        $data['name']       = $name;
        $data['sort']       = $sort ? intval($sort) : 0;
        $data['tag']        = $tag;
        $data['zhaiyao']    = $zhaiyao;
        $data['jianjie']    = $jianjie;
        $data['color']      = $color;
        $data['fengmian']   = $fengmian;
        $data['anli']       = $anli;


        $this->db->where('id', $id)->update('example', $data);
        if ( $this->db->affected_rows() ) {
            JSON('success', '修改成功!');
        }
        JSON('error', '修改失败!');
    }

    public function delete($id)
    {
        $exam = $this->example_model->get_info(['id'=>$id]);
        if ( $exam ) {
            @unlink(FCPATH.$exam->fengmian);
            foreach ( $exam->anli as $value ) {
                @unlink(FCPATH.$value);
            }
            $this->db->where('id', $id)->delete('big_example');
        }
        redirect(admin_base_url('example'));
    }

    public function deleteImage()
    {
        $path = $this->input->get('image');
        $path = FCPATH.$path;
        if ( @is_file($path) === true ) {
            @chmod($path, 0777);
            if ( true ) {//@unlink($path)
                JSON('success', '删除成功');
            }
            JSON('error', '删除失败');
        }
        JSON('error', '文件不存在');
    }
}