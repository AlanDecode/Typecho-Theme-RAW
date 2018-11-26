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
        <?php $this->need('post-item.php'); ?>
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