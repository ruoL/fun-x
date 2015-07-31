<?php $this->load->view('site_header'); ?>
<div id="wrap" class="clearfix">
    <div id="content">
        <ul class="list">
        <?php if(empty($list)){ ?>
        <p>这个分类暂时没有文章。</p>
        <?php }else{ foreach ($list as $one_page) { ?>
        <li class="article-item-89 clearfix">
            <div class="pic fl">
                <a href="<?php echo site_url('article/'.$one_page->aid); ?>">
                <img src="<?php echo get_article_image($one_page->aid); ?>" title="<?php echo $one_page->title;?>">
                </a>
            </div>
            <div class="article fr">
            <h1 class="title">
            <a href="<?php echo site_url('article/'.$one_page->aid); ?>" title="<?php echo $one_page->title;?>"><?php echo $one_page->title;?></a>
            </h1>
            <h3 class="description"><?php echo $one_page->description;?></h3>
            <div class="info">
            <p class="fl">被 <?php echo $one_page->views;?>人阅读</p>
            <p class="fr"><a href="<?php echo site_url('article/'.$one_page->aid); ?>">阅读 »</a></p>
            </div>
            </div>
        </li>
        <?php } } ?>
        </ul>
        
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
    <div class="list">
    <dl class="list">
        <dt><h3>文章分类</h3></dt>
            <dd><a href="<?php echo site_url('news'); ?>" title="全部信息">全部信息</a></dd>
            <?php foreach ($nav_list as $list_one) { ?>
                <dd><a href="<?php echo site_url('news/'.$list_one->link); ?>" title="<?php echo $list_one->name;?>"><?php echo $list_one->name;?></a></dd>
            <?php } ?>
    </dl>
    <dl class="list">
        <dt><h3>点击排行</h3></dt>
            <?php foreach ($news_list as $v_list) { ?>
                <dd><a href="<?php echo site_url('article/'.$v_list['aid']); ?>" title="<?php echo $v_list['title'];?>"><?php echo $v_list['title'];?></a></dd>
            <?php } ?>
    </dl>
    </div>
    </div>
</div>
<?php $this->load->view('site_footer'); ?>