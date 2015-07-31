<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
                      <?php if($list) : ?>
            <ul id="tag" class="clearfix">
                <?php foreach($list AS $k=>$v) : ?>
                <li>
                    <p class="fl"><strong><a href="<?php echo site_url('tag/' . $v->slug); ?>" target="_blank"><?php echo $v->name; ?></a></strong><em title="共计 <?php echo $v->total; ?> 篇文章"><?php echo $v->total; ?></em></p>
                    <p class="fr">
                        <a href="<?php echo admin_site_url('tag/merge/' . $v->tid); ?>">合并</a>
                        <a href="javascript:;" onClick="deleteTagById(this, <?php echo $v->tid; ?>)">删除</a>
                    </p>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
            <p class="null fl">还没有标签！</p>
            <?php endif; ?>
        </div><!-- /.fx-main -->
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(2).addClass('active');
                $('.menu-tag-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>