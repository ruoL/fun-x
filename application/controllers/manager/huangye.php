<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Huangye extends A {
    
    private $_attach_dir;
    private $_curruid;
    private $_prepage = 10;
    public function __construct() {
        parent::__construct();
        
        $this->_curruid     = (int) $this->auth->user('uid');
        $this->_attach_dir  = config_item('site_attach_dir') . DIRECTORY_SEPARATOR;
        if ( @is_dir($this->_attach_dir) === FALSE ) {
            create_dir($this->_attach_dir);
        }
    }
    
    public function index($start = 0) {
        $type = 'all';
        $this->load->library('pagination');
        $config['base_url']     = admin_base_url('huangye/all');
        $this->db->select('*');
        $this->db->from('huangye');
        $config['total_rows']   = $this->db->get()->num_rows();
        $config['per_page']     = $this->_prepage;
        $config['num_links']    = 5;
        $config['uri_segment']  = 4;
        $config['suffix']       = config_item('url_suffix');
        $this->pagination->initialize($config); 
        $data['pres'] = $this->_prepage;
        $data['page'] = $this->pagination->create_links();
        $data['rows'] = $config['total_rows'];
        $data['list'] = $this->huangye_model->get_list($start, $config['per_page']);
        $this->load->view('admin_huangye', $data);
    }
    
    public function create() {
        $data['category'] = $this->category_model->get_list(0, 100);
        $this->load->view('admin_huangye_create', $data);
    }
    
    public function update($aid = 0) {
        $data['huangye'] = $this->huangye_model->get_info(array('aid'=>$aid));
        if( ! $data['huangye'] ) {
            show_404();
        }
        
        $data['category'] = $this->category_model->get_list(0, 100);
        $this->load->view('admin_huangye_update', $data);
    }
    public function crop_image() {
        $this->load->view('admin_huangye_image');
    }
    
    public function crop_image_action() {
        $x  = (int) $this->input->get('x');
        $y  = (int) $this->input->get('y');
        $w  = (int) $this->input->get('w');
        $h  = (int) $this->input->get('h');
        
        if( $w < 100 OR $h < 100 ) {
            JSON('error', '请选择一个合适的图像区域！');
        }
        
        $hid = (int) $this->input->get('hid');
        
        $imagepath = $this->input->get('path', true);
        $imagepath = FCPATH . str_replace(base_url(), '', $imagepath);
        
        if( empty($imagepath) OR (@is_file($imagepath) === false) ) {
            JSON('error', '找不到需要裁切的图片！');
        }
        
        $imageinfo = pathinfo($imagepath);
        switch( $imageinfo['extension'] ) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($imagepath);
                break;
            case 'png':
                $image = imagecreatefrompng($imagepath);
                break;
            case 'gif':
                $image = imagecreatefromgif($imagepath);
                break;
            default:
                JSON('error', '您上传的文件格式不正确！');
        }
        $copy = $this->_image_crop($image, $x, $y, $w, $h);
        
        if( $copy === false ) JSON('error', '未知错误，请重试！');
        
        $temppath = FCPATH . $this->_attach_dir . 'huangye' . DIRECTORY_SEPARATOR . build_dir($hid);
        
        if( @is_dir($temppath) === false ) {
            create_dir($temppath);
        }
        
        if ( @is_writable($temppath) === false ) {
            @chmod($temppath, 0777);
        }
        $savepath = $temppath . $hid . '.png';
        
        imagepng($copy, $savepath);
        
        imagedestroy($copy);
        $this->load->library('image_lib');
        
        list($width, $height, $type, $attr) = getimagesize($savepath);
        
        $array = array( array('w'=>100, 'h'=>100), array('w'=>50, 'h'=>50) );
        foreach($array AS $size) {
            
            if($width > $size['w'] OR $height > $size['h']) {
                $setwidth = $size['w'];
                $setheight = $size['h'];
            } else {
                $setwidth = $width;
                $setheight = $height;
            }
        
            $config['source_image'] = $savepath;
            $config['new_image']    = $hid . '_h' . $size['w'] . '.png';
            $config['height']       = $setheight;
            $config['width']        = $setwidth;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        $show_img='http://weinan.fun-x.cn/attach/huangye/00/01/'.$hid . '_h100.png';
        $data_img = array(
               'img_url' => $show_img
            );

        $this->db->where('hid', $hid);
        $this->db->update('huangye', $data_img);
        unlink($imagepath);
        unlink($savepath);
        JSON('success', '头图已保存成功！',$show_img);
    }
    
    public function create_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        $from           = $this->input->post('fromurl', true);
        $title          = $this->input->post('title', true);
        $content        = $this->input->post('content');
        $content        = strip_tags($content, '<p><a><strong><img><em><span><ul><ol><li><br>');
        
        $data['hid']=NULL; 
        $data['title']          = trim($title);
        $data['content']        = htmlspecialchars($content);
        $data['from']           = is_url($from) ? $from : '';
        $data['created']        = $data['updated'] = time();
        $data['views']          = 0;
        $data['image']          = str_exists($content, '<img src=') ? 1 : 0;
        $data['index']          = $from;
        $data['state']          = 1;
        $data['best']          = 0;  
        $data['img_url']        = '';
        
        $action = $this->input->post('action', true);
        
        switch ($action) {
            case 'update':
                $success    = '恭喜，文章已更新成功！';
                $error      = '对不起，文章更新失败，请重试！';
                break;
            case 'draft':
                $data['state'] = 0;
                $success    = '草稿已存于 ' . date('Y年m月d H:i');
                $error      = '草稿保存失败，请重试！';
                break;
            default:
                $success    = '恭喜，文章已发布成功！';
                $error      = '对不起，文章发布失败，请重试！';
        };
        $draft_id = (int) $this->input->post('draftid');
        
        $state_id = $this->_create_huangye($draft_id, $data);
        
        if( $state_id ) {
            JSON('success', $success, $state_id);
        } else {
            JSON('error', $error, $state_id);
        }
    }
    
    public function delete_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $aid = (int) $this->input->get('hid');
        
        $row = $this->_delete_huangye($aid);
        
        $row ? JSON('success', '恭喜，文章删除成功！') : JSON('error', '对不起，删除文章失败，请重试！');
    }
    
    public function delete_multi_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $aid = $this->input->get('aid');
        $act = $this->input->get('act', true);
        switch ($act) {
            case 'trash':
                $row = 0;
                foreach($aid AS $v) {
                    $this->db->update('huangye', array('state'=>2), array('aid'=>(int) $v));
                    if( $this->db->affected_rows() ) {
                        $row ++;
                    }
                }
                JSON('success', '已成功将 ' . $row . ' 篇文章放收回收站！');
                break;
            case 'normal':
                $row = 0;
                foreach($aid AS $v) {
                    $this->db->update('huangye', array('state'=>1), array('aid'=>(int) $v));
                    if( $this->db->affected_rows() ) {
                        $row ++;
                    }
                }
                JSON('success', '已成功恢复 ' . $row . ' 篇文章！');
                break;
            case 'delete':
                $row = 0;
                foreach($aid AS $v) {
                    if( $this->_delete_huangye($v) ) {
                        $row ++;
                    }
                }
                JSON('success', '已成功删除 ' . $row . ' 篇文章！');
                break;
            default:
                JSON('error', '未确认的操作！');
        };
    }
    
    public function delete_img_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $image = $this->input->get('image', true);
        
        $image = FCPATH . str_replace(base_url(), '', $image);
        
        $state = 'success';
        if( @is_file($image) === true ) {
            @chmod($image, 0777);
            if( ! @unlink($image) ) {
                $state = 'error';
            }
        }
        JSON($state);
    }
    
    public function delete_tag_action() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $aid = (int) $this->input->get('aid');
        $tid = (int) $this->input->get('tid');
        
        if( ($aid === 0) OR ($tid === 0)) {
            JSON('error', '数据不正确，无法删除');
        }
        
        if ( $this->tag_model->delete_by_aid($aid, $tid) ) {
            JSON('success', '标签已成功删除');
        } else {
            JSON('error', '删除失败，请重试');
        }
    }
    
    public function select_tag_relation() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $tag = $this->input->get('tag', true);
        $tag = trim($tag);
        
        
        if( $tag === '' ) {
            JSON('error');
        }
        $data = $this->db->like('name', $tag, 'after')->order_by('total DESC')->limit(20)->get('tag')->result();
        
        if( ! $data ) {
            JSON('error');
        }
        
        JSON('success', '', $data);
    }
    
    public function remove_to_trash() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $aid = (int) $this->input->get('aid');
        
        $this->db->update('huangye', array('state'=>2), array('aid'=>$aid));
        
        if( $this->db->affected_rows() ) {
            JSON('success', '文章已成功移至回收站！');
        } else {
            JSON('error', '操作失败，请重试！');
        }
    }
    
    public function return_to_normal() {
        if( ! $this->input->is_ajax_request() ) {
            show_404();
        }
        
        $aid = (int) $this->input->get('aid');
        
        $this->db->update('huangye', array('state'=>1), array('aid'=>$aid));
        
        if( $this->db->affected_rows() ) {
            JSON('success', '文章已恢复正常！');
        } else {
            JSON('error', '操作失败，请重试！');
        }
    }
    
    public function _create_huangye($draft_id, $data) {
        // create
        if( $draft_id === 0 ) {
            $this->db->insert('huangye', $data);
            unset($data);
            return $this->db->insert_id();
        }
        // update
        else {
            unset($data['created']);
            $this->db->update('huangye', $data, array('aid'=>$draft_id));
            unset($data);
            return $this->db->affected_rows();
        }
    }
    
    public function _delete_huangye($aid) {
    
        $aid = (int) $aid;
        
        $huangye = $this->huangye_model->get_info(array('hid'=>$aid));
        
        if( ! $huangye ) {
            return false;
        }
    
        $this->db->delete('huangye', array('hid'=>$aid));
        $state = $this->db->affected_rows();

        return $state ? true : false;
    }
    
    /**
     * Plug-in 15: Image Crop
     * This plug-in takes a GD image and returns a cropped
     * version of it. If any arguments are out of the
     * image bounds then FALSE is returned. The arguments
     * required are:
     *
     * $image:   The image source
     * $x & $y:  The top-left corner
     * $w & $h : The width and height
     *
     */
    public function _image_crop($image, $x, $y, $w, $h) {
    
        $tw = imagesx($image);
        $th = imagesy($image);
        if ($x > $tw || $y > $th || $w > $tw || $h > $th) {
            return FALSE;
        }
        $temp = imagecreatetruecolor($w, $h);
        imagecopyresampled($temp, $image, 0, 0, $x, $y, $w, $h, $w, $h);
        return $temp;
    }
 
}
/* End of file huangye.php */
/* Location: ./application/controllers/huangye.php */