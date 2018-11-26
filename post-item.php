<?php
/**
 * post-item.php
 * 
 * 文章面板
 * 
 * @author 熊猫小A
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<div id="post-list">
<?php if(!$this->have()):?>
    <div class="post-item">
    <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
    </div>
<?php else:?>
    <?php if($this->is('archive')||$this->is('index')):?>
    <div class="post-item item-nav">
        <div class="post-item-body flex justify-content-justify align-items-center" style="padding:0">
        <b style="color:var(--text-color);display:block;padding:1em">
            <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
                <a href="/">首页</a>
            <?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
                日志 &raquo; <?php $this->title() ?>
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
    <?php endif;?>
    <?php $index=0; ?>
    <?php while($this->next()): ?>
    <?php $index=$index+1; ?>
    <div style="animation-delay:<?php echo 0.2*$index; ?>s" class="post-item <?php if($this->fields->type=='1' && ($this->is('index') || $this->is('archive'))) echo 'shuoshuo';?>">
        <div class="post-item-header flex align-items-center">
            <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
            <div style="font-size: 0.9rem; line-height: 1.5;" class="post-meta flex flex-direction-column">
                <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇<?php if($this->fields->type=='1') echo '说说'; else echo '日志'; ?></span>
                <span><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
            </div>
        </div>
        <div class="post-item-body <?php if($this->fields->banner && $this->is('index')) echo 'pull-left'; if($this->is('index')&&($this->fields->indextype=='1')) echo ' featured';?> flex">
            <article>
            <?php if($this->is('post') || $this->fields->type=='1' ): ?>
                <?php if($this->fields->banner && $this->fields->banner!='') :?>
                <a data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img src="<?php echo $this->fields->banner; ?>"/></a>
                <?php endif; ?>
                <?php if(!($this->fields->type=='1')): ?><h1 style="margin-top:1rem"><?php $this->title();?>
                <?php if($this->user->hasLogin()): ?>
                <sup><a target="_blank" href="<?php echo $this->options->adminUrl.'write-post.php?cid='.$this->cid;?>" class="footnote-ref"><i class="fa fa-edit"></i></a></sup>
                <?php endif;?>
                </h1><?php endif; ?>
                <?php if($this->fields->showTOC=='1'):?>
                    <?php 
                        $parsed=Utils::parseTOC(Utils::parseAll($this->content));
                        $GLOBALS['TOC_O']=$parsed['toc'];
                        echo $parsed['content']; 
                    ?>
                <?php else :?>
                <?php echo Utils::parseAll($this->content); ?>
                <?php endif; ?>
            <?php elseif($this->is('page')):?>
                <h1><?php $this->title();?>
                <?php if($this->user->hasLogin()): ?>
                <sup><a target="_blank" href="<?php echo $this->options->adminUrl.'write-page.php?cid='.$this->cid;?>" class="footnote-ref"><i class="fa fa-edit"></i></a></sup>
                <?php endif;?></h1>
                <?php echo Utils::parseAll($this->content,true); ?>
            <?php else:?>
                <h1><a onclick="$(this).html($(this).html()+`(载入中...)`);" href="<?php $this->permalink(); ?>"><?php if(Utils::isPluginAvailable('Sticky')) $this->sticky(); $this->title();?></a></h1>
                <p><?php $this->excerpt(80); ?></p>
            <?php endif;?>
            </article>
            <?php if($this->is('index') && $this->fields->banner && $this->fields->banner!='' && !($this->fields->type=='1')) :?>
            <a class="index-item-banner-wrap"  data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img class="post-item-banner flex-1" src="<?php echo $this->fields->banner; ?>"/></a>
            <?php endif; ?>
        </div>
        <div class="post-item-footer">
            <?php if(Utils::isPluginAvailable('Like')):?>
                <span class="like-button"><a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                    <i class="fa fa-heart"></i> LIKE <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                </a></span>
            <?php endif; ?>
            <?php if(!$this->is('index')):?>
                <span>Tags：<?php $this->tags('，', true, 'none'); ?></span>
            <?php endif;?>
            <?php if($this->is('index')):?>
                <?php if(!$this->fields->type=='1'): ?>
                <span style="margin-right:1em;"><a style="color:var(--highlight-color)" href="<?php $this->permalink() ?>">阅读全文</a></span>
                <?php else:?>
                <span style="margin-right:1em;"><a target="_self" style="color:var(--highlight-color)" href="<?php $this->permalink() ?>#comments"><i class="fa fa-commenting-o"></i> 评论</a></span>
               <!--span style="margin-right:1em;"><a target="_self" style="color:var(--highlight-color)" href="javascript:void(0)" onclick="toggleShrink(this);"><i class="fa fa-chevron-circle-up"></i> 收起</a></span-->
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>
</div>
