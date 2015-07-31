<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <form id="categoryfrom" method="post" action="<?php echo admin_site_url('link/update_action'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">网站名称</th>
                    <td widht="*"><input type="text" id="name" name="name" class="input-item-text" maxlength="32" value="<?php echo $link->name; ?>" /><p class="tips">网站的中文名称，长度不能超过 32 个字符</p></td>
                </tr>
                <tr>
                    <th>网站地址</th>
                    <td><input type="text" id="link" name="link" class="input-item-text" maxlength="32" value="<?php echo $link->link; ?>" /><p class="tips">网站的 URL 地址，不要忘了 http://</p></td>
                </tr>
                <tr>
                    <th>网站简介</th>
                    <td><textarea rows="3" type="text" name="info" class="input-item-text" style="line-height:18px;overflow:hidden;resize:none" maxlength="120"><?php echo $link->info; ?></textarea><p class="tips">网站简要描述，用于该链接的 description 标签。</p></td>
                </tr>
                <tr>
                    <th>排序</th>
                    <td><input type="text" name="sort" class="input-item-text" maxlength="3" value="<?php echo $link->sort; ?>" /><p class="tips">链接显示顺序，最大不要超过 255</p></td>
                </tr>
                <tr>
                    <th>&nbsp;<input type="hidden" name="lid" value="<?php echo $link->lid; ?>" /></th>
                    <td><input type="submit" value="立即保存" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;&nbsp;<input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;&nbsp;<img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." /></td>
                </tr>
            </table>
            </form>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {

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
                setTimeout(function() {
                    window.location = '<?php echo admin_site_url('link'); ?>';
                }, 2500);
            }
        }
    });
                $('.bs-docs-sidenav').children('li').eq(4).addClass('active');
                $('.menu-link-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>