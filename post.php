<?php
/**
 * post.php
 * 
 * 文章页面
 * 
 * @author 熊猫小A
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>

<div id="main" class="flex flex-1">
    <?php $this->need('nav-left.php'); ?>
    <div class="center flex-1">
        <?php $this->need('post-item.php'); ?>
        <?php $this->need('comments.php'); ?>
        <?php $this->need('footer-info.php'); ?>
    </div>
    <?php $this->need('aside.php'); ?>
</div>
<?php $this->need('footer.php'); ?>