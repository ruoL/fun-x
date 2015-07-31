<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action {

    private $codeigniter;

    public function __construct() {
        $this->codeigniter = & get_instance();
    }
    
    /**
     * 从硬盘删除文章头图
     * 
     * @access public
     * @params int $aid 文章ID
     * @return NULL
     */
    public function unlink_article_image($aid) {
        $aid  = (int) $aid;
        $size = array(160, 48);
        $path = config_item('site_attach_dir') . DIRECTORY_SEPARATOR . 'article' . DIRECTORY_SEPARATOR;
        
        foreach($size AS $v) {
            $image = FCPATH . $path . build_dir($aid) . $aid . '_' . $v . '.png';
            if( @is_file($image) === true ) {
                @chmod($image, 0777);
                @unlink($image);
            }
        }
    }

    /**
     * 从硬盘删除字符串中的图片
     * 
     * 该方法找将从字符串中匹配出所有的图片并从硬盘删除
     * 
     * @access public
     * @params string $string 文章内容
     * @return NULL
     */
    public function unlink_string_attach($string) {
        $string = htmlspecialchars_decode($string);
        $matchs = "/<img src=\"(.*)\"/isU";
        preg_match_all($matchs, $string, $return);
        if( $return AND $return[1] ) {
            $attach = $return[1];
            foreach($attach AS $k=>$v) {
                $path = FCPATH . str_replace(base_url(), '', trim($v));
                if( @is_file($path) === true ) {
                    @chmod($path, 0777);
                    @unlink($path);
                }
            }
        }
    }

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */