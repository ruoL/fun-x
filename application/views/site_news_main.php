<?php $this->load->view('site_header'); ?>
<div id="wrap" class="clearfix">
    <div id="content">
<div id="view">
            <div id="info">
                <h1><?php echo $article->title; ?></h1>
                <p>
                    <em>发布于：<?php echo float_time($article->created); ?></em> -
                    <em>查看：<?php echo $article->views; ?>次</em>
                 </p>
            </div>
            
            <div id="text">
                <p>

                        <?php echo htmlspecialchars_decode($article->content); ?>

                </p>                                
            <div class="bdsharebuttonbox">
                <a href="#" class="bds_qzone" data-cmd="qzone"></a>
                <a href="#" class="bds_tsina" data-cmd="tsina"></a>
                <a href="#" class="bds_tqq" data-cmd="tqq"></a>
                <a href="#" class="bds_renren" data-cmd="renren"></a>
                <a href="#" class="bds_weixin" data-cmd="weixin"></a>
                 <a href="#" class="bds_more" data-cmd="more"></a>
            </div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"",
            "bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},
            "image":{"viewList":["qzone","tsina","tqq","renren","weixin"],
            "viewText":"分享到：","viewSize":"16"},"selectShare":
            {"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};
            with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
            </script>
            </div>

        </div>
         
    </div>

    <div id="sidebar">
    <div class="list">
    </div>
    <dl class="list rank">
        <dt><h3>点击排行</h3></dt>
            <dd><a href="<?php echo site_url('news'); ?>" title="全部信息">全部信息</a></dd>
            <?php foreach ($nav_list as $list_one) { ?>
                <dd><a href="<?php echo site_url('news/'.$list_one->link); ?>" title="测试2"><?php echo $list_one->name;?></a></dd>
            <?php } ?>
    </dl>
    <dl class="list">
        <dt><h3>推荐文章</h3></dt>
            <?php foreach ($news_list as $v_list) { ?>
                <dd><a href="<?php echo site_url('article/'.$v_list['aid']); ?>" title="<?php echo $v_list['title'];?>"><?php echo $v_list['title'];?></a></dd>
            <?php } ?>
    </dl>
    </div>
</div>
<?php $this->load->view('site_footer'); ?>