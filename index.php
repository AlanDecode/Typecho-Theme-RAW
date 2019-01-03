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
 * @version 0.94
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
        <?php if(!$this->have()):?>
            <div class="post-item">
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>
            <div class="post-item item-nav">
                <div class="post-item-body flex justify-content-justify align-items-center" style="padding:0">
                <b style="color:var(--text-color);display:block;padding:1em">
                    <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
                        最近文章
                        <?php if($this->options->indexloadmore=='1'): ?>
                        • 第&nbsp;<?php echo $this->_currentPage; ?>&nbsp;页
                        <?php endif;?>
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
                    <div class="current" onclick="filterItems(this,`<?php Helper::options()->index("/"); ?>`);">日志</div>
                    <div onclick="filterItems(this,`<?php 
                    // find the first page that uses Words template
                    $db = Typecho_Db::get();
                    $row = $db->fetchRow($db->select()->from('table.contents')->where('template = ?', 'Words.php'));
                    if(count($row)){
                        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($row);
                        echo $val['permalink'];
                    }else{
                        Helper::options()->index("/");
                    }
                    ?>`);">说说</div>
                </div>
                </div>
            </div>
            <div id="post-list">
            <?php $index=0;  ?>
            <?php while($this->next()): ?>
                <?php $index++;?>
                <?php if($this->fields->type=='1'): ?> <!--说说-->
                    <div style="animation-delay:<?php echo 0.2*$index; ?>s" class="post-item shuoshuo">
                        <div class="post-item-header flex align-items-center">
                            <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                            <div style="font-size: 14px; line-height: 1.5;overflow:hidden" class="post-meta flex flex-direction-column">
                                <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇短文</span>
                                <span style="white-space:nowrap;text-overflow:ellipsis;overflow:hidden"><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                            </div>
                        </div>
                        <div class="post-item-body flex">
                            <article class="yue">
                                <?php echo Utils::parseAll($this->content); ?>
                            </article>
                        </div>
                        <div class="post-item-footer">
                            <span><i class="fa fa-calendar"></i> <?php echo Utils::formatDate($this->created,'Y-m-d')?></span>
                            <span><a target="_self" href="<?php $this->permalink() ?>#comments"><i class="fa fa-commenting-o"></i> <?php echo $this->commentsNum; ?><span class="hidden-xs">条评论</span></a></span>
                            <?php if(Utils::isPluginAvailable('Like')):?>
                                <span style="float:right" class="like-button"><a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                                    <i class="fa fa-heart"></i> LIKE <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                                </a></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="post-item full" style="animation-delay:<?php echo 0.2*$index; ?>s;padding:1rem;">
                        <div class="post-item-content-wrap<?php if($this->fields->banner || $this->options->indexbanner!='') echo ' has-banner';?>">
                            <?php if($this->fields->banner): ?>
                            <img class="post-item-banner" src="<?php echo $this->fields->banner;?>"/>
                            <?php elseif($this->options->indexbanner!=''): ?>
                            <?php 
                                $imgs=explode(PHP_EOL,$this->options->indexbanner);
                                echo '<img class="post-item-banner" src="'.$imgs[array_rand($imgs,1)].'?'.rand().'"/>';
                            ?>
                            <?php endif;?>
                            <div class="post-item-content">
                                <h1><a href="<?php $this->permalink(); ?>"><?php if(Utils::isPluginAvailable('Sticky')) $this->sticky(); $this->title();?></a></h1>
                                <p><?php $this->excerpt(80); ?></p>
                            </div>
                        </div>
                        <div class="post-item-meta">
                            <span><i class="fa fa-calendar"></i> <?php echo Utils::formatDate($this->created,'Y-m-d')?></span>
                            <span><a target="_self" href="<?php $this->permalink() ?>#comments"><i class="fa fa-commenting-o"></i> <?php echo $this->commentsNum; ?><span class="hidden-xs">条评论</span></a></span>
                            <?php if(Utils::isPluginAvailable('TePostViews')):?> 
                            <span><i class="fa fa-eye"></i> <?php $this->viewsNum();?><span class="hidden-xs">次阅读</span></span>
                            <?php endif;?>
                            <?php if(Utils::isPluginAvailable('Like')):?>
                            <span class="like-button" style="float:right"><a style="color:var(--highlight-fade-color)" href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>">
                                <i class="fa fa-heart"></i> LIKE <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                            </a></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif;?>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
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
    <?php if($this->options->bloglayout!='1'):?>
        <?php $this->need('aside.php'); ?>
    <?php endif;?>
</div>
<?php $this->need('footer.php'); ?>