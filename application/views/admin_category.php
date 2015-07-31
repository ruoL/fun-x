<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">分类名称</th>
                    <th width="65%">描述</th>
                    <th width="10%">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                    <td valign="top"><?php echo $v->cid; ?></td>
                    <td>
                        <p class="title"><a href="<?php echo site_url($v->link);?>" target="_blank"><?php echo $v->name; ?>（<?php echo $v->link; ?>）</a></p>
                        <p class="author">已发布 252 篇文章, 排序为 <?php echo $v->sort; ?></p>
                    </td>
                    <td>
                        <p class="description"><?php echo $v->description ? $v->description : '没有描述'; ?></p>
                    </td>
                    <td><a href="<?php echo admin_site_url('category/update/' . $v->cid); ?>" class="update glyphicon glyphicon-pencil"></a> &nbsp;&nbsp; <a href="<?php echo admin_site_url('category/delete/' . $v->cid); ?>" class="delete glyphicon glyphicon-remove"></a></td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="4" class="null">还没有分类，赶快去 <a href="<?php echo admin_site_url('category/create'); ?>">添加分类</a> 吧！</td></tr>
                <?php endif; ?>
            </table>
            
            <div id="page">
                <p class="fl"></p>
                <p class="fr">
                    <span>共有 <?php echo $rows; ?> 个分类，每页显示 <?php echo $pres; ?> 个</span>
                    <?php echo $page; ?>
                </p>
            </div>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(1).addClass('active');
                $('.menu-category-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>