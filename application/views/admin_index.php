<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <div class="panel panel-default">
                <div class="panel-heading">站点概况</div>
                <ul class="list-group">
                    <li class="list-group-item">文章：<?php echo $post; ?> 篇</li>
                    <li class="list-group-item">用户：<?php echo $user; ?>位</li>
                    <li class="list-group-item">分类：<?php echo $cate; ?> 个</li>
                    <li class="list-group-item">标签：<?php echo $tags; ?>个</li>
                    <li class="list-group-item">页面：<?php echo $page; ?>个</li>
                    <li class="list-group-item">链接：<?php echo $link; ?> 条</li>
                </ul>
                <div class="panel-heading">系统信息</div>
                <ul class="list-group">
                    <li class="list-group-item">操作系统： <?php echo PHP_OS; ?></li>
                    <li class="list-group-item">服务器： <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
                    <li class="list-group-item">PHP版本： <?php echo PHP_VERSION; ?></li>
                    <li class="list-group-item">数据库： MYSQL</li>
                    <li class="list-group-item">上传许可： <?php echo @ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<span class="red">0</span>'; ?></li>
                    <li class="list-group-item">主机名： <?php echo $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')'; ?></li>
                </ul>
            </div>
        </div><!-- /.fx-main -->
<?php $this->load->view('admin_menu'); ?>