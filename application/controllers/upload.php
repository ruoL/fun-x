<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends C {

    /**
     * 附件保存目录
     *
     * @access private
     * @return string
     */
    private $_attach_dir;
    
    /**
     * 是否添加水印
     *
     * @access private
     * @return string
     */
    private $_watermark = false;
    
    /**
     * 是否临时目录
     *
     * @access private
     * @return string
     */
    private $_temp = false;

    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();

        $this->_attach_dir = config_item('site_attach_dir') . DIRECTORY_SEPARATOR;

        if ( @is_dir($this->_attach_dir) === false ) {
            create_dir($this->_attach_dir);
        }
        
        $watermark = $this->input->post('watermark', true);
        if($watermark !== false) {
            $this->_watermark = false;
        }
        
        $temp = $this->input->post('temp', true);
        if($temp !== false) {
            $this->_temp = true;
        }
    }

    /**
     * 上传图片文件
     *
     * @access public
     * @return json
     */
    public function image() {

        if ( isset($_FILES['attach']) AND is_uploaded_file($_FILES['attach']['tmp_name']) AND ($_FILES['attach']['error'] === 0) ) {

            $imgsize = $_FILES['attach']['size'];
            
            $maxsize = config_item('site_image_maxsize');
            if ( $imgsize > ($maxsize * 1024 * 1024) ) {
                JSON('error', '上传图片大小超过 ' . $maxsize . 'MB');
            }
            
            $imginfo = pathinfo($_FILES['attach']['name']);
            
            $imgexte = config_item('site_image_ext');
            $imgexte = explode('|', $imgexte);
            if ( ! in_array(strtolower($imginfo['extension']), $imgexte) ) {
                JSON('error', '上传图片只允许 ' . implode(', ', $imgexte) . ' 格式');
            }
            
            if( $this->_temp === true ) {
                $savepath = $this->_attach_dir . 'temp' . DIRECTORY_SEPARATOR;
            } else {
                $savepath = $this->_attach_dir . 'image' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR;
            }
            
            if( @is_dir($savepath) === false ) {
                create_dir($savepath);
            }
            
            $filename = date('dis') . rand(1000, 9999) . '.' . strtolower($imginfo['extension']);
            $fullname = $savepath . $filename;

            move_upload_file($_FILES['attach']['tmp_name'], $fullname);
            
            if( @is_file($fullname) === false ) {
                JSON('error', '上传失败，找不到此文件');
            }
            
            $this->_resizeimage($fullname);

            if( $this->_watermark === true ) {
                $this->_watermarkimage($fullname);
            }

            list($width, $height, $type, $attr) = getimagesize($fullname);
            $fullpath = $fullname;
            $fullname = base_url($fullname);
            
            $data = array('filename'=>$filename, 'fullpath'=>$fullpath,'filepath'=>$fullname, 'width'=>$width, 'height'=>$height);
            
            JSON('success', '文件上传成功', $data);
        } else {
            JSON('error', '上传出现错误');
        }
    }

    /**
     * 将图像调整尺寸
     *
     * @access private
     * @return void
     */
    private function _resizeimage($sourceimage, $maintain = true) {
    
        if ( @is_file($sourceimage) === false ) return false;
        
        $maxwidth = $maxheight = config_item('site_image_maxwidth');
        
        list($width, $height, $type, $attr) = getimagesize($sourceimage);
        
        if($width > $maxwidth OR $height > $maxheight) {
            $w = $width / $maxwidth;
            $h = $height / $maxheight;
            if($w > $h) {
                $setwidth = $width;
                $setheight = $height / $w;
            } else {
                $setheight = $height;
                $setwidth = $width / $h;
            }
            
            $this->load->library('image_lib');
            $config['source_image']     = $sourceimage;
            $config['maintain_ratio']   = (boolean) $maintain;
            $config['height']           = $setheight;
            $config['width']            = $setwidth;
            $this->image_lib->initialize($config);
            
            if( ! $this->image_lib->resize() ) {
                return false;
            }
            
            $this->image_lib->clear();
            return true;
        }
        
        return true;
    }
    
    /**
     * 为图像添加水印
     *
     * @access private
     * @return void
     */
    private function _watermarkimage($sourceimage, $vrt = 'bottom', $hor = 'right') {

        if ( @is_file($sourceimage) === false ) return false;

        $watermark = FCPATH . config_item('site_static_dir') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'watermark.png';

        $this->load->library('image_lib');
        $config['wm_type']          = 'overlay';
        $config['source_image']     = $sourceimage;
        $config['wm_overlay_path']  = $watermark; 
        $config['wm_vrt_alignment'] = $vrt;
        $config['wm_hor_alignment'] = $hor;
        $this->image_lib->initialize($config);

        if( ! $this->image_lib->watermark() ) {
            return false;
        }

        $this->image_lib->clear();
        return true;
    }

    public function exampleimage() {

        if ( isset($_FILES['attach']) AND is_uploaded_file($_FILES['attach']['tmp_name']) AND ($_FILES['attach']['error'] === 0) ) {

            $imgsize = $_FILES['attach']['size'];
            $maxsize = config_item('site_image_maxsize');
            if ( $imgsize > ($maxsize * 1024 * 1024) ) {
                JSON('error', '上传图片大小超过 ' . $maxsize . 'MB');
            }
            $imginfo = pathinfo($_FILES['attach']['name']);
            $imgexte = config_item('site_image_ext');
            $imgexte = explode('|', $imgexte);
            if ( ! in_array(strtolower($imginfo['extension']), $imgexte) ) {
                JSON('error', '上传图片只允许 ' . implode(', ', $imgexte) . ' 格式');
            }
            $savepath = $this->_attach_dir . 'example' . DIRECTORY_SEPARATOR;
            if( @is_dir($savepath) === false ) {
                create_dir($savepath);
            }

            $filename = date('dis') . rand(1000, 9999) . '.' . strtolower($imginfo['extension']);
            $fullname = $savepath . $filename;

            move_upload_file($_FILES['attach']['tmp_name'], $fullname);

            if( @is_file($fullname) === false ) {
                JSON('error', '上传失败，找不到此文件');
            }


            list($width, $height, $type, $attr) = getimagesize($fullname);
            $fullpath = $fullname;
            $fullname = base_url($fullname);

            $data = array('filename'=>$filename, 'fullpath'=>$fullpath,'filepath'=>$fullname, 'width'=>$width, 'height'=>$height);

            JSON('success', '文件上传成功', $data);
        } else {
            JSON('error', '上传出现错误');
        }
    }
}

/* End of file upload.php */
/* Location: ./application/controllers/upload.php */