<!doctype html>
<html>
<head>
<title>梵响互动后台管理</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
<link href="<?php echo base_url('favicon.ico'); ?>" rel="shortcut icon" />
<link type="text/css" href="<?php echo base_url('minify/?b=static/css&f=bootstrap.min.css,login.css'); ?>" rel="stylesheet" />
<!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url('minify/?b=static/scripts&f=jquery.min.js,jquery.form.js'); ?>"></script>
<script type="text/javascript">
$(function(){
    $('#name').focus();
    
    $('#signform').ajaxForm({
        dataType: 'json',
        beforeSubmit: function() {
            if($('#name').val() == '' ) {
                $('#loading').text('请输入邮箱账号!').show();
                $('#loading').show();
                $('#name').focus();
                return false;
            }
            if( $('#password').val() == '' ) {
                $('#loading').text('请输入密码!').show();
                $('#loading').show();
                $('#password').focus();
                return false;
            }
            
            if( $('#captcha').val() == '' ) {
                $('#loading').text('验证码有问题!').show();
                $('#loading').show();
                $('#name').focus();
                return false;
            }
            
            $('.input-item-submit').val('登录中');
        },
        success: function(responseText, statusText, xhr, form) {
            $('#loading').text(responseText.info).addClass(responseText.code).show();
            $('#loading').show();
            $('.input-item-submit').val('登录');
            if( responseText.code === 'success' ) {
                setTimeout(function() {
                    window.location = '<?php echo admin_site_url(); ?>';
                }, 1000);
            }
        }
    });
});
</script>
</head>
<body>
    <div class="sign-container">
        <div id="sign">
            <div class="sign-top"><div class="sign-top-logo"> <em></em></div></div>
            <div class="sign-form">
            <form id="signform" class="form-horizontal" role="form" method="post" action="<?php echo admin_site_url('sign/sign_action'); ?>">
                <p id="loading" class="alert alert-warning" style="display:none;"></p>
                <div class="form-group"> 
                    <input type="text" class="input-item-text form-control" name="name"  id="name" placeholder="用户名">
                </div>
                <div class="form-group">    
                      <input type="password" name="password" class="input-item-text form-control" id="password" placeholder="密码">
                </div>
                <div class="form-group">
                    <input type="text" class="captcha form-control" name="captcha" id="captcha" placeholder="验证码" maxlength="4"/>
                    &nbsp; &nbsp;<img src="<?php echo site_url('captcha/output/4?t=' . time()); ?>" title="Click Refresh Captcha" onClick="this.src='<?php echo base_url('captcha/output'); ?>' + '?' + Math.random()" style="cursor:pointer;"/>
                    <input type="submit" class="btn btn-default input-item-submit" value="登录">  
                </div>
            </form>
            </div>
        </div> 
    </div>
    </body>
</html>