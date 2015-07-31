<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <form id="categoryfrom" method="post" action="<?php echo admin_site_url('category/create_action'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">分类名称</th>
                    <td widht="*"><input type="text" id="name" name="name" class="input-item-text" maxlength="32" /><p class="tips">分类显示名称（中文名称），长度不要超过 32 个字符</p></td>
                </tr>
                <tr>
                    <th>链接名称</th>
                    <td><input type="text" id="link" name="link" class="input-item-text" maxlength="32" /><p class="tips">分类链接名称，只能包含 <em>英文字母</em> 和 <em>下划线</em>，长度不要超过 32 个字符</p></td>
                </tr>
                <tr>
                    <th>关键字</th>
                    <td><input type="text" name="keyword" class="input-item-text" maxlength="120" /><p class="tips">该分类的关键字，用于分类页的 keywords 标签，填写 5-8 个关键字为宜</p></td>
                </tr>
                <tr>
                    <th>描述</th>
                    <td><textarea rows="3" type="text" name="description" class="input-item-text" style="line-height:18px;overflow:hidden;resize:none" maxlength="120"></textarea><p class="tips">分类简要描述，用于分类页的 description 标签，长度 60-120 个字为宜</p></td>
                </tr>
                <tr>
                    <th>排序</th>
                    <td><input type="text" name="sort" class="input-item-text" value="255" maxlength="3" /><p class="tips">分类显示顺序，最大不要超过 255</p></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><input type="submit" value="立即保存" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;&nbsp;<input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;&nbsp;<img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." /></td>
                </tr>
            </table>
            </form>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(1).addClass('active');
                $('.menu-category-create').addClass('active-min');
                    $('#categoryfrom').ajaxForm({
        dataType: 'json',
        beforeSubmit: function() {
            if( $.trim($('#name').val()) === '' ) {
                $('.formtip').html($('#name').siblings('.tips').text()).addClass('error');
                return false;
            }
        
            if( $.trim($('#link').val()) === '' ) {
                $('.formtip').html($('#link').siblings('.tips').text()).addClass('error');
                return false;
            }

            $('.ajax-load-wait').show();
        },
        success: function(responseText, statusText, xhr, form) {
            $('.formtip').html(responseText.info).addClass(responseText.code);
            $('.ajax-load-wait').hide();
            
            if( responseText.code === 'success' ) {
            
                form.resetForm();
                setTimeout(function() {
                    window.location = '<?php echo admin_site_url('category'); ?>';
                }, 2500);
            }
        }
    });
            });
        </script>
<?php $this->load->view('admin_menu'); ?>