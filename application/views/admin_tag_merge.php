<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <form id="tagmergeform" method="post" action="<?php echo admin_site_url('tag/merge_action'); ?>">
            <p>
                <label>来源标签：</label>
                <select name="from_tid">
                    <?php if($list) : ?>
                        <option value="0" <?php if($curr === 0) echo 'selected'; ?>>- 选择来源标签 -</option>
                        <?php foreach($list AS $k=>$v) : ?>
                        <option value="<?php echo $v->tid; ?>" <?php if($v->tid == $curr) echo 'selected'; ?>><?php echo $v->name; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="0">没有标签</option>
                    <?php endif; ?>
                </select>
            </p>
            <p>
                <label>目标标签：</label>
                <select name="merge_tid">
                    <?php if($list) : ?>
                        <option value="0">- 选择目标标签 -</option>
                        <?php foreach($list AS $k=>$v) : ?>
                        <option value="<?php echo $v->tid; ?>"><?php echo $v->name; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="0">没有标签</option>
                    <?php endif; ?>
                </select>
            </p>
            <p>
                <input type="button" class="input-item-submit btn btn-default btn-xs" value="合并" onClick="mergeTagAction(this)" style="margin-left:64px" />&nbsp;&nbsp;
                <input type="button" class="input-item-button btn btn-default btn-xs" value="返回" onClick="history.back()" />&nbsp;&nbsp;
                <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-merge-wait hide" title="loading..." />
                <span id="tips"></span>
            </p>
            </form>
        </div><!-- /.fx-main -->
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(2).addClass('active');
                $('.menu-tag-merge').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>