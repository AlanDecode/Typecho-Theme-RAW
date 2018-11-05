<?php
/** 
* aside.php
* 
* 右侧边栏
* 
* @author      熊猫小A
* @version     0.1
* 
*/ 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<aside>
    <div id="recent-comments">
        <span><i class="fa fa-commenting-o"></i> 最近评论</span>
        <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true&pageSize=5')->to($comments); ?>
        <?php while($comments->next()): ?>
            <span>
            <?php $comments->author(); ?> • <?php echo Utils::formatDate($comments->created,'NATURAL'); ?><br>
            <a href="<?php $comments->permalink(); ?>"><?php $comments->excerpt(50, '...'); ?></a>
        </span>
        <?php endwhile; ?>
    </div>
    <?php if(Utils::isPluginAvailable('TePostViews')): ?>
    <div id="hot-posts">
        <span><i class="fa fa-fire"></i> 热门文章</span>
        <?php TePostViews_Plugin::outputHotPosts(); ?>
    </div>
    <?php endif; ?>
    <?php if($this->fields->showTOC=='1' && ($this->is('post') || $this->is('page'))):?>
    <div id="TOC">
        <span style="font-size:0.9em" class="hidden-xs"><i style="font-size:0.9em" class="fa fa-th-list"></i> 文章目录</span>
        <?php echo $GLOBALS['TOC_O']; ?>
    </div>
    <?php endif;?>
</aside>
