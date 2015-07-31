<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends C {

    public function __construct() {
        parent::__construct();
        exit;
    }

    public function article() {
        $post = $this->db->where(array('post_status'=>'publish', 'post_type'=>'post'))->order_by('ID ASC')->get('test111')->result();

        foreach($post AS $k=>$v) {
            $data = array();
            
            switch($v->post_author) {
                case 1:
                case 2:
                    $data['uid'] = 2;
                    break;
                case 3:
                    $data['uid'] = 4;
                    break;
                case 4:
                    $data['uid'] = 3;
                    break;
            }

            $content = str_replace(PHP_EOL, '</p><p>', $v->post_content);
            $content = '<p>' . $content . '</p>';
            $content = strip_tags($content, '<p><a><strong><em><span><ul><ol><li><br>');
            $content = htmlspecialchars($content);
            
            $data['cid']            = 1;
            $data['title']          = $v->post_title;
            $data['content']        = $content;
            $data['keyword']        = '';
            $data['description']    = '';
            $data['from']           = '';
            $data['created']        = strtotime($v->post_date);
            $data['updated']        = strtotime($v->post_modified);
            $data['views']          = 0;
            $data['comments']       = 0;
            $data['image']          = str_exists($content, '<img src=') ? 1 : 0;
            $data['index']          = 1;
            $data['state']          = 1;
            
            $this->db->insert('article', $data);
            
            unset($data);
        }

    }

}

/* End of file import.php */
/* Location: ./application/controllers/import.php */