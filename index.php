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
 * @version 0.81
 * @link https://www.imalan.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>

<div id="main" class="flex flex-1">
    <?php $this->need('nav-left.php'); ?>
    <div class="center flex-1">
       <?php $this->need('post-item.php'); ?>
       <?php $this->pageLink('下一页','next','hidden'); ?>
        <?php if($this->have()):?>
            <div id="index-loadmore-btn" class="loadmore post-item" onclick="loadMorePosts();">加载更多</div>
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
<style>
a.next{display:none}
</style>