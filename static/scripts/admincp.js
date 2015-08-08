$(function() {
    $('select').select();
    $('.list').find('tr:even').css('background', '#F9F9F9');

    $(".change_menu").click(function(){
        $(".sub-menu").slideUp();
        var change_menu=$(this).parent().children(".sub-menu");
        if(change_menu.is(':hidden')){
                change_menu.slideDown();
        }else{
                change_menu.slideUp();
        }
    })
});

function seletMultiItem(ele) {
    $('.select-multi-item').attr('checked', $(ele).is(':checked'));
}

function showOptionBox(ele) {
    var item = $('.option-multi-item');
    item.is(':hidden') ? item.slideDown() : item.slideUp();
}

function deleteTagById(ele, tid) {
    art.dialog.confirm('提示：真的要将该标签彻底删除吗？', function () {
        $(ele).text('删除中...');
        $.getJSON( $CONFIG['adminurl'] + 'tag/delete_action', { tid: tid }, function(json) {
            art.dialog.tips(json.info);
            if( json.code === 'success' ) {
                $(ele).closest('li').remove();
            }
        });
    });
}

function NextThis(ele)
{
    var $par    = $(ele).parent().parent();
    var $ul     = $('#anli-image');
    var $allli  = $('#anli-image li');
    var $index  = $allli.index($par);
    var $len    = $ul.length;
    if ( $index > $len - 1 ) {
        var $next = $par.next();
        $next.after($par);
    }
}

function PrevThis(ele)
{
    var $par    = $(ele).parent().parent();
    var $ul     = $('#anli-image');
    var $allli  = $('#anli-image li');
    var $index  = $allli.index($par);
    var $len    = $ul.length;
    if ( $index > 0 ) {
        var $prev = $par.prev();
        $prev.before($par);
    }
}

function mergeTagAction(ele) {
    $(ele).closest('form').ajaxSubmit({
        dataType: 'json',
        url: $CONFIG['adminurl'] + 'tag/merge_action',
        beforeSubmit: function() {
            $('.ajax-merge-wait').show();
        },
        success: function(responseText, statusText) {
            var color = (responseText.code === 'success') ? 'green' : '#D60000';
            $('.ajax-merge-wait').hide();
            $('#tips').html(responseText.info).css('color', color).show();
        }
    });
}

function statsTag(ele) {
    $('.ajax-stats-wait').show();
    $.getJSON( $CONFIG['adminurl'] + 'tag/stats_action', function(json) {
        $('.tag-stats-info').html(json.info).show();
        $('.ajax-stats-wait').hide();
    });
}

function createArticleTag(ele, aid) {

    closeDialogBox();

    $(ele).css('color', '#D60000');
    
    var str  = '<div class="dialog-item-box">';
        str += '<h5 class="dialog-item-title">输入标签（2至8个字符）：</h5>';
        str += '<input type="text" id="tag" name="tag" class="input-item-text" />';
        str += '<div id="rela"></div>';
        str += '<p id="tips"></p>';
        str += '</div>';
    
    art.dialog({
        title: '添加标签',
        content: str,
        ok: function () {
            insertArticleTag($(ele), aid, $('#tag').val());
            return false;
        },
        cancel: function() {
            $(ele).css('color', '#666');
        }
    });
    
    var tag = $('#tag');
    
    tag.live({
        focus: function() {
            selectRelationTag($(ele), tag, aid);
        },
        keyup: function() {
            selectRelationTag($(ele), tag, aid);
        }
    });
}

function removeToTrashById(ele, aid) {
    art.dialog.confirm('提示：真的要将该文章移至回收站吗？', function () {
        $(ele).css('color', '#CCC');
        $.getJSON( $CONFIG['adminurl'] + 'article/remove_to_trash', { aid: aid }, function(json) {
            $('.formtip').html(json.info).addClass(json.code);
            if( json.code === 'success' ) {
                $(ele).closest('tr').remove();
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
        });
    });
}

function returnToNormalById(ele, aid) {
    art.dialog.confirm('提示：恢复前请检查文章信息是否完整，恢复后文章将直接发布到互联网，确定要操作吗？', function () {
        $(ele).css('color', '#CCC');
    
        $.getJSON( $CONFIG['adminurl'] + 'article/return_to_normal', { aid: aid }, function(json) {
            $('.formtip').html(json.info).addClass(json.code);
            if( json.code === 'success' ) {
                $(ele).closest('tr').remove();
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
        });
    });
}

function applyArticleByAct(ele) {
    var act = $('#action').find(':selected').val();
        var aid = $('.action-aid-item').serializeArray();
        
        if( aid.length === 0 ) {
            art.dialog.tips('您还没有选中任何一篇文章！', 3);
            return false;
        }
        
        switch(act) {
            case 'trash':
                var confirm = '提示：真的要将选中的 ' + aid.length + ' 篇文章放入回收站吗？';
                break
            case 'normal':
                var confirm = '提示：真的要恢复所选中的 ' + aid.length + ' 篇文章吗？';
                break
            case 'delete':
                var confirm = '提示：真的要彻底删除选中的 ' + aid.length + ' 篇文章吗？';
                break
            default:
                var confirm = '提标：确认操作！';
        }
        
        art.dialog.confirm(confirm, function () {
            var request = $CONFIG['adminurl'] + 'article/delete_multi_action?act=' + act +'&' + $.param(aid);
            $.getJSON( request, function(json) {
                $('.formtip').html(json.info).addClass(json.code);
                if( json.code === 'success' ) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 2500);
                }
            });
        });
}

function deleteArticleById(ele, aid) {
    art.dialog.confirm('提示：真的要删除该文章吗？', function () {
        $.getJSON( $CONFIG['adminurl'] + 'article/delete_action', { aid: aid }, function(json) {
            $('.formtip').html(json.info).addClass(json.code);
            if( json.code === 'success' ) {
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
        });
    });
}

function deleteArticleTag(ele, aid, tid) {
    art.dialog.confirm('提示：真的要将该标签从该文章删除吗？', function () {
        $(ele).html('删除中...');
        $.getJSON( $CONFIG['adminurl'] + 'article/delete_tag_action', { aid: aid, tid: tid }, function(json) {
            if( json.code === 'success' ) {
                $(ele).closest('em').remove();
            }
        });
    });
}

function selectRelationTag(ele, tag, aid) {
    setTimeout(function() {
        $.getJSON( $CONFIG['adminurl'] + 'article/select_tag_relation', { tag: tag.val() }, function(json) {
            if( json.code === 'error' ) {
                $('#dialog-rela-box').remove();
                return false;
            }
            
            var str = '<ul id="dialog-rela-box" class="hide">';
            $(json.data).each(function(i) {
                str += '<li><h5>' + json.data[i].name + '</h5><p title="共计 ' + json.data[i].total + ' 篇文章">' + json.data[i].total + '</p></li>';
            });
            str += '</ul>';
   
            tag.closest('.dialog-item-box').find('#rela').html(str);
 
            var obj = $('#dialog-rela-box');

            tag.blur(function() {
                if( ! obj.hasClass('rela') ) {
                    obj.remove();
                }
            });

            obj.css({ position: 'absolute', zIndex: 9999, display: 'block' });

            obj.hover(function() {
                $(this).addClass('rela');
            }, function() {
                $(this).removeClass('rela');
            });

            obj.children('li').click(function() {
                insertArticleTag(ele, aid, $(this).find('h5').text());
                obj.remove();
            });
        });
    }, 500);
}

function insertArticleTag(ele, aid, tag) {
    $('#tips').html('正在添加...').css('color', '#666'); 
    $.getJSON( $CONFIG['adminurl'] + 'tag/create_action', { aid: aid, tag: tag }, function(json) {
        var color = (json.code === 'success') ? 'green' : '#D60000';
        $('#tips').html(json.info).css('color', color);
        if(json.code === 'success') {
            closeDialogBox();
            var str  = '\r\n<em class="input-item-submit">' + json.data.name + '<a href="javascript:;" title="从该文章中移去该标签"';
                str += 'onClick="deleteArticleTag(this, ' + json.data.aid + ', ' + json.data.tid + ')">×</a></em>\r\n';
            ele.before(str).css('color', '#666');
        }
    });
}

function uploadImageAction(ele, aid) {
    $('#articleform').ajaxSubmit({
        dataType: 'json',
        url: $CONFIG['baseurl'] + 'upload/image',
        data: { watermark: 0, temp: 1 },
        beforeSubmit: function() {
            art.dialog.tips('正在上传，请稍候...', 60);
        },
        success: function(responseText, statusText) {
            closeDialogBox();
            
            if( responseText.code === 'success' ) {
                art.dialog.data('aid', aid);
                art.dialog.data('path', responseText.data.filepath);
                art.dialog.open( $CONFIG['adminurl'] + 'article/crop_image', {
                    height: responseText.data.height + 20,
                    width: responseText.data.width + 20,
                    title: '裁切头图',
                    lock: true,
                    ok: function(topWin){
                        var iframe = this.iframe.contentWindow;
                        if ( ! iframe.document.body) {
                            art.dialog.tips('iframe还没加载完毕呢...', 3);
                            return false;
                        };
                        
                        var path    = iframe.document.getElementById('path').value;
                        var aid     = iframe.document.getElementById('aid').value;
                        var x       = iframe.document.getElementById('x').value;
                        var y       = iframe.document.getElementById('y').value;
                        var w       = iframe.document.getElementById('w').value;
                        var h       = iframe.document.getElementById('h').value;

                        $.getJSON( $CONFIG['adminurl'] + 'article/crop_image_action', { path: path, aid: aid, x: x, y: y, w: w, h: h }, function(json) {
                            if(json.code === 'success') {
                                closeDialogBox();
                                
                                var image   = new Image();
                                $(image).load(function() {
                                    $('#article-image-' + aid + '').attr('src', json.data + '?' + Math.random());
                                }) .error( function() { } ) .attr('src', json.data);
                            }
                            art.dialog.tips(json.info, 3);
                        });
                        
                        return false;
                    }
                });
            } else {
                art.dialog.tips(responseText.info);
            }
        }
    });
}

function uploadAttachAction(ele) {
    $(ele).closest('form').ajaxSubmit({
        url: $CONFIG['baseurl'] + 'upload/image',
        dataType: 'json',
        beforeSubmit: function() {
            $('.upload-attach-wait').show();
            $('#upload-attach-butn').addClass('button-disabled');
            $('#upload-attach-tips').html('正在上传，请稍候...').css('color', '#666');
        },
        success: function(responseText, statusText) {
            if( responseText.code === 'success' ) {
                var num = $('#upload-attach-data').find('li').length;
                var str = '<li class="upload-item-' + (num + 1) + ' clearfix">';
                    str += '<img src="' + responseText.data.filepath + '" class="imageview fl" title="' + responseText.data.filename + '" />';
                    str += '<div class="imageinfo fl">';
                    str += '<h5>' + responseText.data.filename + '</h5>';
                    str += '<p><a href="javascript:;" data-nums="0" onClick="insertAttachImage(this, \'' + responseText.data.filepath + '\')">插入到文章</a>';
                    str += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onClick="deleteAttachImage(this, \'' + responseText.data.filepath + '\')">删除</a></p>';
                    str += '</div>';
                    str += '</li>';
                $('#upload-attach-data').append(str);
            }

            $('.upload-attach-wait').hide();
            $('#upload-attach-butn').removeClass('button-disabled');
            $('#upload-attach-tips').html(responseText.info).css('color', (responseText.code === 'success') ? 'green' : '#d60000');
        }
    });
}

function insertAttachImage(ele, image) {
    var image   = { src: image };
    var nums    = $(ele).attr('data-nums');

    if( nums > 0 ) {
        art.dialog.confirm('提示：该图片已经存在文章中，还要再插入一次吗？', function () {
            editor.execCommand('insertImage', image);
        });
    } else {
        editor.execCommand('insertImage', image);
        $(ele).closest('li').addClass('inserted');
    }
    $(ele).attr('data-nums', parseInt(nums) + 1);
}

function deleteAttachImage(ele, image) {
    var nums = $(ele).prev('a').attr('data-nums');
    if( nums > 0 ) {
        art.dialog.confirm('提示：该图片已经插入到文章中，确定要删除吗？', function() {
            deleteImage(ele, image);
        });
    } else {
        deleteImage(ele, image);
    }
}

function deleteImage(ele, image) {
    $(ele).html('删除中...');
    $.getJSON( $CONFIG['adminurl'] + 'article/delete_img_action', { image: image }, function(json) {
        if( json.code === 'success' ) {
            $(ele).closest('li').remove();
        } else {
            art.dialog.tips('删除失败，请重试', 3);
        }
        $(ele).html('删除');
    });
}

function deleteAnLi(ele, image) {
    $(ele).html('删除中...');
    $.getJSON( $CONFIG['adminurl'] + 'example/deleteImage', { image: image }, function(json) {
        if( json.code === 'success' ) {
            $(ele).closest('li').remove();
        } else {
            art.dialog.tips('删除失败，请重试', 3);
        }
        $(ele).html('删除');
    });
}

function deleteLinkById(ele, lid) {
    art.dialog.confirm('提示：真的要将该链接彻底删除吗？', function () {
        $(ele).html('删除中...');
        $.getJSON( $CONFIG['adminurl'] + 'link/delete_action', { lid: lid }, function(json) {
            $('.formtip').html(json.info).addClass(json.code);
            if( json.code === 'success' ) {
                $(ele).html('删除');
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
        });
    });
}

function deletePageById(ele, pid) {
    art.dialog.confirm('提示：真的要将该页面删除吗？', function () {
        $(ele).html('删除中...');
        $.getJSON( $CONFIG['adminurl'] + 'page/delete_action', { pid: pid }, function(json) {
            $('.formtip').html(json.info).addClass(json.code);
            if( json.code === 'success' ) {
                $(ele).html('删除');
                setTimeout(function() {
                    window.location.reload();
                }, 2500);
            }
        });
    });
}

function closeDialogBox() {
    var list = art.dialog.list;
    for (var i in list) {
        list[i].close();
    };
}