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
    <?php $this->need('nav-left.php'); ?>
    <div class="center flex-1">
        <div id="post-list">
        <?php if(!$this->have()):?>
            <div class="post-item full">
                <div class="post-item-body"><h1 style="text-align:center;margin-top:40px">糟糕，是 404 的感觉</h1></div>
            </div>
        <?php else:?>
            <div class="post-item">
                <div class="post-item-header flex align-items-center">
                    <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                    <div style="font-size: 0.9rem; line-height: 1.5;" class="post-meta flex flex-direction-column">
                        <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇<?php if($this->fields->type=='1') echo '说说'; else echo '文章'; ?></span>
                        <span><?php Utils::exportPostMeta($this,$this->fields->type); ?></span>
                    </div>
                </div>
                <div class="post-item-body flex">
                    <article>
                    <h1><?php $this->title();?></h1>
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
                            <i class="fa fa-heart"></i> Like <span class="like-num"><?php Like_Plugin::theLike($link = false,$this);?></span>
                        </a></span>
                    <?php endif; ?>
                    <span class="comments-num"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('Comments <span>%d</span>'); ?></a></span>
                </div>
            </div>
        <?php endif; ?>
        </div>
        <div class="post-item">
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
    <?php if($this->options->showaside=='0'||($this->options->showaside=='2'&&$this->user->hasLogin())):?>
        <?php $this->need('aside.php'); ?>
    <?php endif;?>
</div>
<?php $this->need('footer.php'); ?>
<style>
.post-item-body h1, .post-item-body p {
    padding-right: 0;
}
</style>