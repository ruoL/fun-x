<?php $this->load->view('site_header'); ?>

<div class="funx-page">
    <div style="height:35px!important;"></div>
    <?php $this->load->view('site_sidebar');?>
        <?php if($list) : ?>
		<?php foreach($list AS $k=>$v) : ?>
            <div class="funx-list">
                    <a class="funx-list-item" href="<?php echo site_url('article/' . $v->aid); ?>">
                        <div class="funx-list-item-image" style="background-image: url(<?php echo get_article_image($v->aid); ?>)"></div>
                        <div class="funx-list-item-line">
                            <div class="funx-list-item-title"><?php $title = substring($v->title, 100);echo $title;?></div>
                            <div class="funx-list-item-summary">被 <?php echo $v->views; ?> 人阅读, 于 <?php echo float_time($v->created); ?>发表</div>
                        </div>
                        <div class="funx-list-item-icon fa fa-chevron-right"></div>
                    </a>
            </div>

			<?php endforeach; ?>
			<?php else : ?>
			<p class="null">该分类下还没有发布文章，请 <a href="javascript:;" onClick="history.back()">返回上页</a> 或 <a href="<?php echo site_url(); ?>">转到首页</a> ！</p>
			<?php endif; ?>
      </div>
</div> 
<?php $this->load->view('site_footer'); ?>