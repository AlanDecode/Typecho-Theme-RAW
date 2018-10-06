<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<?php if(Utils::isPJAX()):?>
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php else: ?>
    <!DOCTYPE HTML>
    <html>
    <?php $this->need('component/head.php'); ?>
    <body>
    <?php $this->need('component/header.php'); ?>
    <div id="main">
        <div id="main-content">
        <?php $this->need('component/aside.php'); ?>
<?php endif;?>
    <div id="pjax-container">
    <?php $this->need('component/crumbs-patch.php'); ?>
    <article class="block-item">
        <h1><?php echo $this->title(); ?></h1>
        <?php Content::exportPostMeta($this); ?>
        <?php if($this->fields->excerpt): ?>
        <p class="excerpt"><?php echo $this->fields->excerpt; ?></p>
        <?php endif;?>
        <?php 
            if($this->fields->showTOC=='1'){
                $parsed=Content::parseTOC($this->content);
                echo Content::parseIMG($parsed['content']);
            }
            else{
                echo Content::parseIMG($this->content);
            }
        ?>          
    </article>
    <?php if(class_exists('Like_Plugin')) Like_Plugin::theLike($link=true,$this); ?>
    <ul class="page-navigator post-pager">
        <li class="prev"><span class="pager-name">上一篇<br></span><?php $this->thePrev('%s','没有了'); ?></li>
        <li class="next"><span class="pager-name">下一篇<br></span><?php $this->theNext('%s','没有了'); ?></li>
    </ul>
    <?php $this->need('component/comments.php') ?>
    <script>$(".toc").remove();</script>
    <?php if($this->fields->showTOC=='1'):?>
    <script>
        var toc=`<div id="TOC" class="sider-item block-item toc sider-sticky">
        <span onclick="toggleSider(this);"><i class="fa fa-navicon"></i></span>
        <span style="right:40px" onclick="toggleFixTOC(this);">点击固定</span>
        <?php echo $parsed['toc']; ?></div>`;
        $("#widget-right").append(toc);
        $("#widget-right > :not(.toc)").addClass("sider-shrink");
    </script>
    <?php else: ?>
    <script>
        $("#widget-right > *").removeClass("sider-shrink");
    </script>
    <?php endif; ?>
    </div><!--END PJAX-->
<?php if(!Utils::isPJAX()): ?>
    <?php $this->need('component/sider-r.php'); ?>
    <?php if($this->fields->showTOC=='1' ):?>
    <div id="TOC" class="sider-item block-item toc sider-sticky TOC">
        <span onclick="toggleSider(this);"><i class="fa fa-navicon"></i></span>
        <span style="right:40px" onclick="toggleFixTOC(this);">点击固定</span>
        <?php echo $parsed['toc']; ?>
    </div><!--END TOC-->
    <script>$("#widget-right > :not(.toc)").addClass("sider-shrink");</script>
    <?php endif; ?>
    </div><!--END sider-r-->
    </div>
</div><!--END MAIN-->
<?php $this->need('component/footer.php') ?>
</body>
</html>
<?php endif; ?>