<div class="col-sm-2 fx-sidebar">
    <ul class="nav bs-docs-sidenav">
        <li>
            <a href="javascript:control_nav(0)">文章管理</a>
            <dl class="nav-min">
                <dd  class="menu-article-all"><a href="<?php echo admin_site_url('article'); ?>">所有文章</a></dd>
                <dd class="menu-article-publish"><a href="<?php echo admin_site_url('article/publish'); ?>">已发布</a></dd>
                <dd class="menu-article-draft"><a href="<?php echo admin_site_url('article/draft'); ?>"><?php if($this->plus->get_article_draft()) : ?><em class="badge"><?php echo $this->plus->get_article_draft(); ?></em><?php endif; ?>草稿箱</a></dd>
                <dd class="menu-article-trash"><a href="<?php echo admin_site_url('article/trash'); ?>"><?php if($this->plus->get_article_trash()) : ?><em class="badge"><?php echo $this->plus->get_article_trash(); ?></em><?php endif; ?>回收站</a></dd>
                <dd class="menu-article-create"><a href="<?php echo admin_site_url('article/create'); ?>">写文章</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(1)">分类管理</a>
            <dl>
                <dd class="menu-category-all"><a href="<?php echo admin_site_url('category'); ?>">所有分类</a></dd>
                <dd class="menu-category-create"><a href="<?php echo admin_site_url('category/create'); ?>">添加分类</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(2)">标签管理</a>
            <dl>
                <dd class="menu-tag-all"><a href="<?php echo admin_site_url('tag'); ?>">所有标签</a></dd>
                <dd class="menu-tag-merge"><a href="<?php echo admin_site_url('tag/merge'); ?>">合并标签</a></dd>
                <dd class="menu-tag-stats"><a href="<?php echo admin_site_url('tag/stats'); ?>">统计标签</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(3)">页面管理</a>
            <dl>
                <dd class="menu-page-all"><a href="<?php echo admin_site_url('page'); ?>">所有页面</a></dd>
                <dd class="menu-page-create"><a href="<?php echo admin_site_url('page/create'); ?>">创建页面</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(4)">链接管理</a>
            <dl>
                <dd class="menu-link-all"><a href="<?php echo admin_site_url('link'); ?>">所有链接</a></dd>
                <dd class="menu-link-create"><a href="<?php echo admin_site_url('link/create'); ?>">添加链接</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(5)">用户管理</a>
            <dl>
                <dd class="menu-user-all"><a href="<?php echo admin_site_url('user'); ?>">所有用户</a></dd>
                <dd class="menu-user-create"><a href="<?php echo admin_site_url('user/create'); ?>">创建用户</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(6)">客户留言</a>
            <dl>
                <dd class="menu-user-all"><a href="<?php echo admin_site_url('user'); ?>">查看留言</a></dd>
                <dd class="menu-user-create"><a href="<?php echo admin_site_url('user/create'); ?>">回复留言</a></dd>
            </dl>
        </li>
        <li>
            <a href="javascript:control_nav(7)">案例研究</a>
            <dl>
                <dd class="menu-user-all"><a href="<?php echo admin_site_url('example'); ?>">查看案例</a></dd>
                <dd class="menu-user-all"><a href="<?php echo admin_site_url('example/create'); ?>">添加案例</a></dd>
            </dl>
        </li>
    </ul>
</div><!-- /.fx-sidebar -->
</div><!-- /.fx-container -->
</body>
</html>


