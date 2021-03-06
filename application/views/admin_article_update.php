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
            <form id="articleform" method="post" action="<?php echo admin_site_url('article/create_action'); ?>"   enctype="multipart/form-data">
            <table border="0" cellpadding="0" cellspacing="0" class="form">
                <tr>
                    <th width="100px">标题</th>
                    <td widht="*" id="article">
                        <input type="text" id="title" name="title" class="input-item-text" maxlength="64" style="margin:0 7px 3px 0" value="<?php echo $article->title; ?>" />
                        <select id="cid" name="cid">
                        <?php if($category) : ?>
                        <?php foreach($category AS $k=>$v) : ?>
                            <option value="<?php echo $v->cid; ?>"<?php if($v->cid == $article->cid) echo ' selected'; ?>><?php echo $v->name; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                        <a href="javascript:;" style="margin-left:6px" onClick="showOptionBox(this)">高级选项 »</a>
                        <div class="option-multi-item">
                            <p class="index">
                                <input type="radio" id="index1" name="index" value="1" <?php if($article->index) echo 'checked'; ?> /><label for="index1">显示在首页</label>
                                <input type="radio" id="index2" name="index" value="0" <?php if(!$article->index) echo 'checked'; ?> /><label for="index2">不显示在首页</label>
                            </p>
                            
                            <input type="text" id="fromurl" name="fromurl" class="input-item-text" placeholder="文章来源地址" title="文章来源地址" value="<?php echo $article->from; ?>" />
                            <p class="tips">填写该文章的来源地址，需要加 http://，<em>原创文章不要填写此项</em></p>

                            <input type="text" id="keyword" name="keyword" class="input-item-text" placeholder="文章关键字" maxlength="120" title="文章关键字" value="<?php echo $article->keyword; ?>" />
                            <p class="tips">该文章的关键字（keywords），用空格分隔，长度不要超过 80 个字符</p>
                            
                            <textarea rows="3" type="text" id="description" name="description" class="input-item-text" style="line-height:18px;overflow:hidden;resize:none" maxlength="120" placeholder="文章描述" title="文章描述"><?php echo $article->description; ?></textarea>
                            <p class="tips">该文章的简要描述（description），长度保持在 60-120 个字符为宜</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>内容</th>
                    <td>
                        <script type="text/plain" id="content" name="content" ><?php echo htmlspecialchars_decode($article->content); ?></script>
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
                        <input type="button" value="更新并发布" id="posted" class="input-item-submit" />&nbsp;&nbsp;
                        <input type="button" value="暂存草稿" id="drafted" class="input-item-button" />&nbsp;&nbsp;
                        <input type="button" value="返回" class="input-item-button" onClick="history.back()" />&nbsp;&nbsp;
                        <input type="hidden" id="draftid" name="draftid" value="<?php echo $article->aid; ?>" />
                        <img src="<?php echo static_url('images/ajaxing.gif'); ?>" class="ajax-load-wait hide" title="loading..." />
                        <span class="ajax-save-draft hide"></span>
                    </td>
                </tr>
            </table>
            </form>
        </div>
<?php $this->load->view('admin_menu'); ?>



