<?php
/**
 * page.php
 * 
 * 独立页面
 * 
 * @author 熊猫小A
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>

<div id="main" class="flex flex-1">
    <div class="center flex-1">
        <!--post-item start-->
        <div id="post-list">
        <?php if(!$this->have()):?>
            <div class="post-item full">
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>
            <div style="animation-delay:0.2s" class="post-item">
                <?php if($this->fields->type=='1' || !($this->fields->banner && $this->fields->banner!='')): ?>
                    <div class="post-item-header flex align-items-center" style="padding-bottom:0">
                        <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                        <div style="font-size: 0.85rem; line-height: 1.5;" class="post-meta flex flex-direction-column">
                            <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇<?php if($this->fields->type=='1') echo '说说'; else echo '日志'; ?></span>
                            <span><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                        </div>
                    </div>
                <?php elseif($this->fields->banner && $this->fields->banner!='') :?>
                    <a data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img style="max-width:100%" src="<?php echo $this->fields->banner; ?>"/></a>
                <?php endif; ?>
                <div class="post-item-body full-content <?php if($this->fields->banner && $this->is('index')) echo 'pull-left'; if($this->is('index')&&($this->fields->indextype=='1')) echo ' featured';?> flex">
                    <article>
                    <?php if(!($this->fields->type=='1')): ?>
                        <h1 class="post-title"><?php $this->title();?>
                        <?php if($this->user->hasLogin()): ?>
                            <sup><a target="_blank" href="<?php echo $this->options->adminUrl.'write-page.php?cid='.$this->cid;?>" class="footnote-ref"><i class="fa fa-edit"></i></a></sup>
                        <?php endif;?>
                        </h1>
                    <?php endif; ?>
                    <?php if(!$this->fields->type=='1' && ($this->fields->banner && $this->fields->banner!='')): ?>
                        <div class="post-item-header flex align-items-center" style="padding: 0;font-size:0.85em">
                            <span><b><i class="fa fa-pencil"></i> <?php echo $this->author->screenName; ?></b> • <?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if($this->fields->showTOC=='1'):?>
                        <?php 
                            $parsed=Utils::parseTOC(Utils::parseAll($this->content));
                            $GLOBALS['TOC_O']=$parsed['toc'];
                            echo $parsed['content']; 
                        ?>
                    <?php else :?>
                        <?php echo Utils::parseAll($this->content,true); ?>
                    <?php endif; ?>
                    </article>
                </div>
                <div class="post-item-footer">
                    <?php if(Utils::isPluginAvailable('Like')):?>
                        <span class="like-button"><a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                            <i class="fa fa-heart"></i> LIKE <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                        </a></span>
                    <?php endif; ?>
                    <span>Tags：<?php $this->tags('，', true, 'none'); ?></span>
                </div>
            </div>
        <?php endif; ?>
        </div>
        <!--post-item end-->
        <div class="post-item" style="animation-delay:0.2s">
            <div class="post-pager">
            <?php Utils::thePrev($this);?>
            <?php if($this->options->reward_img&&$this->options->reward_img!=''):?>
            <div class="post-pager-item post-pager-reward" data-title="如果觉得不错就赞赏一下吧~"><a data-fancybox data-src="#reward" href="javascript:;"><i class="fa fa-gift"></i> 打赏</a></div>
            <?php endif;?>
            <?php Utils::theNext($this);?>
            </div>
        </div>
        <?php $this->need('comments.php'); ?>
        <?php $this->need('footer-info.php'); ?>
    </div>
    <?php $this->need('nav-left.php'); ?>
    <?php if(Utils::haveAside($this,$this->user->hasLogin())):?>
        <?php $this->need('aside.php'); ?>
    <?php endif;?>
</div>
<?php $this->need('footer.php'); ?>