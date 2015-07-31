<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function JSON($code = 'success', $info = '', $data = '') {
    $code = in_array($code, array('success', 'error')) ? $code : 'success';
    exit(json_encode(array('code'=>$code, 'info'=>$info, 'data'=>$data)));
}

function is_url($url) {
	return preg_match("/^(http\:\/\/|ftp\:\/\/|https\:\/\/|\/)/i", $url);
}

function is_email($email) {
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function is_username($username) {
    // return preg_match("/^[a-zA-Z0-9_]{4,16}$/", $username);
    $guestexp = '\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
    $len = strlen($username);
    if($len > 16 || $len < 4 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$guestexp/is", $username)) {
        return false;
    } else {
        return true;
    }
}

function is_password($password) {
    return preg_match("/^[a-zA-Z0-9_.]{6,16}$/", $password);
}

function str_exists($haystack, $needle) {
    return ! (strpos($haystack, $needle) === false);
}

function format_keyword($keyword) {
    $temp = str_replace( array('，', '。', ';', ' ', ',', '.'), ',', $keyword);
    $temp = explode(',', $temp);
    $data = array();
    foreach($temp AS $val) {
        $data[] = trim($val);
    }
    $back = array_unique( array_filter($data) );
    unset($data);
    return implode(', ', $back);
}

function format_content($string) {
    $array = array(
        '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
        '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
        'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
        'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
        'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
        'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
        'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
        'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
        'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
        'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
        'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
        'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
        'ｙ' => 'y', 'ｚ' => 'z', '％' => '%', ',' => '，', ';' => '；',
        '!' => '！', '?' => '？', '　' => ' '
    );

    return strtr(trim($string), $array);
}

function random($length, $chars = '2345689abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

function get_article_image($aid, $size = 160) {
    $size   = in_array($size, array(160, 48)) ? $size : 160;
    $path   = config_item('site_attach_dir') . DIRECTORY_SEPARATOR . 'article' . DIRECTORY_SEPARATOR;
    $icon   = build_dir($aid) . $aid . '_' . $size . '.png';

    if( @is_file(FCPATH . $path . $icon ) === true ) {
        return base_url($path . $icon);
    } else {
        return base_url($path . build_dir(0) . '0_' . $size . '.png');
    }
}

function get_avatar($uid, $size = 48) {
    $size   = in_array($size, array('160', '100', '48')) ? $size : '48';
    $path   = config_item('site_attach_dir') . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR;
    $avatar = build_dir($uid) . $uid . '_' . $size . '.png';

    if( @is_file(FCPATH . $path . $avatar ) === true ) {
        return base_url( $path . $avatar );
    } else {
        return base_url( $path . build_dir(0) . '0_' . $size . '.png' );
    }
}

function substring($string, $length, $append = true) {
    if(strlen($string) <= $length) return $string;

    $pre = chr(1);
    $end = chr(1);
    $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), $string);

    $n = $tn = $noc = 0;
    while($n < strlen($string)) {
        $t = ord($string[$n]);
        if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1; $n++; $noc++;
        } elseif(194 <= $t && $t <= 223) {
            $tn = 2; $n += 2; $noc += 2;
        } elseif(224 <= $t && $t <= 239) {
            $tn = 3; $n += 3; $noc += 2;
        } elseif(240 <= $t && $t <= 247) {
            $tn = 4; $n += 4; $noc += 2;
        } elseif(248 <= $t && $t <= 251) {
            $tn = 5; $n += 5; $noc += 2;
        } elseif($t == 252 || $t == 253) {
            $tn = 6; $n += 6; $noc += 2;
        } else {
            $n++;
        }

        if ($noc >= $length) break;
    }

    if($noc > $length) $n -= $tn;

    $strcut = substr($string, 0, $n);

    $strcut = str_replace(array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

    $pos = strrpos($strcut, chr(1));
    if ( $pos !== false ) $strcut = substr($strcut, 0, $pos);

    $str = $append ? '...' : '';

    return $strcut . $str;
}

function prefix($table) {
    $_codeigniter =& get_instance();
    return $_codeigniter->db->dbprefix . $table;
}

function float_time($time) {
    $now = time();
    $tis = $now - $time;

    if($time < 0) return 'NULL';

    if($tis < 60) {
        return $tis . ' 秒前';
    } else if($tis > 60 && $tis < 3600) {
        return floor($tis/60) . ' 分钟前';
    } else if($tis > 3600 && $tis < (3600 * 24)) {
        return floor($tis/3600) . ' 小时前';
    } else if($tis > (3600 * 24) && $tis < (3600 * 24 * 365)) {
        return floor($tis/(3600*24)) . ' 天前';
    } else {
        return date('Y-m-d H:i:s', $time);
    }
}

function create_dir($path, $mode = 0777) {
    if(is_dir($path)) return true;

    $dir_name = $path . DIRECTORY_SEPARATOR;
    @mkdir($dir_name, 0777, true);
    @chmod($dir_name, 0777);
    return $dir_name;
}

function build_dir($id) {
    $id     = abs( (int) $id );
    $id     = sprintf('%09d', $id);
    $dir1   = substr($id, 3, 2);
    $dir2   = substr($id, 5, 2);
    return $dir1 . DIRECTORY_SEPARATOR . $dir2 . DIRECTORY_SEPARATOR;
}

function move_upload_file($file_name, $target_name = '') {
    if( function_exists('move_uploaded_file') ) {
        if( move_uploaded_file($file_name, $target_name) ) {
            @chmod($target_name, 0755);
            return TRUE;
        } else if ( copy($file_name, $target_name) ) {
            @chmod($target_name, 0755);
            return TRUE;
        }
    } elseif ( copy($file_name, $target_name) ) {
        @chmod($target_name, 0755);
        return TRUE;
    }
    return FALSE;
}

function build_verify($string = '', $width = 60, $height = 24, $type = 'PNG') {

    $length = strlen ( $string );

    $width = ($length * 10 + 10) > $width ? ($length * 10 + 10) : $width;

    if ( $type != 'GIF' && function_exists('imagecreatetruecolor') ) {
        $im = imagecreatetruecolor ( $width, $height );
    } else {
        $im = imagecreate ( $width, $height );
    }

    $backColor = imagecolorallocate ( $im, rand(200, 255), rand(200, 255), rand(200, 255) );

    imagefilledrectangle ( $im, 0, 0, $width - 1, $height - 1, $backColor );

    $stringColor = imagecolorallocate ( $im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120) );

    for ($i = 0; $i < 25; $i++) {
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $stringColor);
    }

    for ($i = 0; $i < $length; $i++) {
        imagestring($im, 5, $i * 10 + 10, mt_rand(1, 5), $string{$i}, $stringColor);
    }

    // ob_clean();
    header('Content-type: image/' . strtolower($type) );
    $function = 'image' . strtolower($type);
    $function( $im );
    imagedestroy( $im );
}

function admin_site_url($uri = '') {
    $_codeigniter =& get_instance();
    return $_codeigniter->config->site_url( ADMINDIR . '/' . $uri );
}

function admin_base_url($uri = '') {
    $_codeigniter =& get_instance();
    return $_codeigniter->config->base_url( ADMINDIR . '/' . $uri );
}

function static_url($uri = '') {
    $_codeigniter =& get_instance();
    return $_codeigniter->config->base_url( config_item('site_static_dir') . '/' . $uri );
}

function attachments_url($uri = '') {
    $_codeigniter =& get_instance();
    return $_codeigniter->config->base_url( config_item('site_attachments_dir') . '/' . $uri );
}

/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */