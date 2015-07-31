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
  <div id="contact">
    <div class="header">
      <h2><a href="javascript:control_menu()">MENU<i class="fa fa-bars"></i></a></h2>
    </div>  
    <div class="cot-main">
      <div class="map">
        <img src="http://fun-x.b0.upaiyun.com/mbfunx/img/map.jpeg" width="100%">
      </div>
      <div class="cot-us">
        <ul class="fl">
          <li class="titles">新业务</li>
          <li>有关所有业务请咨询:</li>
          <li>15771763360 (杜经理)</li>
          <li>285999337 (QQ)</li>
          <li>dowell@fun-x.cn (email)</li>
        </ul>
        <ul> 
          <li class="titles">求才</li>
          <li>我们一直对寻求优秀的人才非常感兴趣，</li>
          <li>请发简历至:</li>
          <li>careers@fun-x.cn</li>
        </ul>
      </div>
      <strong>www.fun-x.cn</strong>
      <h2>梵响互动</h2>
      <em>所有版权归西安梵响广告文化传播有限公司所有</em>
    </div>
  </div>
    <!--幻灯片管理-->
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
    $(".cot-main").css("height",((screen_h-70)+'px'));
    $(".map").css("margin-top",((screen_h/15)+'px'));
    $(".cot-us").css("margin-top",((screen_h/30)+'px'));
    $(".cot-main").children("strong").css("margin-top",((screen_h/10)+'px'));
    $(".cot-main").children("em").css("margin-top",((screen_h/30)+'px'));
    $("#nav").css("display","block");
  });
</script>
</html>















