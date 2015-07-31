<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <p class="formtip">您即将要删除分类 <strong><?php echo $category->name; ?></strong> ，您确定要这样做吗？</p>
            <form id="categoryfrom" method="post" action="<?php echo admin_site_url('category/delete_action'); ?>">
                <input type="hidden" name="cid" value="<?php echo $category->cid; ?>" />
                <?php if( $post ) : ?>
                <p style="margin-bottom:15px">该分类下已发布 <?php echo $post; ?> 篇文章，将这些文章移至：</p>
                <select name="newcategory">
                    <?php if($list) : ?>
                    <?php foreach($list AS $k=>$v) : ?>
                        <?php if($v->cid !== $category->cid) : ?>
                        <option value="<?php echo $v->cid; ?>"><?php echo $v->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php endif; ?>
                
                <p style="margin-top:15px"><input type="submit" value="确定删除" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;&nbsp;<input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;&nbsp;<img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." /></p>
            </form>
        </div><!-- /.fx-main -->
            <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(1).addClass('active');
                $('.menu-category-all').addClass('active-min');
                $('#categoryfrom').ajaxForm({
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