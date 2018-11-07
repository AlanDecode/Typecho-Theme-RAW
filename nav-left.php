<?php
/** 
* nav-left.php
* 
* 左侧边栏
* 
* @author      熊猫小A
* @version     0.1
* 
*/ 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<nav id="nav-left">
    <div id="author-panel">
        <div class="avatar-circle">
            <div class="avatar-circle-bg__wrapper">
                <div class="avatar-circle-bg">
                    <div class="avatar-circle-bg">
                        <div class="avatar-circle-bg">
                            <div class="avatar-circle-bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="aside-user__avatar">
            <a href="<?php echo $this->options->left_link?$this->options->left_link:'/' ?>" class="avatar"><img class="avatar author-avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>"></a>
        </div>
        <div class="aside-user__name">
            <a href="<?php echo $this->options->left_link?$this->options->left_link:'/' ?>" class="name"><?php echo $this->author->screenName; ?></a>
        </div>
        <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
        <div class="statics flex">
            <div class="posts-num flex flex-direction-column align-items-center">
                <span><?php $stat->publishedPostsNum() ?></span>
                <span>文章</span>
            </div>
            <div class="comments-num flex flex-direction-column align-items-center">
                <span><?php $stat->publishedCommentsNum() ?></span>
                <span>评论</span>
            </div>
            <div class="category-num flex flex-direction-column align-items-center">
                <span><?php $stat->categoriesNum() ?></span>
                <span>分类</span>
            </div>
        </div>
    </div>
    <?php 
        if($this->options->aside_nav &&$this->options->aside_nav!=''){
            echo '<div id="pages" class="nav-left-panel">
            <span class="hidden-xs"><i class="fa fa-compass"></i> 页面导航</span>
                <ul id="pages-ul">';
            $navs=explode(PHP_EOL,$this->options->aside_nav);
            foreach ($navs as $value) {
                $value=str_replace("\r",'', $value);
                echo '<li>'.$value.'</li>';
            }
            echo '</ul></div>';
        }
    ?>

    <?php 
        if($this->options->aside_link &&$this->options->aside_link!=''){
            echo '<div id="links" class="nav-left-panel">
            <span><i class="fa fa-link"></i> 友情链接</span>
                <ul>';
            $navs=explode(PHP_EOL,$this->options->aside_link);
            foreach ($navs as $value) {
                $value=str_replace("\r",'', $value);
                echo '<li>'.$value.'</li>';
            }
            echo ' </ul>
            </div>';
        }
    ?>
    <?php if($this->is('post') || $this->is('page')):?>
    <div style="box-shadow:none" id="ctrler" class="flex flex-direction-column align-items-end">
        <?php if(Utils::isPluginAvailable('Like')):?>
        <div>
            <a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>"><span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span> </span><i class="fa fa-heart"></i></a>
        </div>
        <?php endif; ?>
        <div><a href="javascript:void(0)" target="_self" onclick="$.scrollTo(`#header`,300)"><i class="fa fa-arrow-up"></i></a></div>
        <div><a href="javascript:void(0)" target="_self" onclick="$.scrollTo(`#comments`,300)"><?php $this->commentsNum(); ?> <i class="fa fa-commenting-o"></i></a></div>
    </div>
    <?php endif;?>
</nav>