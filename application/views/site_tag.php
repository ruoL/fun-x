<?php $this->load->view('site_header'); ?>

<div id="wrap" class="clearfix">
    <div id="content">
        
        <p class="tips">该页面显示 “<strong><?php echo $tag->name; ?></strong>” 的所有文章，共计 <?php echo $tag->total; ?> 篇！</p>

        <?php $this->load->view('site_article_list'); ?>
        
        <?php if($list) : ?>
        <div id="page">
            <p class="fl">共有 <?php echo $rows; ?> 篇文章，每页显示 <?php echo config_item('site_article_pagepre'); ?> 篇</p>
            <p class="fr">
                <?php echo $page; ?>
            </p>
        </div>
        <?php endif; ?>
 
    </div>

    <div id="sidebar">
        <?php include('site_sidebar.php'); ?>
    </div>
</div>

<?php $this->load->view('site_footer'); ?>