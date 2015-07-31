<?php $this->load->view('admin_header'); ?>
<script type="text/javascript">
$(function() {
    $('#posted').on('click', function() {
        $('#exampleform').ajaxSubmit({
            dataType: 'json',
            beforeSubmit: function() {
                if ($.trim($('#name').val()) == '') {
                    $('.ajax-info').html('请填写案例名称!');
                    return false;
                }
                if ($.trim($('#tag').val()) == '') {
                    $('.ajax-info').html('请填写分类标签!');
                    return false;
                }
                if ($.trim($('#zhaiyao').val()) == '') {
                    $('.ajax-info').html('请填写案例摘要!');
                    return false;
                }
                if ($.trim($('#jianjie').val()) == '') {
                    $('.ajax-info').html('请填写案例简介!');
                    return false;
                }
                $('.ajax-info').html('正在提交......');
            },
            success: function(responseText, statusText, xhr, form) {
                $('.ajax-info').css("color", "red").html(responseText.info);
                if( responseText.code === 'success' ) {
                    $('.ajax-info').html('添加成功');
                    setTimeout(function() {
                        window.location = "<?php echo admin_site_url('example'); ?>";
                    }, 1000)
                }
            }
        });
    });
    $('#fengmian').on('change', function(){
        $('#exampleform').ajaxSubmit({
            url: '/upload/exampleimage',
            dataType: 'json',
            beforeSubmit: function(){},
            success: function(response, status, xhr, form){
                var str = '<img src="' + response.data.filepath + '" width="100px;">';
                    str += '<input type="hidden" name="fengmian" value="' + response.data.fullpath + '"/>';
                $('#fengmian-image').html(str);
            }
        });
    });
    $('#images').on('change', function(){
        $('#exampleform').ajaxSubmit({
            url: '/upload/exampleimage',
            dataType: 'json',
            beforeSubmit: function(){},
            success: function(response, status, xhr, form){
                var num = $('#anli-image').find('li').length;
                var str = '<li style="float:left;margin-right:5px;" class="anli-' + num + '">';
                    str += '<img src="' + response.data.filepath + '" width="100px;">';
                    str += '<input type="hidden" name="anli[]" value="' + response.data.fullpath + '"/>';
                    str += '<p><a href="javascript:;" onclick="deleteAnLi(this, \''+response.data.fullpath+'\');">删除</a></p>';
                    str += '</li>';
                $('#anli-image').append(str);
            }
        });
    });
    $('#sexi').on('click', function(){
        var td = $('#sexi').closest('td');
        var num = td.find('input').length;
        if (num >= 4 ) return false;
        var str = '<input type="color" id="color" name="color[]"/>';
        $('#sexi').before(str);
    });
    $('#biaoqian').on('click', function(){
        var td = $('#biaoqian').closest('td');
        var num = td.find('input').length;
        if (num >= 4 ) return false;
        var str = '<input type="text" id="tag" name="tag[]" class="form-group-sm form-control" maxlength="64" style="margin:0 7px 3px 0;width: 500px;" />';
        $('#biaoqian').before(str);
    });
});
</script>
<div class="col-sm-10 fx-main">
<?php if (!empty($example)) :?>
  <form id="exampleform" method="post" action="<?php echo admin_site_url('example/updateAction'); ?>" enctype="multipart/form-data">
    <table border="0" cellpadding="0" cellspacing="0" class="form">
      <tr>
        <th width="100px">案例名称</th>
        <td widht="*" id="article">
            <input type="text" id="name" name="name" class="form-group-sm form-control" maxlength="10" style="margin:0 7px 3px 0;width: 500px;" value="<?php echo $example->name;?>" placeholder="最多10个字" />
            </td>
        </tr>
        <tr>
            <th>分类标签</th>
            <td>
                <?php if(!empty($example->tag)):?>
                    <?php foreach($example->tag as $value):?>
                <input type="text" id="tag" name="tag[]" class="form-group-sm form-control" maxlength="64" style="margin:0 7px 3px 0;width: 500px;" value="<?php echo $value;?>" />
                <?php endforeach;?>
            <?php endif;?>
                <a href="javascript:;" id="biaoqian">更多</a>
            </td>
        </tr>
        <tr>
            <th>案例摘要</th>
            <td>
            <textarea rows="2" type="text" id="zhaiyao" name="zhaiyao" class="form-control" style="line-height:18px;overflow:hidden;resize:none" maxlength="120" placeholder="案例摘要" title="案例摘要"><?php echo $example->zhaiyao;?>
            </textarea>
            </td>
        </tr>
        <tr>
            <th>案例简介</th>
            <td>
            <textarea rows="3" type="text" id="jianjie" name="jianjie" class="form-control" style="line-height:18px;overflow:hidden;resize:none" maxlength="200" placeholder="案例简介(最多200字数)" title="案例简介"><?php echo $example->jianjie;?>
            </textarea>
            </td>
        </tr>
        <tr>
            <th>色系值</th>
            <td>
            <?php if(!empty($example->color)):?>
                <?php foreach($example->color as $value):?>
                <input type="color" id="color" name="color[]" value="<?php echo $value;?>" />
                <?php endforeach;?>
            <?php endif;?>
                <a href="javascript:;" id="sexi">更多</a>
            </td>
        </tr>
        <tr>
            <th>封面图片</th>
            <td>
                <input type="file" id="fengmian" name="attach" /><p>如需修改直接上传</p>
                <ul id="fengmian-image">
                    <?php if($example->fengmian):?>
                        <img src="<?php echo base_url($example->fengmian);?>">
                        <input type="hidden" name="fengmian" value="<?php echo $example->fengmian;?>"/>
                    <?php endif;?>
                </ul>
            </td>
        </tr>
        <tr>
            <th>案例图片</th>
            <td>
                <input type="file" id="images" name="attach"/>
                <ul id="anli-image">
                    <?php if(!empty($example->anli)):?>
                        <?php foreach($example->anli as $value):?>
                            <li style="float:left;margin-right:5px;">
                                <img src="<?php echo base_url($value);?>" width="100px;">
                                <input type="hidden" name="anli[]" value="<?php echo $value;?>"/>
                                <p><a href="javascript:;" onclick="deleteAnLi(this, '<?php echo $value;?>');">删除</a></p>
                            </li>
                        <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
                <input type="hidden" name="id" value="<?php echo $example->id;?>" />
                <input type="button" value="发布" id="posted" class="input-item-submit btn btn-default btn-xs" />&nbsp;&nbsp;
                <input type="button" value="返回" class="input-item-button btn btn-default btn-xs" onClick="history.back()" />&nbsp;&nbsp;
                <span class="ajax-info"></span>
            </td>
        </tr>
    </table>
</form>
<?php else:?>
    没有找到案例
<?php endif;?>
</div>
<?php $this->load->view('admin_menu'); ?>