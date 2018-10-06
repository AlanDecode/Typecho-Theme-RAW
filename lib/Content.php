<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

global $toc;
global $curid;

function parseTOC_callback($matchs){
    $GLOBALS['curid']=$GLOBALS['curid']+1;
    $GLOBALS['toc'].='<li><a href="#TOC-'.(string)$GLOBALS['curid'].'" class="toc-item toc-level-'.$matchs[1].'">'.$matchs[2].'</a></li>';
    return '<h'.$matchs[1].' id="TOC-'.(string)$GLOBALS['curid'].'">'.$matchs[2].'</h'.$matchs[1].'>';
}

class Content{
    static public function parseBoard($string){
        $reg='/\[(.*?)\]\((.*?)\)\+\((.*?)\)/s';
        $rp='<div class="board-item link-item"><div class="board-thumb" style="background-image:url(${3})"></div><div class="board-title"><a href="${2}" target="_blank">${1}</a></div></div>';
        $new=preg_replace($reg,$rp,$string);
        return $new;
    }

    static public function parseTOC($content){
        global $toc;
        $GLOBALS['curid']=0;
        $GLOBALS['toc']='<ul>';
        $new=preg_replace_callback('/<h([2-6]).*?>(.*?)<\/h.*?>/s', 'parseTOC_callback', $content);
        $GLOBALS['toc'].='</ul>';
        return array('content'=>$new,'toc'=>$toc);
    }

    static public function parseIMG($content){
        $new=preg_replace('/<p>(<img.*?>)/s', '<p class="img-grid">${1}', $content);
        return $new;
    }

    static public function title(Widget_Archive $archive){
        $archive->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - ');
        Helper::options()->title();
    }

    static public function exportHeader(Widget_Archive $archive,$img) {
        $html = '';
        $site=Helper::options()->title;
        $description='';
        $createTime = date('c', $archive->created);
        $modifyTime = date('c', $archive->modified);
        $link=$archive->permalink;
        $type='';
        if($archive->is("index")){
            $description=Helper::options()->description;
            $type='website';
        }
        elseif ($archive->is("post") || $archive->is("page")) {
            if($archive->fields->excerpt && $archive->fields->excerpt!=''){
                $description=$archive->fields->excerpt;
            }
            else{
                $description = Typecho_Common::subStr(strip_tags($archive->excerpt), 0, 100, "...");
            }
            $type='article';
        }

        echo '<meta name="description" content="';
        echo $description;
        echo '" />
        <meta property="og:title" content="';
        self::title($archive);
        $html = <<< EOF
" />
        <meta property="og:site_name" content="{$site}" />
        <meta property="og:type" content="{$type}" />
        <meta property="og:description" content="{$description}" />
        <meta property="og:url" content="{$link}" />
        <meta property="og:image" content="{$img}" />
        <meta property="article:published_time" content="{$createTime}" />
        <meta property="article:modified_time" content="{$modifyTime}" />
        <meta name="twitter:title" content="
EOF;
        echo $html;
        self::title($archive);
        $html = <<<EOF
" />
    <meta name="twitter:description" content="{$description}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{$img}" />
EOF;
        echo $html;
    }
    
    public static function exportPostMeta(Widget_Archive $archive,$detail=true){
        if($detail){
            $html='';
            $html.='<div class="post-meta"><div class="pm-avatar" style="background-image:url(';
            $html.=Typecho_Common::gravatarUrl($archive->author->mail, 100, '', '', true);
            $html.=')"></div><div class="pm-info"><div class="pm-autor-name"><author>';
            echo $html;
            $archive->author();
            echo '<author></div><div class="pm-meta"><i class="fa fa-calendar"></i><time>&nbsp;';
            $archive->date('F j, Y');
            echo '</time>';
            if(class_exists('TePostViews_Plugin')){
                echo '&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i>&nbsp;';
                $archive->viewsNum();
            }
            if(class_exists('Like_Plugin')){
                echo '&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-o-up post-like"></i>&nbsp;<span>';
                Like_Plugin::theLike($link = false,$archive);
            }
            echo '</div></div></div>';
        }
        else{
            echo '<p class="post-meta"><i class="fa fa-calendar"></i><time>&nbsp;';
            $archive->date('F j, Y');
            echo '</time>';
            if(class_exists('TePostViews_Plugin')){
                echo '&nbsp;&nbsp;&nbsp;<i class="fa fa-eye"></i>&nbsp;';
                $archive->viewsNum();
                echo ' <span style="display:none">View(s)</span>';
            }
            if(class_exists('Like_Plugin')){
                echo '&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-o-up post-like"></i>&nbsp;<span>';
                Like_Plugin::theLike($link = false,$archive);
                echo '</span> <span style="display:none">Like(s)</span>';
            }
            echo '</p>';
        }
    }

    public static function outputCommentJS(Widget_Archive $archive) {
        $header = "";       
        $header .= "<script type=\"text/javascript\">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('" . $archive->respondId . "'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('{$archive->respondId}'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>";
        echo $header;
    }
}