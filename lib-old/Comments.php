<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * comments.php
 * 
 * 自定义评论输出
 * 
 */

function threadedComments($comments,$singleCommentOptions){
?>
<div class="comment-wrap">
    <div id="<?php $comments->theId(); ?>" class="
<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
    } else {
        echo ' comment-parent';
    }
?>">
    <div class="flex comment-item 
<?php
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    if ($comments->levels > 0) {
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">
        <div class="comment-header flex flex-direction-column">
            <?php $comments->gravatar(50, ''); ?></a>
            <span><?php $comments->reply('<i class="fa fa-reply"></i> 回复'); ?></span>
        </div>
        <div class="comment-body flex flex-direction-column">
            <span class="comment-meta"><?php Utils::exportCommentMeta($comments);?></span>
            <div class="comment-content"><?php echo getParent($comments); echo Utils::parseBiaoQing($comments->content); ?></div>
        </div>
    </div>
    </div>
    <?php if ($comments->children) { ?>
    <?php $comments->threadedComments(); ?>
    <?php } ?>
</div>
<?php
 }

function getParent($comments){
    $db = Typecho_Db::get();
    $parentID = $db->fetchRow($db->select()->from('table.comments')->where('coid = ?', $comments->coid))['parent'];
    if($parentID=='0') return '';
    else return '<b style="font-size:0.85rem">@'.$db->fetchRow($db->select()->from('table.comments')->where('coid = ?', $parentID))['author'].'</b> ';
}  
