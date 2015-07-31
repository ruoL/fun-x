<?php $this->load->view('admin_header'); ?>

<link type="text/css" href="<?php echo base_url('minify/?b=static/editors/themes/default&f=ueditor.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('minify/?b=static/editors&f=config.js,editor.js'); ?>"></script>
<script type="text/javascript">
var editor;
$(function() {
    $('.menu-huangye-create').addClass('curr');

    editor = new baidu.editor.ui.Editor({
        toolbars: [['Bold', 'Italic', 'Underline', 'ForeColor', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'InsertOrderedList','InsertUnorderedList', 'Link', 'Unlink', 'RemoveFormat', 'Preview', 'FullScreen', 'Source']]
    });

    editor.render('content');

    $('#posted').click(function() {
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
            art.dialog.alert('您还有 ' + (length.length -  insert) + ' 张图片没有插入到文章！');
            return false;
        }
        
        $('#articleform').ajaxSubmit({
            dataType: 'json',
            data: { action: 'publish' },
            beforeSubmit: function() {
                $('.ajax-load-wait').show();
            },
            success: function(responseText, statusText, xhr, form) {
                $('.ajax-load-wait').hide();
                $('.formtip').html(responseText.info).addClass(responseText.code);
                if( responseText.code === 'success' ) {
                    form.hide();
                    setTimeout(function() {
                        window.location = '<?php echo admin_site_url('huangye'); ?>';
                    }, 2500);
                }
            }
        });
    });

    $('#drafted').click(function() {
        editor.sync();
        $('#articleform').ajaxSubmit({
            dataType: 'json',
            data: { action: 'draft' },
            beforeSubmit: function() {
                $('.ajax-load-wait').show();
            },
            success: function(responseText, statusText, xhr, form) {
                $('.ajax-load-wait').hide();
                $('.ajax-save-draft').html(responseText.info).show();
                
                setTimeout(function() {
                    $('.ajax-save-draft').fadeOut();
                }, 3000);

                if( responseText.code === 'success' ) {
                    $('#draftid').val(responseText.data);
                }
            }
        });
    });
});
</script>

<table id="wrap" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td id="menu" width="120px">
        <?php $this->load->view('admin_menu'); ?>
    </td>
    <td id="main" width="*">
        <div id="here">
            <p class="tit fl">管理面板 » 黄页</p>
            <p class="opt fr"><?php $this->load->view('admin_curr_user'); ?></p>
        </div>

        <div id="container">            
            <form id="articleform" method="post" action="<?php echo admin_site_url('huangye/create_action'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">标题</th>
                    <td widht="*" id="article">
                        <input type="text" id="title" name="title" class="input-item-text" maxlength="64" style="margin:0 7px 3px 0" />
                        <div class="option-multi-item">
                            <input type="text" id="fromurl" name="fromurl" class="input-item-text" placeholder="文章来源地址" title="文章来源地址" />
                            <p class="tips">填写外链地址，需要加 http://<em>链接地址</em></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>内容</th>
                    <td>
                        <script type="text/plain" id="content" name="content" ></script>
                        <div id="attach">
                            <?php
                                $maxsize = config_item('site_image_maxsize');
                                $imgexte = config_item('site_image_ext');
                                $imgexte = explode('|', $imgexte);
                            ?>
                            <input type="button" value="上传图像" id="upload-attach-butn" class="input-item-button" />
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
                        <input type="button" value="立即发布" id="posted" class="input-item-submit" />&nbsp;&nbsp;
                        <input type="button" value="返回" class="input-item-button" onClick="history.back()" />&nbsp;&nbsp;
                        <input type="hidden" id="draftid" name="draftid" value="0" />
                        <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." />
                        <span class="ajax-save-draft hide"></span>
                    </td>
                </tr>
            </table>
            </form>
            
        </div>
    </td>
</tr>
</table>

<?php $this->load->view('admin_footer'); ?>