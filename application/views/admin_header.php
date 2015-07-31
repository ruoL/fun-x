<!DOCTYPE HTML>
<html>
<head>
<title>
<?php
$method = $this->uri->rsegment(1) . '/' . $this->uri->rsegment(2);
switch($method) {
    case 'article/index' :
        echo '所有文章 &lsaquo; 管理面板 &lsaquo;';
        break;
    case 'article/create' :
        echo '添加文章 &lsaquo; 管理面板 &lsaquo;';
        break;
    case 'category/index' :
        echo '所有分类 &lsaquo; 管理面板 &lsaquo;';
        break;
    case 'category/create' :
        echo '添加分类 &lsaquo; 管理面板 &lsaquo;';
        break;
    default:
        echo '起始页 &lsaquo; 管理面板 &lsaquo;';
}
?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link type="text/css" href="<?php echo base_url('static/css/bootstrap.min.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('static/css/bootstrap-theme.min.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('static/css/font-awesome.min.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('static/css/dialog.css') ?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('static/css/admin_base.css') ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('static/scripts/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/scripts/admin_base.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/scripts/jquery.dialog.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/scripts/jquery.crop.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/scripts/jquery.form.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/scripts/admincp.js') ?>"></script>
<script type="text/javascript">
$CONFIG = {};
$CONFIG['baseurl']      = '<?php echo base_url(); ?>';
$CONFIG['adminurl']     = '<?php echo admin_base_url(); ?>/';
$CONFIG['staticurl']    = '<?php echo static_url(); ?>/';
</script>
</head>
<body>
<div class="fx-header">
    <a class="col-sm-9 fx-logo" href="javascript:void(0)"></a>
    <ul class="fx-header-list col-sm-3">
        <li class="curr"><a href="javascript:void(0)">管理面板</a></li>
        <li><a href="javascript:void(0)">退出面板</a></li>
        <li><a href="javascript:void(0)">网站首页</a></li>
    </ul>
</div>
<div class="fx-container">