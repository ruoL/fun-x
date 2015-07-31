<?php $this->load->view('site_header'); ?>

<div id="wrap" class="clearfix">
    <div id="content">

        <p class="tips">该页面显示文章中所使用到的全部标签，根据标签的话题排序，您可以点击标签查看该领域的所有内容！</p>
        
        <?php if($list) : ?>
        <ul class="list tag">
            <?php foreach($list AS $k=>$v) : ?>
            <li>
                <div class="name fl"><h1><a href="<?php echo site_url('tag/' . $v->slug); ?>"><?php echo $v->name; ?></a></h1></div>
                <div class="stat fr">共 <?php echo $v->total; ?> 个话题</div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        <?php if($list) : ?>
        <div id="page">
            <p class="fl">共有 <?php echo $rows; ?> 个标签，每页显示 <?php echo $pres; ?> 个</p>
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