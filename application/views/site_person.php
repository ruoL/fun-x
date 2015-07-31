<!DOCTYPE html>
<html>
<head>
<title>梵响互动--<?php echo $user->name;?></title>
<meta name="Keywords" content="品牌包装,自媒体包装,网站开发,微信开发"/>
<meta name="Description" content="企业自有媒体,整体vi视觉传达的包装与宣传,包括logo,名片,网站,微信,宣传册等。"/>
<meta name="author" content="梵响互动" />
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
<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="http://fun-x.b0.upaiyun.com/static/css/person.css">
</head>
<body>
	<ul class="information">
		<li><h2><?php echo $user->name;?></h2></li>
		<li><div><img src="http://fun-x.b0.upaiyun.com/static/img/<?php echo $user->head_url;?>"></div></li>
		<li><h3><?php echo $user->title;?></h3></li>
	</ul>
	<ul class="touch">
		<li class="touch-list1 qq"><a href="http://mp.weixin.qq.com/s?__biz=MjM5MDIxMzI0MQ==&mid=200815636&idx=1&sn=67085ea73a5d9720b592e8ae3cba3417&scene=1#rd"><i class="fa fa-weixin fa-3x"></i><br><em>wechat</em></a></li>
		<li class="touch-list1 phone"><a href="tel:<?php echo $user->tel;?>"><i class="fa fa-phone fa-3x"></i><br><em>phone</em></a></li>
		<li class="touch-list1 add"><a href="http://map.baidu.com/mobile/webapp/search/search/qt=s&wd=盛世太白&c=233&searchFlag=bigBox&version=5&exptype=dep&nb_x=12126379.17&nb_y=4036796.61&center_rank=1/vt=map"><i class="fa fa-map-marker fa-3x"></i><br><em>address</em></a></li>
		<li class="touch-list2 more"><a href="http://www.fun-x.cn"><i class="fa fa-plus fa-3x"></i><br><em>more</em></a></li>
	</ul>
	<script>
addEventListener('load', function(){ setTimeout(function(){window.scrollTo(0,1);}, 0); }, false);
var _Conf={
      img:'http://fun-x.b0.upaiyun.com/static/img/<?php echo $user->head_url;?>',
      w:57,
      h:57,
      url:'http://www.fun-x.cn/person/<?php echo $user->id;?>',
      title:'梵响互动<?php echo $user->title;?>--<?php echo $user->name;?>',
      desc:'梵响互动<?php echo $user->title;?>--<?php echo $user->name;?>',
      appid:''
}
function _ShareFriend() {
    WeixinJSBridge.invoke('sendAppMessage',{
          'appid': _Conf.appid,
          'img_url': _Conf.img,
          'img_width': _Conf.w,
          'img_height': _Conf.h,
          'link': _Conf.url,
          'desc': _Conf.desc,
          'title': _Conf.title
          }, function(res){
            _report('send_msg', res.err_msg);
      })
}
function _ShareTL() {
    WeixinJSBridge.invoke('shareTimeline',{
          'img_url': _Conf.img,
          'img_width': _Conf.w,
          'img_height': _Conf.h,
          'link': _Conf.url,
          'desc': _Conf.desc,
          'title': _Conf.title
          }, function(res) {
          _report('timeline', res.err_msg);
          });
}
function _ShareWB() {
    WeixinJSBridge.invoke('shareWeibo',{
          'content': _Conf.desc,
          'url': _Conf.url,
          }, function(res) {
          _report('weibo', res.err_msg);
          });
}
// 当微信内置浏览器初始化后会触发WeixinJSBridgeReady事件。
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        // 发送给好友
        WeixinJSBridge.on('menu:share:appmessage', function(argv){
            _ShareFriend();
      });

        // 分享到朋友圈
        WeixinJSBridge.on('menu:share:timeline', function(argv){
            _ShareTL();
            });

        // 分享到微博
        WeixinJSBridge.on('menu:share:weibo', function(argv){
            _ShareWB();
       });
}, false);
	</script>
</body>
</html>







