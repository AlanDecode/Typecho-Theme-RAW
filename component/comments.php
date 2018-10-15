<?php
/** 
* comments.php
* 
* 评论列表与评论嵌套
* 
* @author      Hran | 熊猫小A
* @version     0.1
* 
*/ 
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<script>
var commentModText="<?php
if(Helper::options()->commentsRequireModeration) echo '评论成功，请等待审核。';
elseif(Helper::options()->commentsWhitelist) echo '评论成功，第一次评论需等待审核。';
else echo '评论成功！';
?>";
var commentsRequireMail=<?php echo Helper::options()->commentsRequireMail; ?>;
var commentsRequireURL=<?php echo Helper::options()->commentsRequireURL; ?>;
</script>
<style>
#desktop-ctrler a.go-comments{
    display: block;
}
</style>
<div id="comments">
        <?php
        $parameter = array(
            'parentId'      => $this->hidden ? 0 : $this->cid,
            'parentContent' => $this->row,
            'respondId'     => $this->respondId,
            'commentPage'   => $this->request->filter('int')->commentPage,
            'allowComment'  => $this->allow('comment')
        );

        $this->widget('Mirages_Widget_Comments_Archive', $parameter)->to($comments);
        ?>
        <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <h3 id="response" class="widget-title text-left">添加新评论</h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
                <?php if($this->user->hasLogin()): ?>
                <p id="logged-in" data-name="<?php $this->user->screenName(); ?>" data-url="<?php $this->user->url(); ?>" data-email="<?php $this->user->mail(); ?>" ><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a no-pjax="1" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                <?php else: ?>
                    <div class="comment-info-input">
                    <input type="text" name="author" id="author" placeholder="称呼(必填)" value="<?php $this->remember('author'); ?>" />
                    <input type="email" name="mail" id="mail" placeholder="电子邮件<?php echo Helper::options()->commentsRequireMail? '(必填，将保密)' : '(选填)' ?>" value="<?php $this->remember('mail'); ?>" />
                    <input type="url" name="url" id="url" placeholder="网站<?php echo Helper::options()->commentsRequireURL? '(必填)' : '(选填)' ?>"  value="<?php $this->remember('url'); ?>" />
                    </div>
                <?php endif; ?>
                <p>
                    <textarea class="input-area" rows="5" name="text" id="textarea" placeholder="在这里输入你的评论..." style="resize:none;"><?php $this->remember('text'); ?></textarea>
                </p>
                <p class="comment-buttons" style="margin-top: 10px">
                    <span class="OwO"></span>
                    <span class="comment-mail-me">
                        <input name="receiveMail" type="checkbox" value="yes" id="receiveMail" checked />
                        <label for="receiveMail"><strong>接收</strong>邮件通知</label>
                    </span>
                </p>
                <button id="comment-submit-button" type="submit" class="submit"><?php _e('提交评论'); ?></button>
            </form>
        </div>
        <?php else: ?>
            <div class="comment-closed">
                <p>该页面评论已关闭</p>
            </div>
        <?php endif;?>
        <?php if ($comments->have()): ?>
            <h3 class="comment-separator">
                <div class="comment-tab-current">
                    <span class="comment-num"><?php $this->commentsNum(_t('评论列表'), _t('已有 1 条评论'), _t('已有 %d 条评论')); ?></span>
                </div>
            </h3>
            <?php $comments->listComments(array('avatarSize' => 100, 'defaultAvatar' => '', 'replyWord' => '回复')); ?>
            <?php //$comments->pageNav('&laquo;', '&raquo;', 1); ?>
            <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
        <?php endif; ?>
    </div>

<?php if($this->options->debugmode):?>
<script src="<?php $this->options->themeUrl('/assets/owo/owo.min.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<?php else:?>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/owo/owo.min.js','','js'); ?>"></script>
<?php endif; ?>
<?php if($this->allow('comment')): ?>
<script>
var owo = new OwO({
    logo: 'OωO表情',
    container: document.getElementsByClassName('OwO')[0],
    target: document.getElementsByClassName('input-area')[0],
    api: '/usr/themes/RAW/assets/owo/OwO.json?v=0.3',
    position: 'down',
    width: '400px',
    maxHeight: '250px'
});
</script>
<?php Content::outputCommentJS($this); ?>
<?php endif; ?>  