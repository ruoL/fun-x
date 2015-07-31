<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <p class="formtip">以下是全部用户，可以编辑、删除某个用户。</p>

            <form id="userform" method="post" action="<?php echo admin_site_url('user'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
                <tr>
                    <th width="5%">UID</th>
                    <th width="30%">用户名</th>
                    <th width="20%">注册时间</th>
                    <th width="20%">最后登录</th>
                    <th width="10%">状态</th>
                    <th width="15%">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                    <td><?php echo $v->uid; ?></td>
                    <td>
                        <p class="title"><?php echo $v->username; ?></p>
                        <p class="author"><?php echo $v->email; ?></p>
                    </td>
                    <td><?php echo date('Y/m/d H:i', $v->regtime); ?></td>
                    <td><?php echo date('Y/m/d H:i', $v->lastlogin); ?></td>
                    <td>
                        <?php switch ($v->state) {
                            case 0: echo '<span class="status-0">已冻结</span>'; break;
                            case 1: echo '<span class="status-1">正常</span>'; break;
                            default: echo 'NULL';
                        } ?>
                    </td>
                    <td>
                        <a href="<?php echo admin_site_url('user/update/' . $v->uid); ?>" class="update">编辑</a> -
                        <a href="<?php echo admin_site_url('user/delete/' . $v->uid); ?>" class="delete">删除</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="5" class="null">还没有用户，赶快去 <a href="<?php echo admin_site_url('user/create'); ?>">创建用户</a> 吧！</td></tr>
                <?php endif; ?>
            </table>
            </form>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(5).addClass('active');
                $('.menu-user-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>