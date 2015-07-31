<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
                      <p class="formtip">您即将要删除用户 <strong><?php echo $user->username; ?></strong> ，您确定要这样做吗？</p>
            
            <form id="userform" method="post" action="<?php echo admin_site_url('user/delete_action'); ?>">
                <input type="hidden" name="uid" value="<?php echo $user->uid; ?>" />
                <?php if( $post OR $page ) : ?>
                <p style="margin-bottom:15px">
                    <strong><?php echo $user->username; ?></strong>
                    <?php if($post) : ?>共发布 <?php echo $post; ?> 篇文章<?php endif; ?><?php if($page) : ?>共创建 <?php echo $page; ?> 个页面<?php endif; ?>，将这些文章或页面转交给：
                </p>
                <select name="newuid">
                    <?php if($move) : ?>
                    <?php foreach($move AS $k=>$v) : ?>
                        <?php if( ($v->uid != $user->uid) AND ($v->uid != 1)) : ?>
                        <option value="<?php echo $v->uid; ?>"><?php echo $v->username; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php endif; ?>
                
                <p style="margin-top:15px"><input type="submit" value="确定删除" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;&nbsp;<input type="button" value="返回" class="input-item-button" onClick="history.back()" />&nbsp;&nbsp;&nbsp;<img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." /></p>
            </form>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(5).addClass('active');
                $('.menu-user-all').addClass('active-min');
                    $('#userform').ajaxForm({
        dataType: 'json',
        beforeSubmit: function() {
            $('.ajax-load-wait').show();
        },
        success: function(responseText, statusText, xhr, form) {
            $('.formtip').html(responseText.info).addClass(responseText.code);
            $('.ajax-load-wait').hide();
            
            if( responseText.code === 'success' ) {
                $('#categoryfrom').hide();
                setTimeout(function() {
                    window.location = '<?php echo admin_site_url('category'); ?>';
                }, 2500);
            }
        }
    });
            });
        </script>
<?php $this->load->view('admin_menu'); ?>