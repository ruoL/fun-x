<!DOCTYPE html>
<html>
<head>
	<title>梵响互动</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="http://fun-x.b0.upaiyun.com/mbfunx/css/phone.css">
	<link rel="stylesheet" type="text/css" href="http://fun-x.b0.upaiyun.com/mbfunx/css/font-awesome.min.css">
<meta content="width=device-width, initial-scale=0.5, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
         <!-- Mobile Devices Support @begin -->
            <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
            <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
            <meta content="no-cache" http-equiv="pragma">
            <meta content="0" http-equiv="expires">
            <meta content="telephone=no, address=no" name="format-detection">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Mobile Devices Support @end -->
</head>
<body>
	<?php $this->load->view('site_mnav');?>
	<div id="move">
		<div><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/logo_f.png" width="29%"></div>
		<div id="arrow_down"></div>		
		<em><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/name.png" width="70%"></em>
	</div>
</body>
<script type="text/javascript" src="http://fun-x.b0.upaiyun.com/mbfunx/js/zepto.min.js"></script>
<script src="http://fun-x.b0.upaiyun.com/mbfunx/js/mod.base.js"></script>
<script>
	StartM	=	null;
	OverM	=	null;
  $(function(){
  	var screen_h=$(window).height();
	var screen_w=$(window).width();
	$("#nav").children("li").css("height",((screen_h/5)+'px'));
	$("#nav").children("li").children("a").css("line-height",((screen_h/5)+'px'));
	$("#nav").children("li").children("a").children("label").children(".fa").css("line-height",((screen_h/5)+'px'));
	$("#move").css("padding-top",((screen_h/7)+'px'));
	$("#move").children(".move—logo").css("margin-top",((screen_h/4)+'px'));
	$("#move").children("em").css("margin-top",((screen_h/30)+'px'));
	$("#nav").css("display","block");
     });

</script>
</html>















