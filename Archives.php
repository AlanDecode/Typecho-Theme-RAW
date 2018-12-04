<?php
/** 
 * Archives
 *
 * @package custom
 *  
 * @author      熊猫小A
 * @version     0.1
 * 
*/ 

if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>

<div id="main" class="flex flex-1">
    <div class="center flex-1">
        <!--post-item start-->
        <div id="post-list">
        <?php if(!$this->have()):?>
            <div class="post-item">
            <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>
            <div style="animation-delay:0.2s" class="post-item">
                <?php if($this->fields->banner && $this->fields->banner!='') :?>
                    <a data-fancybox="gallery" href="<?php echo $this->fields->banner; ?>"><img style="max-width:100%;width:100%" src="<?php echo $this->fields->banner; ?>"/></a>
                <?php endif; ?>
                <div class="post-item-body <?php if($this->fields->banner && $this->is('index')) echo 'pull-left'; if($this->is('index')&&($this->fields->indextype=='1')) echo ' featured';?> flex">
                    <article>
                    <h2 class="archive-title" style="border:none">标签云</h2>
                    <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=1&limit=30')->to($tags); ?>
                    <?php if($tags->have()): ?>
                        <ul class="tag-list">
                        <?php while ($tags->next()): ?>
                            <li style="text-indent:unset"><a href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 个话题"><?php $tags->name(); ?></a></li>
                        <?php endwhile; ?>
                        <?php else: ?>
                            <li><?php _e('还没有标签哦～'); ?></li>
                        <?php endif; ?>
                        </ul>
                    <h2 class="archive-title" style="border:none">文章归档</h2>
                    <!--start archive list-->
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);?>
                        <?php $yearlog=-1; $isfirst=true; ?>
                        <?php while($archives->next()): ?>
                            <?php
                                if($archives->fields->type=='1') continue;
                                $year=date('Y',$archives->created);
                                $month=date('m',$archives->created);
                                $day=date('d',$archives->created);
                                if($yearlog != $year){
                                    $yearlog=$year;
                                    if(!$isfirst) {
                                        echo '</ul>';
                                    }
                                    $isfirst=false;
                                    echo '<h2 class="year">'.$year.'</h2><ul class="archive-list">';
                                }
                            ?>
                            <li><span class="date" style="color:rgba(0,0,0,0.3);margin-right: 1em;"><span class="month"><?php echo $month;?></span> - <span class="day"><?php echo $day;?></span></span><span class="title"><a href="<?php echo $archives->permalink;?>"><?php $archives->title()?></a></span></li>
                        <?php endwhile;?> 
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