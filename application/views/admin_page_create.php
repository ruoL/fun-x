<?php $this->load->view('admin_header'); ?>
<link type="text/css" href="<?php echo base_url('minify/?b=static/editors/themes/default&f=ueditor.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('minify/?b=static/editors&f=config.js,editor.js'); ?>"></script>
<script type="text/javascript">
var editor;
$(function() {
    editor = new baidu.editor.ui.Editor({
        toolbars: [['Bold', 'Italic', 'Underline', 'ForeColor', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'InsertOrderedList','InsertUnorderedList', 'Link', 'Unlink', 'RemoveFormat', 'Preview', 'FullScreen', 'Source']]
    });

    editor.render('content');

    $('#submitform').click(function() {
        editor.sync();
        
        var attach = $('#upload-attach-data');
        var length = attach.children('li');
        var insert = 0;
        
        length.each(function() {
            if( $(this).hasClass('inserted') ) {
                insert ++;
            }
        });
        
        if( insert < length.length ) {
            art.dialog.alert('您还有 ' + (length.length -  insert) + ' 张图片没有插入到页面！');
            return false;
        }
        
        $('#pageform').ajaxSubmit({
            dataType: 'json',
            beforeSubmit: function() {
                $('.ajax-load-wait').show();
            },
            success: function(responseText, statusText, xhr, form) {
                $('.ajax-load-wait').hide();
                $('.formtip').html(responseText.info).addClass(responseText.code);
                if( responseText.code === 'success' ) {
                    form.hide();
                    setTimeout(function() {
                        window.location = '<?php echo admin_site_url('page'); ?>';
                    }, 2500);
                }
            }
        });
    });
});
</script>
        <div class="col-sm-10 fx-main">
        <form id="pageform" method="post" action="<?php echo admin_site_url('page/create_action'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">页面名称</th>
                    <td widht="*" id="article">
                        <input type="text" id="name" name="name" class="input-item-text" maxlength="64" placeholder="页面名称，比如“关于我们”" title="页面名称" style="width:280px; margin:0 7px 3px 0" />
                        <input type="text" id="link" name="link" class="input-item-text" maxlength="64" placeholder="页面链接，比如“about”" title="页面名称" style="width:180px; margin:0 7px 3px 0" />
                        <a href="javascript:;" style="margin-left:6px" onClick="showOptionBox(this)">页面选项 »</a>
                        <div class="option-multi-item hide">
                            <input type="text" id="sort" name="sort" class="input-item-text" value="255" maxlength="3" placeholder="页面显示顺序" title="页面显示顺序" />
                            <p class="tips">该页面在相应位的显示顺序，该项只能是数字并且最大不能超过 255</p>
                            
                            <input type="text" id="keyword" name="keyword" class="input-item-text" maxlength="120" placeholder="页面关键字" title="页面关键字" />
                            <p class="tips">该页面的关键字（keywords），用空格分隔，长度不要超过 80 个字符</p>
                            
                            <textarea rows="3" type="text" id="description" name="description" class="input-item-text" style="line-height:18px;overflow:hidden;resize:none" maxlength="120" placeholder="页面描述" title="页面描述"></textarea>
                            <p class="tips">该页面的简要描述（description），长度保持在 60-120 个字符为宜</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>页面内容</th>
                    <td>
                        <script type="text/plain" id="content" name="content" ></script>
                        <div id="attach">
                            <?php
                                $maxsize = config_item('site_image_maxsize');
                                $imgexte = config_item('site_image_ext');
                                $imgexte = explode('|', $imgexte);
                            ?>
                            <input type="button" value="上传图像" id="upload-attach-butn" class="input-item-button btn btn-default btn-xs" />
                            <input type="file" id="attach-attach-file" name="attach" title="单击上传图像..." onChange="uploadAttachAction(this)" />
                            <img src="<?php echo static_url('images/loading.gif'); ?>" class="upload-attach-wait hide" title="loading..." />
                            <span id="upload-attach-tips">支持 <?php echo implode(', ', $imgexte); ?> 格式的图像，单张大小不能超过 <?php echo $maxsize; ?>MB</span>
                            <ul id="upload-attach-data" class="clearfix"> </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <input type="button" value="保存页面" id="submitform" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;
                        <input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;
                        <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." />
                        <span class="ajax-save-draft hide"></span>
                    </td>
                </tr>
            </table>
            </form>
        </div><!-- /.fx-main -->
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(3).addClass('active');
                $('.menu-page-create').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>

