<?php
/** 
 * Words
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
        <!--post-item start-->
        <?php if(!$this->have()):?>
            <div class="post-item">
                <div class="post-item-body" style="padding-top:0.001em"><h1 style="text-align:center;margin-top:40px;color:var(--text-color)">糟糕，是 404 的感觉</h1></div>
            </div>
            <div class="post-item">
                <div class="post-item-body" style="padding-top:1em;text-align:center"><b><a href="/">返回首页</a></b></div>
            </div>
        <?php else:?>
            <div class="post-item item-nav">
                <div class="post-item-body flex justify-content-justify align-items-center" style="padding:0">
                <b style="color:var(--text-color);display:block;padding:1em">说说</b>
                <div class="index-filter flex justify-content-justify align-items-center">
                    <div onclick="filterItems(this,`<?php Helper::options()->index("/"); ?>`);">日志</div>
                    <div class="current" onclick="filterItems(this,`<?php 
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
            <!-- display all comments as shuoshuo -->
            <?php if($this->user->hasLogin()): ?>
                <div class="post-item shuoshuo" style="position:relative;z-index:1">
                    <div class="post-item-header flex align-items-center" style="padding-left:0">
                        <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                        <div style="font-size: 14px; line-height: 1.5;overflow:hidden" class="post-meta flex flex-direction-column">
                            <span><b><?php echo $this->author->screenName; ?></b> 发表新的说说</span>
                            <span style="white-space:nowrap;text-overflow:ellipsis;overflow:hidden"><?php echo '<i class="fa fa-calendar"></i>&nbsp;'.Utils::formatDate($this->created,'NATURAL'); ?></span>
                        </div>
                    </div>
                    <div class="post-item-body flex s" style="border-radius:8px;padding-bottom:0;margin-left: 56px;min-width: unset;">
                        <div id="comments" style="background: none;padding: 0;margin: 0;width: 100%;">
                            <?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>
                            <div id="<?php $this->respondId(); ?>" class="respond">
                                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
                                    <p id="logged-in" data-name="<?php $this->user->screenName(); ?>" data-url="<?php $this->user->url(); ?>" data-email="<?php $this->user->mail(); ?>" ><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a no-pjax href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                                    <p style="margin-top:0">
                                        <textarea class="input-area" rows="5" name="text" id="textarea" placeholder="说点什么吧" style="resize:none;"><?php $this->remember('text'); ?></textarea>
                                    </p>
                                    <p class="comment-buttons" style="margin-top: 32px">
                                        <span class="OwO"></span>
                                        <button id="comment-submit-button" type="submit" class="submit"><?php _e('发表说说'); ?></button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            
            <?php 
                $index=0; 
                $parameter = array(
                    'parentId'      => $this->hidden ? 0 : $this->cid,
                    'parentContent' => $this->row,
                    'respondId'     => $this->respondId,
                    'commentPage'   => $this->request->filter('int')->commentPage,
                    'allowComment'  => true
                );
                $this->widget('RAW_Widget_Comments_Archive', $parameter)->to($comments);
            ?>
            <?php while($comments->next()): ?>
                <?php $index++; ?>
                <div style="animation-delay:<?php echo 0.2*$index; ?>s" class="post-item shuoshuo">
                    <div class="post-item-header flex align-items-center" style="padding-left:0">
                        <img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->author->mail, 100, '', '', true)?>" />
                        <div style="font-size: 14px; line-height: 1.5;overflow:hidden" class="post-meta flex flex-direction-column">
                            <span><b><?php echo $this->author->screenName; ?></b> 发表了一篇说说</span>
                            <span style="white-space:nowrap;text-overflow:ellipsis;overflow:hidden"><?php echo '<i class="fa fa-calendar"></i>&nbsp;'.Utils::formatDate($this->created,'NATURAL'); ?></span>
                        </div>
                    </div>
                    <div class="post-item-body flex s" style="border-radius:8px;padding-bottom:0;margin-left: 56px;min-width: unset;">
                        <article class="yue">
                            <?php echo Utils::parseAll($comments->content); ?>
                        </article>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php $comments->pageNav('<i class="fa fa-hand-o-left"></i>', '<i class="fa fa-hand-o-right"></i>',1, '...'); ?>

            <style>
            .post-item-body{position:relative;}
            .post-item-body.s::after{
                content: "";
                position: absolute;
                width: 2px;
                height: calc(100% + 1rem);
                background: rgba(255,255,255,0.5);
                left: -34px;
            }
            </style>
        </div>
        <?php endif; ?>
        <!--post-item end-->
        <?php $this->need('footer-info.php'); ?>
    </div>
    <?php if($this->options->bloglayout!='1'):?>
        <?php $this->need('aside.php'); ?>
    <?php endif;?>
</div>
<?php $this->need('footer.php'); ?>