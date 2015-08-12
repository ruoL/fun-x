<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="http://fun-x.b0.upaiyun.com/static/images/funx.ico">
<title>梵响互动</title>
<!-- 最新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/bootstrap.min.css"/>
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/awesome.min.css"/>
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/base.css"/>
<link rel="stylesheet" href="<?php echo base_url('static/css/examples.css');?>" type="text/css" media="screen" />
<meta name="Keywords" content="品牌包装,自媒体包装,网站开发,微信开发"/>
<meta name="Description" content="企业自有媒体,整体vi视觉传达的包装与宣传,包括logo,名片,网站,微信,宣传册等。"/>
<meta name="author" content="梵响互动-Mr.dowell" />
<meta name="robots" content="index,follow" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body  data-spy="scroll" data-target=".funx-navbar">
<div id="head">
	<div class="header-menu-wrapper">
		<div class="header-menu-container w960">
			<div class="header-wrapper-l">
				<h1>梵响互动</h1><h2></h2>
			</div>
			<div class="phone-num-b"></div>
			<ul class="header-wrapper-r">
				<li class="nav_list1 <?php if($this->uri->segment(1,0)==='index'||$this->uri->segment(1,0)===0){echo "curr";}?>"><a href="<?php echo site_url('index'); ?>">首页</a></li>
				<li class="nav_list3 <?php if($this->uri->segment(1,0)==='product'){echo "curr";}?>"><a href="<?php echo site_url('product'); ?>">案例</a></li>
				<li class="nav_list4 <?php if($this->uri->segment(1,0)==='team'){echo "curr";}?>"><a href="<?php echo site_url('team'); ?>">了解我们</a></li>
				<li class="nav_list5 <?php if($this->uri->segment(1,0)==='news'){echo "curr";}?>"><a href="<?php echo site_url('news'); ?>">资讯</a></li>
				<li class="nav_list6 <?php if($this->uri->segment(1,0)==='connect'){echo "curr";}?>"><a href="<?php echo site_url('connect'); ?>">联系我们</a></li>
		</ul>
		</div>
	</div>
	<div class="header-nav">
		<div class="nav w960">
		<div class="logo"><a href="<?php echo site_url('index'); ?>"></a></div>
		<div class="phone-num"></div>
		<ul class="nav_list">
				<li class="nav_list1 <?php if($this->uri->segment(1,0)==='index'||$this->uri->segment(1,0)===0){echo "curr";}?>"><a href="<?php echo site_url('index'); ?>">首页</a><em class="fa fa-caret-up"></em></li>
				<li class="nav_list3 <?php if($this->uri->segment(1,0)==='product'){echo "curr";}?>"><a href="<?php echo site_url('product'); ?>">案例</a><em class="fa fa-caret-up"></em></li>
				<li class="nav_list4 <?php if($this->uri->segment(1,0)==='team'){echo "curr";}?>"><a href="<?php echo site_url('team'); ?>">了解我们</a><em class="fa fa-caret-up"></em></li>
				<li class="nav_list5 <?php if($this->uri->segment(1,0)==='news'){echo "curr";}?>"><a href="<?php echo site_url('news'); ?>">资讯</a><em class="fa fa-caret-up"></em></li>
				<li class="nav_list6 <?php if($this->uri->segment(1,0)==='connect'){echo "curr";}?>"><a href="<?php echo site_url('connect'); ?>">联系我们</a><em class="fa fa-caret-up"></em></li>
		</ul>
		</div>
	</div>
</div>

