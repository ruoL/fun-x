<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <form id="userform" method="post" action="<?php echo admin_site_url('user/create_action'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">电子邮件</th>
                    <td widht="*"><input type="text" id="email" name="email" class="input-item-text" maxlength="32" /><p class="tips">该用户的电子邮件，请保证该邮件可以，将用以发布通知</p></td>
                </tr>
                <tr>
                    <th>真实姓名</th>
                    <td><input type="text" id="username" name="username" class="input-item-text" maxlength="16" /><p class="tips">用户姓名可以由汉字、字母或数字组成，长度不能超过 16 个字符</p></td>
                </tr>
                <tr>
                    <th>用户密码</th>
                    <td><input type="password" id="password" name="password" class="input-item-text" maxlength="16" /><p class="tips">设置一个密码，这个密码可以由字母、数字和下划线组成，长度保持 6-16 个字符</p></td>
                </tr>
                <tr>
                    <th>重复密码</th>
                    <td><input type="password" id="repassword" name="repassword" class="input-item-text" maxlength="16" /><p class="tips">再次输入密码以保持一致</p></td>
                </tr>
                <tr>
                    <th>简单介绍</th>
                    <td><textarea rows="3" type="text" name="intro" class="input-item-text" style="line-height:18px;overflow:hidden;resize:none" maxlength="120"></textarea><p class="tips">该用户简单介绍，即一句话介绍自己</p></td>
                </tr>
                <tr>
                    <th>用户状态</th>
                    <td>
                        <input type="radio" id="state1" name="state" value="1" checked /><label for="state1">正常</label>&nbsp;&nbsp;
                        <input type="radio" id="state0" name="state" value="0" /><label for="state0">暂时冻结</label>
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <input type="submit" value="立即保存" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;
                        <input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;
                        <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." />
                    </td>
                </tr>
            </table>
            </form>
        </div><!-- /.fx-main -->
                <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(5).addClass('active');
                $('.menu-user-create').addClass('active-min');
                    $('#userform').ajaxForm({
                        dataType: 'json',
                        beforeSubmit: function() {
                            $('.ajax-load-wait').show();
                        },
                        success: function(responseText, statusText, xhr, form) {
                            $('.formtip').html(responseText.info).addClass(responseText.code);
                            $('.ajax-load-wait').hide();
                            
                            if( responseText.code === 'success' ) {
                                form.resetForm();
                                setTimeout(function() {
                                    window.location = '<?php echo admin_site_url('user'); ?>';
                                }, 2500);
                            }
                        }
                    });
            });
        </script>
<?php $this->load->view('admin_menu'); ?>