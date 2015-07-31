<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <p class="tag-stats-info hide"></p>
            <p><input type="button" class="input-item-submit btn btn-default btn-xs" value="开始重新统计" onClick="statsTag(this)" />&nbsp;&nbsp;<img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-stats-wait hide" title="loading..." /></p>
        </div><!-- /.fx-main -->
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(2).addClass('active');
                $('.menu-tag-stats').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>