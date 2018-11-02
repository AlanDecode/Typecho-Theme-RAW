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
    <div class="post-item-body"><h1 style="text-align:center;margin-top:40px">糟糕，是 404 的感觉</h1></div>
    </div>
<?php else:?>
    <?php while($this->next()): ?>
    <div class="post-item">
        <div class="post-item-header flex align-items-center">
            <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
            <div style="font-size: 0.9rem; line-height: 1.5;" class="post-meta flex flex-direction-column">
                <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇<?php if($this->fields->type=='1') echo '说说'; else echo '文章'; ?></span>
                <span><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
            </div>
        </div>
        <div class="post-item-body <?php if($this->fields->banner && $this->is('index')) echo 'pull-left';?> flex">
            <article>
            <?php if($this->is('post') || $this->fields->type=='1' ): ?>
                <?php if($this->fields->banner && $this->fields->banner!='') :?>
                <a data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img src="<?php echo $this->fields->banner; ?>"/></a>
                <?php endif; ?>
                <?php if(!($this->fields->type=='1')): ?><h1><?php $this->title();?></h1><?php endif; ?>
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
                <h1><?php $this->title();?></h1>
                <?php echo Utils::parseAll($this->content,true); ?>
            <?php else:?>
                <h1><a href="<?php $this->permalink(); ?>"><?php $this->title();?></a></h1>
                <p><?php $this->excerpt(150); ?></p>
            <?php endif;?>
            </article>
            <?php if($this->is('index') && $this->fields->banner && $this->fields->banner!='' && !($this->fields->type=='1')) :?>
            <a class="index-item-banner-wrap"  data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img class="post-item-banner flex-1" src="<?php echo $this->fields->banner; ?>"/></a>
            <?php endif; ?>
        </div>
        <div class="post-item-footer">
            <?php if(Utils::isPluginAvailable('Like')):?>
                <span class="like-button"><a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                    <i class="fa fa-heart"></i> ENJOY <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                </a></span>
            <?php endif; ?>
            <?php if($this->is('index')):?>
                <?php if(!$this->fields->type=='1'): ?>
                <span style="margin-right:1em;"><a style="color:var(--highlight-color)" href="<?php $this->permalink() ?>">阅读全文</a></span>
                <?php else:?>
                <span style="margin-right:1em;"><a style="color:var(--highlight-color)" href="<?php $this->permalink() ?>#comments">Comments</a></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>
</div>
