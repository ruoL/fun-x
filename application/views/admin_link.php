<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <p class="formtip">以下是所有链接，可以点击链接名称查看详情，也可以编辑、删除某个链接。</p>
            
            <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">网站名称</th>
                    <th width="55%">网站简介</th>
                    <th width="10%">排序</th>
                    <th width="10%">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                    <td valign="top"><?php echo $v->lid; ?></td>
                    <td>
                        <p class="title"><a href="<?php echo $v->link;?>" target="_blank"><?php echo $v->name; ?></a></p>
                        <p class="author"><?php echo $v->link; ?></p>
                    </td>
                    <td><p class="info"><?php echo $v->info ? $v->info : '没有描述'; ?></p></td>
                    <td><?php echo $v->sort; ?></td>
                    <td><a href="<?php echo admin_site_url('link/update/' . $v->lid); ?>" class="update">编辑</a> - <a href="javascript:;" class="delete" onClick="deleteLinkById(this, <?php echo $v->lid; ?>)">删除</a></td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="5" class="null">还没有链接，赶快去 <a href="<?php echo admin_site_url('link/create'); ?>">添加链接</a> 吧！</td></tr>
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
                $('.bs-docs-sidenav').children('li').eq(4).addClass('active');
                $('.menu-link-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>