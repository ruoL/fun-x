<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <form id="articleform" method="post" action="<?php echo admin_site_url('article'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
                <tr>
                    <th width="5%">ID</th>
                    <th width="30%">页面名称</th>
                    <th width="40%">简介</th>
                    <th width="10%">排序</th>
                    <th width="15%">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                    <td valign="top"><?php echo $v->pid; ?></td>
                    <td>
                        <p class="title"><a href="<?php echo site_url('page/' . $v->link); ?>" title="<?php echo $v->name; ?>" target="_blank"><?php echo substring($v->name, 46); ?></a></p>
                        <p class="author">由 <a href="javascript:;"><?php echo $this->plus->get_username_by_uid($v->uid); ?></a> 创建于 <?php echo date('Y/m/d', $v->created);?></p>
                    </td>
                    <td><?php echo $v->description; ?></td>
                    <td><?php echo $v->sort; ?></td>
                    <td>
                        <a href="<?php echo admin_site_url('page/update/' . $v->pid); ?>" class="update">编辑</a> -
                        <a href="javascript:;" class="delete" onClick="deletePageById(this, <?php echo $v->pid; ?>)">删除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="5" class="null">还没有页面，赶快去 <a href="<?php echo admin_site_url('page/create'); ?>">创建页面</a> 吧！</td></tr>
                <?php endif; ?>
            </table>
            
            <?php if($list) : ?>
            <div id="page">
                <p class="fr">
                    <span>共有 <?php echo $rows; ?> 个页面，每页显示 <?php echo $pres; ?> 个</span>
                    <?php echo $page; ?>
                </p>
            </div>
            <?php endif; ?>
            </form>
        </div><!-- /.fx-main -->
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(3).addClass('active');
                $('.menu-page-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>