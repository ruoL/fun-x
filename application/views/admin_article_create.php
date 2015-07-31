<?php $this->load->view('admin_header'); ?>
<link type="text/css" href="<?php echo base_url('minify/?b=static/editors/themes/default&f=ueditor.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('minify/?b=static/editors&f=config.js,editor.js'); ?>"></script>
<script type="text/javascript">
var editor;
$(function() {
    $('.menu-article-create').addClass('curr');

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
                        window.location = '<?php echo admin_site_url('article'); ?>';
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
    $('.bs-docs-sidenav').children('li').eq(0).addClass('active');
    $('.menu-article-create').addClass('active-min');

});
</script>
        <div class="col-sm-10 fx-main">
            <form id="articleform" method="post" action="<?php echo admin_site_url('article/create_action'); ?>"  enctype="multipart/form-data">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">标题</th>
                    <td widht="*" id="article">
                        <input type="text" id="title" name="title" class="form-group-sm form-control" maxlength="64" style="margin:0 7px 3px 0" />
                        <select id="cid" name="cid">
                        <?php if($category) : ?>
                        <?php foreach($category AS $k=>$v) : ?>
                            <option value="<?php echo $v->cid; ?>"><?php echo $v->name; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                        <a href="javascript:;" style="margin-left:6px" onClick="showOptionBox(this)">高级选项 »</a>
                        <ul class="option-multi-item hide">
                            <li>
                                <input type="radio" id="index1" name="index" value="1" /><label for="index1">设置为轮播土</label>
                                <input type="radio" id="index2" name="index" value="0" checked /><label for="index2">不设置为轮播土</label>
                            </li>
                            <li>
                            <input type="text" id="fromurl" name="fromurl" class="form-control" placeholder="文章排序，填写数字，数字越大，排序越高。"/>
                            </li>
                            <li>
                                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="该文章的关键字（keywords），用空格分隔，长度不要超过 80 个字符" maxlength="120"/>
                            </li>
                            <li>
                            <textarea rows="3" type="text" id="description" name="description" class="form-control" style="line-height:18px;overflow:hidden;resize:none" maxlength="120" placeholder="文章描述" title="文章描述"></textarea>
                            </li>
                        </ul>
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
                            <input type="button" value="上传图像" id="upload-attach-butn" class="btn btn-default btn-xs" />
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
                        <input type="button" value="立即发布" id="posted" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;
                        <input type="button" value="暂存草稿" id="drafted" class="input-item-button btn btn-default btn-xs" />&nbsp;&nbsp;
                        <input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;
                        <input type="hidden" id="draftid" name="draftid" value="0" />
                        <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." />
                        <span class="ajax-save-draft hide"></span>
                    </td>
                </tr>
            </table>
            </form>
        </div>
<?php $this->load->view('admin_menu'); ?>



