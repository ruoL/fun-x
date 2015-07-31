<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php echo static_url('images/funx.ico'); ?>">
<title>梵响互动</title>
<!-- 最新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/bootstrap.min.css"/>
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/awesome.min.css"/>
<link rel="stylesheet" media="screen" href="http://fun-x.b0.upaiyun.com/static/css/base.css"/>
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
<body  data-spy="scroll" data-target=".funx-navbar" onLoad="mapInit()">
<div id="head">
	<div class="header-menu-wrapper">
		<div class="header-menu-container w960">
			<div class="header-wrapper-l">
				<h1>梵响互动</h1><h2></h2>
			</div>
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
 <div id="iCenter" style="width:100%;opacity: 0.9"></div> 
 <div class="c-footer">
		<ul class="c-footer-main">
			<li>
				<h1>新业务</h1>
				<h6>有关所有业务咨询:<br>
					15771763360(杜经理)<br>
					285999337(QQ)&nbsp;
					dowell@fun-x.cn(email)
				</h6>
			</li>
			<li>
				<h1>求才</h1>
				<h6>我们一直对寻求优秀的人才非常感兴趣，请发简历至:<br>
					careers@fun-x.cn
				</h6>
			</li>
			<li>
				<h1>社交媒体</h1>
				<ul class="share_btn">
					<li><a href="https://www.facebook.com/profile.php?id=100004749078356" title="点击跳转到facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://twitter.com/funx_studio" title="点击跳转到twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="javascript:void(0)" title="微信"  class="share_weixin"><em><img src="<?php echo static_url('img/erwei_code.jpg'); ?>"></em></a></li>
				</ul>
			</li>
		</ul>
	</div>
<script src="<?php echo static_url('scripts/jquery.min.js'); ?>"></script>
<script src="<?php echo static_url('scripts/bootstrap.min.js'); ?>"></script>
<script language="javascript" src="http://webapi.amap.com/maps?v=1.3&key=219f6a0fb30298ebc4568b8232c54b63"></script>
<script language="javascript">
$(function(){
	var t_top=document.body.scrollHeight;
    $("#iCenter").css("height",t_top);
	setTimeout('$(".amap-copyright").hide()',1500); 
})

var mapObj,marker;
//初始化地图对象，加载地图
function mapInit(){
    mapObj = new AMap.Map("iCenter",{
        view: new AMap.View2D({
            center:new AMap.LngLat(108.954859,34.318895),//地图中心点
            zoom:14 //地图显示的缩放级别

        }),zoomEnable:false
    });    
    //添加自定义点标记
    addMarker();
}
//添加带文本的点标记覆盖物
function addMarker(){
    //自定义点标记内容  
    var markerContent = document.createElement("div");
    markerContent.className = "markerContentStyle";
     
    //点标记中的图标
    var markerImg= document.createElement("img");
     markerImg.className="markerlnglat";
     markerImg.src="<?php echo static_url('img/location_icon.png'); ?>";  
     markerContent.appendChild(markerImg);
      
     //点标记中的文本
     var markerSpan = document.createElement("div");
     markerSpan.innerHTML = '<h1>梵响互动</h1><h6>西安市未央区凤城二路天地时代广场(地铁2号线D口)C座2011室</h6>';
     markerContent.appendChild(markerSpan);
     marker = new AMap.Marker({
        map:mapObj,
        position:new AMap.LngLat(108.954859,34.318895), //基点位置
        offset:new AMap.Pixel(-50,-38), //相对于基点的偏移位置
        draggable:false,  //是否可拖动
        content:markerContent   //自定义点标记覆盖物内容
    });
    marker.setMap(mapObj);  //在地图上添加点
}

</script>
<div class="display:none;"> 
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F68929822e16d2568c99d88bc232985af' type='text/javascript'%3E%3C/script%3E"));
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53781641-1', 'auto');
  ga('send', 'pageview');
</script>
</div>
</body>
</html>