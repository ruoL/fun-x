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
	<div id="products">
    <div class="header">
      <h2><a href="javascript:control_menu()">MENU<i class="fa fa-bars"></i></a></h2>
    </div>  
    <div class="pro-main">
      <ul class="pro-programe">
        <li><a href="">平面设计</a></li>
        <li><a href="">互联网开发</a></li>
        <li><a href="">整合互动营销</a></li>
      </ul>
      <ul id="pro-programe-1" class="show">
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
        <li><a href=""><img src="http://fun-x.b0.upaiyun.com/mbfunx/img/pro-1.png" width="100%"></a></li>
      </ul>
      <ul id="pro-programe-2">
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
      </ul>
      <ul id="pro-programe-3">
        <li><a href=""><img src="./static/img/pro-1.png" width="100%"></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
        <li><a href=""></a></li>
      </ul>
    </div>
  </div>
</body>
<script type="text/javascript" src="http://fun-x.b0.upaiyun.com/mbfunx/js/zepto.min.js"></script>
<script src="http://fun-x.b0.upaiyun.com/mbfunx/js/mod.index.js"></script>
<script>
  $(function(){
    var screen_h=$(window).height();
  var screen_w=$(window).width();
  $("#nav").children("li").css("height",((screen_h/5)+'px'));
  $("#nav").children("li").children("a").css("line-height",((screen_h/5)+'px'));
  $("#nav").children("li").children("a").children("label").children(".fa").css("line-height",((screen_h/5)+'px'));
    $(".header").css("height",((screen_h/8)+'px'));
    $(".header").children("h2").children("a").css("line-height",((screen_h/8)+'px'));
    $(".pro-main").css("height",((screen_h-70)+'px'));
    $(".pro-main").children("h3").css("margin-top",((screen_h/10)+'px'));
    $(".pro-main").children("p").css("line-height",((screen_h/28)+'px'));
    $(".pro-main").children(".pro-programe").css("margin-top",((screen_h/10)+'px'));
    $("#pro-programe-1,#pro-programe-2,#pro-programe-3").children("li").css("height",((screen_h/6)+'px'));
    $("#pro-programe-1,#pro-programe-2,#pro-programe-3").children("li").css("width",((screen_w/2.7)+'px'));
    $("#pro-programe-1,#pro-programe-2,#pro-programe-3").children("li").css("margin",((screen_w/40)+'px'));
    $("#nav").css("display","block"); 
     });
   
</script>
</html>















