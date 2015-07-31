<?php $this->load->view('admin_header'); ?>

<script type="text/javascript">
$(function() {
    $('.menu-huangye').addClass('curr');
});
</script>

<table id="wrap" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td id="menu" width="120px">
        <?php $this->load->view('admin_menu'); ?>
    </td>
    <td id="main" width="*">
        <div id="here">
            <p class="tit fl">管理面板 » 微黄页</p>
            <p class="opt fr"><?php $this->load->view('admin_curr_user'); ?></p>
        </div>

        <div id="container">

            <form id="huangyeform" method="post" action="<?php echo admin_site_url('article'); ?>">
            <table border="0" cellpadding="0" cellspacing="0" class="list">
                <tr>
                    <th width="40%">标题</th>
                    <th width="30%">链接</th>
                    <th width="15%">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                     <td>
                        <div class="image fl">
                            <img src="<?php echo $v->img_url; ?>" id="huangye-image-<?php echo $v->hid; ?>" />
                            <input type="file" id="attach2" name="attach" onChange="uploadImageActionHuang(this, <?php echo $v->hid; ?>)" title="单击上传头图" />
                        </div>
                        <div class="article fl">
                            <p class="title">
                                <a href="<?php echo site_url('huangye/' . $v->hid); ?>" title="<?php echo $v->title; ?>" target="_blank"><?php echo substring($v->title, 46); ?></a>
                                <?php if( $v->image == 1 ) : ?>
                                <img src="<?php echo static_url('images/image.png'); ?>" class="image" title="有图有真相" />
                                <?php endif; ?>
                            </p>
                            <p class="author">由 <a href="javascript:;"><?php echo $this->plus->get_username_by_uid($v->uid); ?></a> 发布于 <?php echo date('Y/m/d', $v->created);?>，被阅读 <?php echo $v->views; ?> 次</p>
                        </div>
                    </td>
                    <td>
                        <p class="category"><a href="<?php echo site_url('category/' . $v->cat_link); ?>" target="_blank"><strong><?php echo $v->cat_name; ?></strong></a></p>
                    </td>
                    <td>
                        <a href="<?php echo admin_site_url('huangye/update/' . $v->hid); ?>" class="update">编辑</a> -
                        <a href="javascript:;" class="delete" onClick="deleteHuangyeById(this, <?php echo $v->hid; ?>)">彻底删除</a></td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="5" class="null">还没有文章，赶快去 <a href="<?php echo admin_site_url('article/create'); ?>">写文章</a> 吧！</td></tr>
                <?php endif; ?>
            </table>
            
            <?php if($list) : ?>
            <div id="page">
                <p class="fr">
                    <span>共有 <?php echo $rows; ?> 篇文章，每页显示 <?php echo $pres; ?> 篇</span>
                    <?php echo $page; ?>
                </p>
            </div>
            <?php endif; ?>
            </form>
            
        </div>
    </td>
</tr>
</table>

<?php $this->load->view('admin_footer'); ?>