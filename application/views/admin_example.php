<?php $this->load->view('admin_header'); ?>
<div class="col-sm-10 fx-main">
    <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
        <tr>
            <th width="5%">ID</th>
            <th width="20%">案例名称</th>
            <th width="30%">案例标签</th>
            <th width="30%">案例色值</th>
            <th width="5%">案例序号</th>
            <th width="10%" class="article-center">操作</th>
        </tr>
        <?php if($list) : ?>
            <?php foreach($list AS $value) : ?>
            <tr>
                <td><?php echo $value->id;?></td>
                <td><?php echo $value->name;?></td>
                <td><?php echo implode(',', $value->tag);?></td>
                <td><?php echo implode(',', $value->color);?></td>
                <td><input class="sort" style="width:40px;" data-id="<?php echo $value->id;?>" type="text" value="<?php echo $value->sort;?>"/></td>
                <td align="center">
                    <a href="<?php echo admin_site_url('example/update/'.$value->id); ?>">编辑</a>
                    <a href="<?php echo admin_site_url('example/delete/'.$value->id); ?>" class="btn-delete">删除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else : ?>
        <tr>
            <td colspan="5">还没有案例，赶快去 <a href="<?php echo admin_site_url('example/create'); ?>">添加</a> 吧！</td>
        </tr>
        <?php endif; ?>
</table>
    <?php if($list) : ?>
    <div id="page">
        <p class="fr">
            <span>共有 <?php echo $rows; ?> 个案例，每页显示 <?php echo $pres; ?> 个</span>
            <?php echo $page; ?>
        </p>
    </div>
    <?php endif; ?>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/ui-dialog.css');?>">
<script type="text/javascript" src="<?php echo base_url('static/scripts/dialog-min.js');?>"></script>
<script type="text/javascript">
    $(function() {
        $('.bs-docs-sidenav').children('li').eq(7).addClass('active');
        $('.menu-article-all').addClass('active-min');

        $('.btn-delete').on('click', function () {
            if ( !confirm('确定要删除么!') ) {
                return false;
            };
        })

        $('.sort').on('blur', function(){
            $id     = $(this).data('id');
            $sort   = $(this).val();
            if ( $sort == '' ) $sort = 0;
            $.post($CONFIG['adminurl'] + 'example/updateSort', {id: $id, sort: $sort}, function( data ){
                if ( data.code == 'success' ) {
                    var d = dialog({
                        title: '提示消息',
                        content: data.info
                    });
                    d.show();
                    setTimeout(function () {
                        d.close().remove();
                    }, 2000);
                } else {
                    var d = dialog({
                        title: '提示消息',
                        content: data.info
                    });
                    d.show();
                    setTimeout(function () {
                        d.close().remove();
                    }, 2000);
                }
            }, 'json');
        });
    });
</script>
<?php $this->load->view('admin_menu'); ?>
