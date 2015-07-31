您好，<strong><?php echo $this->auth->user('username'); ?></strong> - 
<?php echo anchor(admin_site_url('sign/out'), '退出面板'); ?> -
<?php echo anchor(admin_site_url(), '管理面板'); ?> -
<?php echo anchor(site_url(), '网站首页', array('target'=>'_blank')); ?>