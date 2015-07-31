<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Search extends S {

    /**
     * 当前页码
     *
     * @access private
     * @var integer
     */
    private $_page;

    /**
     * 搜索关键字
     *
     * @access private
     * @var string
     */
    private $_keys;
    
    /**
     * 显示数量
     *
     * @access private
     * @var integer
     */
    private $_prepage = 10;
    
    /**
     * 构造函数
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        
        $p = (int) $this->input->get('p');
        $k = (string) $this->input->get('k', true);

        $this->_page = ($p === 0) ? 1 : $p;
        $this->_keys = $this->_safereplace( substring(trim($k), 32, false) );

        if( empty($this->_keys) ) {
            show_404();
        }
    }
    
    /**
     * 显示搜索结果
     * 
     * @access public
     * @return void
     */
    public function index() {
        
        $start = (($this->_page - 1 ) * $this->_prepage);

        $rows = $this->db->query('SELECT * FROM ' . prefix('article') . ' WHERE `title` LIKE "%' . $this->_keys . '%" OR `description` LIKE "%' . $this->_keys . '%"');
        $list = $this->db->query('SELECT * FROM ' . prefix('article') . ' WHERE `title` LIKE "%' . $this->_keys . '%" OR `description` LIKE "%' . $this->_keys . '%" LIMIT ' . $start . ', ' . $this->_prepage . '');

        $data['rows'] = $rows->num_rows();
        $data['pres'] = $this->_prepage;
        $data['list'] = $list->result();
        $data['page'] = $this->_setpagestring($data['rows']);
        $data['keys'] = $this->_keys;

        if( $data['rows'] ) {
            $this->load->model('search_model');
            $this->search_model->insert_keyword($this->_keys);
        }
        
        $this->load->view('site_search', $data);
    }

    /**
     * 计算分页字符器
     * 
     * @access public
     * @params int $start 起始
     * @params int $offset 条数
     * @params array $where 条件
     * @return int
     */
    public function _setpagestring($rows = 0) {
        $num_link = 5;  // 当前页两侧留几个页码
        $cur_page = $this->_page;
        $num_page = ($rows > $this->_prepage) ? ceil($rows / $this->_prepage) : 1;

        $max = (($cur_page + $num_link) < $num_page) ? $cur_page + $num_link : $num_page;
        $min = (($cur_page - $num_link) > 0) ? $cur_page - ($num_link - 1) : 1;

        $output = '';
        for($i = $min; $i <= $max; $i ++) {
            if ( $i == $cur_page ) {
                $output .= '<strong>' . $i . '</strong>';
            } else {
                $output .= '<a href="' . base_url('search/?k=' . $this->_keys . '&p=' . $i) . '">' . $i . '</a>';
            }
        }
        
        $prev = (($cur_page - 2) > 0) ? ($cur_page - 2) : 0;
        $next = ($cur_page < $num_page) ? $cur_page : ($num_page - 1);
        
        $p = ($cur_page != 1) ? '<a href="' . base_url('search/?k=' . $this->_keys . '&p=' . ($cur_page - 1)) . '"><</a>' : '';
        $n = ($cur_page != $num_page) ? '<a href="' . base_url('search/?k=' . $this->_keys . '&p=' . ($cur_page + 1)) . '">></a>' : '';

        $pagestr = ($num_page > 1) ? $p . $output . $n : '';
        
        return '<p class="fl">共有 ' . $rows . ' 条结果 / 每页显示 ' . $this->_prepage . ' 条 / 共分为 ' . $num_page . ' 页</p><p class="fr">' . $pagestr . '</p>';
    }
    
    /**
     * 过滤搜索中的危险字符
     * 
     * @access public
     * @params string $string 关键字
     * @return string
     */
    public function _safereplace($string) {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('%2527', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('<', '&lt;', $string);
        $string = str_replace('>', '&gt;', $string);
        $string = str_replace("{", '', $string);
        $string = str_replace('}', '', $string);
        return $string;
    }

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */