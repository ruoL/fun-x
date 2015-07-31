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
	    <!--幻灯片管理-->
	<?php $this->load->view('site_mnav');?>
	  <div id="service">
	    <div class="header">
	      <h2><a href="javascript:control_menu()">MENU<i class="fa fa-bars"></i></a></h2>
	    </div>
	    <div class="service-main">
	    	<h1>创造优秀的产品和服务</h1> 
		      <div id="banner_box" class="box_swipe">
		        <ul>           
		          <li class="slides_pic">
	              <!-- <h1>创造优秀的产品和服务</h1>  -->
	              <img width="100%"  src="http://fun-x.b0.upaiyun.com/mbfunx/img/fuwu-1.png">
	              <h2>平面设计</h2>
	              <em>企业标志  企业VI  宣传品   产品包装   导视设计</em>
	            </li>
		          <li class="slides_pic">
	              <!-- <h1>创造优秀的产品和服务</h1>  -->
	              <img width="100%" src="http://fun-x.b0.upaiyun.com/mbfunx/img/fuwu-2.png">
	              <h2>互联网开发</h2>
	              <em>网站开发  手机APP  移动应用  手机互动游戏</em>
	            </li>
		          <li class="slides_pic">
	              <!-- <h1>创造优秀的产品和服务</h1> -->
	              <iframe frameborder=0 width="70%" src="http://v.qq.com/iframe/player.html?vid=y0139k03ccs&tiny=0&auto=0" allowfullscreen></iframe> 
	              <img width="100%" src="http://fun-x.b0.upaiyun.com/mbfunx/img/fuwu-3.png">
	              <h2>互动体验</h2>
	              <em>微信平台搭建  互动视频、动画</em>
	            </li>           
		        </ul>
		        <ol>
		          <li><a href=""></a></li>
		          <li><a href=""></a></li>
	            <li><a href=""></a></li>          
		        </ol>
		      </div>
	    </div> 
	  </div>
</body>
<script type="text/javascript" src="http://fun-x.b0.upaiyun.com/mbfunx/js/zepto.min.js"></script>
<script type="text/javascript" src="http://fun-x.b0.upaiyun.com/mbfunx/js/swipe.js"></script>
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
    $(".service-main").children(".box_swipe").css("padding-top",((screen_h/20)+'px'));
    $(".service-main").css("height",((screen_h-70)+'px'));
    $(".slides_pic").children("h1").css("margin-top",((screen_h/20)+'px'));
    $(".slides_pic").children("h1").css("margin-bottom",((screen_h/16)+'px'));
    
     new Swipe(document.getElementById('banner_box'), {
          speed:500,
          auto:0,
          callback: function(){
              var lis = $(this.element).next("ol").children();
              lis.removeClass("on").eq(this.index).addClass("on");
          }
      });
     });
	$("#nav").css("display","block");
    
</script>
</html>















