<?php $this->load->view('site_header'); ?>

<div id="wrap" class="clearfix">
    <div id="content">
        
        <p class="tips">关键字 “<strong><?php echo $keys; ?></strong>” 的相关结果，共找出 <?php echo $rows; ?> 条。</p>

        <?php $this->load->view('site_article_list'); ?>
        
        <?php if($list) : ?>
        <div id="page">
            <p class="fl">共有 <?php echo $rows; ?> 篇文章，每页显示 <?php echo $pres; ?> 篇</p>
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