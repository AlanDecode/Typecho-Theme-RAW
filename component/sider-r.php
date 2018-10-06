<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<div id="widget-right" class="sider sider-r" data-siderbase="#pjax-container">
    <?php if(class_exists('TePostViews_Plugin')): ?>
    <div id="hot-posts" class="sider-item block-item">
        <span onclick="toggleSider(this);"><i class="fa fa-navicon"></i></span>
        <ul><?php TePostViews_Plugin::outputHotPosts(); ?></ul>
    </div>
    <?php endif; ?>
    <div id="recent-comments" class="sider-item block-item">
        <span onclick="toggleSider(this);"><i class="fa fa-navicon"></i></span>
        <ul>
            <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
            <?php while($comments->next()): ?>
            <li>
                <div class="rc-avatar"><?php $comments->gravatar(50,''); ?></div>
                <div class="rc-content"><a href="<?php $comments->permalink(); ?>"><?php $comments->excerpt(30, '...'); ?></a></div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
