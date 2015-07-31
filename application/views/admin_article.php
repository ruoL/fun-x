<?php $this->load->view('admin_header'); ?>
        <div class="col-sm-10 fx-main">
            <?php switch ($type) {
                    case 'publish': $typetext = '已发布文章'; break;
                    case 'draft': $typetext = '草稿箱的所有文章'; break;
                    case 'trash': $typetext = '回收站的所有文章'; break;
                    default: $typetext = '所有文章'; break;
            } ?>
            <form id="articleform" method="post" action="<?php echo admin_site_url('article'); ?>" enctype="multipart/form-data">
            <table border="0" cellpadding="0" cellspacing="0" class="list table table-striped">
                <tr>
                    <th width="5%"><input type="checkbox" onClick="seletMultiItem(this)" /></th>
                    <th width="40%">标题</th>
                    <th width="30%">分类</th>
                    <th width="10%">状态</th>
                    <th width="15%" class="article-center">操作</th>
                </tr>
                <?php if($list) : ?>
                <?php foreach($list AS $k=>$v) : ?>
                <tr>
                    <td valign="top"><input type="checkbox" value="<?php echo $v->aid; ?>" name="aid[]" class="action-aid-item select-multi-item" /></td>
                    <td>
                        <div class="image fl">
                            <img src="<?php echo get_article_image($v->aid, 48); ?>" id="article-image-<?php echo $v->aid; ?>"/>
                            <input type="file" id="attach" name="attach" onChange="uploadImageAction(this, <?php echo $v->aid; ?>)" title="单击上传头图" />
                        </div>
                        <div class="article fl">
                            <p class="title">
                                <a href="<?php echo site_url('article/' . $v->aid); ?>" title="<?php echo $v->title; ?>" target="_blank"><?php echo substring($v->title, 46); ?></a>
                                <?php if( $v->image == 1 ) : ?>
                                <img src="<?php echo static_url('images/image.png'); ?>" class="image" title="有图有真相" />
                                <?php endif; ?>
                            </p>
                            <p class="author">由 <a href="javascript:;"><?php echo $this->plus->get_username_by_uid($v->uid); ?></a> 发布于 <?php echo date('Y/m/d', $v->created);?>，被阅读 <?php echo $v->views; ?> 次</p>
                        </div>
                    </td>
                    <td>
                        <p class="category"><a href="<?php echo site_url('category/' . $v->cat_link); ?>" target="_blank"><strong><?php echo $v->cat_name; ?></strong></a></p>
                        <p class="tagitem">
                            <?php $tag = $this->plus->get_tag_by_aid($v->aid); ?>
                            <?php if($tag) : ?>
                            <?php foreach($tag AS $t) : ?>
                            <em class="input-item-button"><?php echo $t->name; ?><a href="javascript:;" title="从该文章中移去该标签" onClick="deleteArticleTag(this, <?php echo $v->aid; ?>, <?php echo $t->tid; ?>)">×</a></em>
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <a href="javascript:;" class="tagcreate null<?php if(count($tag) > 2) echo ' hide'; ?>" onClick="createArticleTag(this, <?php echo $v->aid; ?>)">添加标签</a>
                        </p>
                    </td>
                    <td>
                        <?php switch ($v->state) {
                            case 0: echo '<span class="status-0">草稿</span>'; break;
                            case 1: echo '<span class="status-1">已发布</span>'; break;
                            case 2: echo '<span class="status-2">回收站</span>'; break;
                            case 3: echo '<span class="status-3">待审核</span>'; break;
                            default: echo 'NULL';
                        } ?>
                    </td>
                    <td class="article-btn article-center">
                        <a href="<?php echo admin_site_url('article/update/' . $v->aid); ?>" class="update glyphicon glyphicon-pencil" alt="编辑"></a>  &nbsp;
                        <?php if($type == 'trash') : ?>
                        <a href="javascript:;" class="trash glyphicon glyphicon-home" onClick="returnToNormalById(this, <?php echo $v->aid; ?>)" alt="恢复正常"></a> &nbsp;
                        <?php else : ?>
                        <a href="javascript:;" class="trash glyphicon glyphicon-trash" onClick="removeToTrashById(this, <?php echo $v->aid; ?>)" alt="回收站"></a> &nbsp;
                        <?php endif; ?>
                        <a href="javascript:;" class="delete glyphicon glyphicon-remove" onClick="deleteArticleById(this, <?php echo $v->aid; ?>)" alt="彻底删除"></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td colspan="5" class="null">还没有文章，赶快去 <a href="<?php echo admin_site_url('article/create'); ?>">写文章</a> 吧！</td></tr>
                <?php endif; ?>
            </table>
            
            <?php if($list) : ?>
            <div id="page">
                <p class="fl">
                    <select id="action" name="action">
                        <?php if($type == 'trash') : ?>
                        <option value="normal">恢复正常</option>
                        <?php else : ?>
                        <option value="trash">移至回收站</option>
                        <?php endif; ?>
                        <option value="delete">彻底删除</option>
                    </select>
                    <input type="button" value="确认" class="btn btn-default btn-xs" onClick="applyArticleByAct(this)" />
                </p>
                <p class="fr">
                    <span>共有 <?php echo $rows; ?> 篇文章，每页显示 <?php echo $pres; ?> 篇</span>
                    <?php echo $page; ?>
                </p>
            </div>
            <?php endif; ?>
            </form>
        </div>
        <script type="text/javascript">
            $(function() {
                $('.bs-docs-sidenav').children('li').eq(0).addClass('active');
                $('.menu-article-all').addClass('active-min');
            });
        </script>
<?php $this->load->view('admin_menu'); ?>
