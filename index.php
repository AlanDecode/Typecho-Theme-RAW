<?php
/**
 * 一款简单的三栏主题~
 * 
 * 作者：<a href="https://www.imalan.cn">熊猫小A</a>
 * 
 * 主题介绍：<a href="https://blog.imalan.cn/archives/163/" target="_blank">Typecho Theme RAW 发布</a>
 * 
 * Wiki：<a href="https://github.com/AlanDecode/Typecho-Theme-RAW/wiki" target="_blank">主题 Wiki</a>
 * 
 * @package Typecho-Theme-RAW
 * @author 熊猫小A
 * @version 0.92
 * @link https://www.imalan.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>

<div id="main" class="flex flex-1">
    <?php $this->need('nav-left.php'); ?>
    <div class="center flex-1">
        <!--post-item start-->
        <div id="post-list">
        <?php if(!$this->have()):?>
            <div class="post-item">
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>
            <div class="post-item item-nav">
                <div class="post-item-body flex justify-content-justify align-items-center" style="padding:0">
                <b style="color:var(--text-color);display:block;padding:1em">
                    <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
                        <a href="/">首页</a>
                    <?php else: ?><!-- 页面为其他页时 -->
                    <?php $this->archiveTitle(array(
                        'category'  =>  _t('分类 "%s" 下的文章'),
                        'search'    =>  _t('包含关键字 "%s" 的文章'),
                        'tag'       =>  _t('标签 "%s" 下的文章'),
                        'author'    =>  _t('%s 发布的文章')
                    ), '', ''); ?>
                    <?php endif; ?>
                </b>
                <div class="index-filter flex justify-content-justify align-items-center">
                    <div class="current" onclick="filterItems(this,0);">全部</div>
                    <div onclick="filterItems(this,1);">日志</div>
                    <div onclick="filterItems(this,2);">说说</div>
                </div>
                </div>
            </div>
            <?php $index=0; $index_s=0; ?>
            <?php while($this->next()): ?>
                <?php 
                    if($this->fields->type=='1'){
                        $index_s++;
                    }
                    else{
                        $index++;
                    }
                ?>
                <div style="animation-delay:<?php echo $this->fields->type=='1'? 0.2*$index_s : 0.2*$index; ?>s" class="post-item <?php if($this->fields->type=='1') echo 'shuoshuo';?>">
                    <div class="post-item-header flex align-items-center">
                        <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                        <div style="font-size: 14px; line-height: 1.5;overflow:hidden" class="post-meta flex flex-direction-column">
                            <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇<?php if($this->fields->type=='1') echo '说说'; else echo '日志'; ?></span>
                            <span style="white-space:nowrap;text-overflow:ellipsis;overflow:hidden"><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                        </div>
                    </div>
                    <div class="post-item-body <?php if($this->fields->banner) echo 'pull-left'; if($this->fields->indextype=='1') echo ' featured';?> flex">
                        <article class="yue">
                        <?php if($this->fields->type=='1'): ?>
                            <?php echo Utils::parseAll($this->content); ?>
                        <?php else:?>
                            <h1 style="margin-bottom:0.5rem"><a onclick="$(this).html($(this).html()+`(载入中...)`);" href="<?php $this->permalink(); ?>"><?php if(Utils::isPluginAvailable('Sticky')) $this->sticky(); $this->title();?></a></h1>
                            <p style="margin-top:0"><?php $this->excerpt(80); ?></p>
                        <?php endif; ?>
                        </article>
                        <?php if($this->fields->banner && $this->fields->banner!='' && !($this->fields->type=='1')) :?>
                        <a class="index-item-banner-wrap"  data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img class="post-item-banner flex-1" src="<?php echo $this->fields->banner; ?>"/></a>
                        <?php endif; ?>
                    </div>
                    <div class="post-item-footer">
                        <?php if(Utils::isPluginAvailable('Like')):?>
                            <span class="like-button"><a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                                <i class="fa fa-heart"></i> LIKE <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                            </a></span>
                        <?php endif; ?>
                        <?php if(!$this->fields->type=='1'): ?>
                        <span style="margin-right:1em;"><a style="color:var(--highlight-color)" href="<?php $this->permalink() ?>">阅读全文</a></span>
                        <?php else:?>
                        <span style="margin-right:1em;"><a target="_self" style="color:var(--highlight-color)" href="<?php $this->permalink() ?>#comments"><i class="fa fa-commenting-o"></i> 评论</a></span>
                    <!--span style="margin-right:1em;"><a target="_self" style="color:var(--highlight-color)" href="javascript:void(0)" onclick="toggleShrink(this);"><i class="fa fa-chevron-circle-up"></i> 收起</a></span-->
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
        <!--post-item end-->
        <?php if($this->have()):?>
            <?php if($this->options->indexloadmore!='1'): ?>
                <?php $this->pageLink('下一页','next','hidden'); ?>
                <div id="index-loadmore-btn" class="loadmore post-item" onclick="loadMorePosts();">加载更多</div>
                <style>a.next{display:none}</style>  
            <?php else:?>
                <?php $this->pageNav('<i class="fa fa-hand-o-left"></i>', '<i class="fa fa-hand-o-right"></i>',1, '...'); ?>
            <?php endif;?>
        <?php else:?>
            <div class="post-item">
                <div class="post-item-body" style="padding-top:1em;text-align:center"><b><a href="/">返回首页</a></b></div>
            </div>
        <?php endif;?>
        <?php $this->need('footer-info.php'); ?>
    </div>
    <?php if($this->options->showaside=='0'||($this->options->showaside=='2'&&$this->user->hasLogin())):?>
        <?php $this->need('aside.php'); ?>
    <?php endif;?>
</div>
<?php $this->need('footer.php'); ?>