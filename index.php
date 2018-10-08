<?php
/**
 * Typecho-Theme-RAW，在互联网上寻找栖息之地
 * 
 * 介绍: <a href="https://blog.imalan.cn/archives/163/" target="_blank">https://blog.imalan.cn/archives/163/</a>
 * 
 * Repo: <a href="https://github.com/AlanDecode/Typecho-Theme-RAW" target="_blank">https://github.com/AlanDecode/Typecho-Theme-RAW</a>
 * 
 * @package Typecho-Theme-RAW 
 * @author 熊猫小A
 * @version 0.1
 * @link https://imalan.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php if(Utils::isPJAX()): ?> <!--PJAX-->
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php else: ?> <!--NO-PJAX-->
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
        <?php if($this->options->notice && $this->options->notice!=''):?>
        <div id="blog-notice" class="block-item">
        <i class="fa fa-volume-up"></i> <?php echo $this->options->notice; ?>
        </div>
        <?php endif; ?>
        <?php while($this->next()): ?>
            <?php
                $banner='';
                if($this->fields->type!='1' && $this->fields->bannerposition!='2' && $this->fields->banner){
                    $banner=$this->fields->banner;
                }
            ?>
            <div class="index-item block-item <?php if($banner!='') echo 'has-banner ';else echo 'banner-none'; if($this->fields->bannerposition == '1') echo 'banner-overlay';?> ">
                <?php if($banner!=''): ?>
                <div class="index-item-thumb" style="background-color:#202020">
                    <img style="display:none" class="banner" src="<?php echo $banner; ?>" onload="$(this).fadeIn(600);" />
                    <div class="banner mask"></div>
                </div>
                <?php endif; ?>   
                    <article class="<?php if(!$this->fields->banner) echo 'no-bn '; if($this->fields->type=='1') echo 'article-index' ?>">
                        <?php if($this->fields->type!='1'): ?>
                        <h2 class="index-item-title"><a href="<?php $this->permalink(); ?>"><?php if(Utils::isPluginAvailable('Sticky')) $this->sticky(); $this->title(); ?></a></h2>
                        <?php endif;?>
                        <?php Content::exportPostMeta($this,$this->fields->type=='1'); ?>
                        <?php if($this->fields->type != '1' && $this->fields->excerpt): ?>
                            <p class="index-item-excerpt">
                            <?php echo $this->fields->excerpt; ?>
                            </p>
                        <?php else: ?>
                            <?php if($this->fields->excerpt): ?>
                            <p class="excerpt"><?php echo $this->fields->excerpt; ?></p>
                            <?php endif;?>
                            <?php if($this->fields->type=='1'): ?>
                            <?php echo $this->content; ?>
                            <p><a class="go-comments" href="<?php $this->permalink(); ?>#comments"><i class="fa fa-comments"></i> Comments</a></p>
                            <?php endif;?>
                        <?php endif; ?>
                    </article>
            </div>
        <?php endwhile; ?>
        <?php $this->pageNav('<i class="fa fa-long-arrow-left"></i> 上一页', '下一页 <i class="fa fa-long-arrow-right"></i>', 0, '', 'wrapClass=page-navigator&prevClass=prev&nextClass=next'); ?>
        <script>$(".toc").remove();$("#widget-right > *").removeClass("sider-shrink");</script>
        </div><!--END PJAX-->
<?php if(!Utils::isPJAX()): ?> <!--PJAX-->
        <?php $this->need('component/sider-r.php'); ?></div><!--END sider-r-->
        </div>
    </div><!--END MAIN-->
    <?php $this->need('component/footer.php') ?>
    </body>
    </html>
<?php endif; ?>