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
        <?php $this->need('component/aside.php') ?> 
<?php endif; ?>
    <div id="pjax-container">
    <?php $this->need('component/crumbs-patch.php'); ?>
    <article class="block-item" style="padding-top: 200px">
        <div class="post-header block-item">
            <div class="banner" style="background-color:#202020">
            <img data-action="none" style="display:none;" class="banner" src="<?php echo $this->fields->banner; ?>" onload="$(this).fadeIn(600);" />    
            <div class="banner mask" style="background:rgba(0,0,0,0.4)"></div>
            </div>
            <h1 class="blog-title"><?php $this->title(); ?></h1>
        </div>
        <?php echo Content::parseIMG(Content::parseBoard($this->content)); ?>
    </article>
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