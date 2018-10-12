<?php
/** 
* head.php
* 
* 主题头部信息
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!--

  _____              __          __    ____   __     __               _                   _____                              _        
 |  __ \      /\     \ \        / /   |  _ \  \ \   / /       /\     | |                 |  __ \                            | |       
 | |__) |    /  \     \ \  /\  / /    | |_) |  \ \_/ /       /  \    | |   __ _   _ __   | |  | |   ___    ___    ___     __| |   ___ 
 |  _  /    / /\ \     \ \/  \/ /     |  _ <    \   /       / /\ \   | |  / _` | | '_ \  | |  | |  / _ \  / __|  / _ \   / _` |  / _ \
 | | \ \   / ____ \     \  /\  /      | |_) |    | |       / ____ \  | | | (_| | | | | | | |__| | |  __/ | (__  | (_) | | (_| | |  __/
 |_|  \_\ /_/    \_\     \/  \/       |____/     |_|      /_/    \_\ |_|  \__,_| |_| |_| |_____/   \___|  \___|  \___/   \__,_|  \___|
                                                                                                                                      
                                                                                                                                      
-->

<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php
    $img='';
    if($this->fields->banner) $img=$this->fields->banner;
    else $img=RAW::getRandomBanner($this->options->randombanner);
    ?>
    <?php Content::exportHeader($this,$img); ?>

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('commentReply=&description=&'); ?>   

    <!-- CSS -->
    <?php if($this->options->debugmode): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/fonts/font-awesome/4.7.0/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/hljs/styles/atom-one-dark.css');?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/owo/owo.min.css');?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/zoomjs/zoom.css');?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/css/RAW.css'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>">
    <?php else: ?>
    <link rel="stylesheet" href="<?php echo RAW::staticPath($this->options->CDNPath,'/fonts/font-awesome/4.7.0/css/font-awesome.min.css','','css');?>">
    <link rel="stylesheet" href="<?php echo RAW::staticPath($this->options->CDNPath,'/hljs/styles/atom-one-dark.css','','css');?>">
    <link rel="stylesheet" href="<?php echo RAW::staticPath($this->options->CDNPath,'/owo/owo.min.css','','css');?>">
    <link rel="stylesheet" href="<?php echo RAW::staticPath($this->options->CDNPath,'/zoomjs/zoom.css','','css');?>">
    <link rel="stylesheet" href="<?php echo RAW::staticPath($this->options->CDNPath,'/css/RAW.css','8D592532','css'); ?>">
    <?php endif; ?>
     
    <!-- JS -->
    <script src="<?php echo RAW::staticPath($this->options->CDNPath,'/jquery/jquery.min.js','','js');?>"></script>
    
    <?php echo $this->options->headinfo; ?>
    <?php if(Utils::isPluginAvailable('Like')):?>
    <script>var likePath="<?php Helper::options()->index('/action/like?up'); ?>";</script>
    <?php endif; ?>
    <script>
    var lastOffset;
    var lastOffset_aside;
    function toggleSider(item){
        if($(item).parent().hasClass("sider-shrink")){
            $(item).parent().removeClass("sider-shrink");
        }else{
            $(item).parent().addClass("sider-shrink");
        }
        if($("TOC").length) lastOffset=$("#TOC").offset().top;
    }
    function fixItem(item,fix){
        if(fix){
            $(item).css("top","50px");
            $(item).css("left",$(item).offset().left);
            $(item).addClass("toc-fixed");
        }else{
            $(item).removeClass("toc-fixed");
            $(item).css("top","unset");
            $(item).css("left","unset");
        }
    }
    function registerAside(){        
        lastOffset_aside=0;
        $(document).scroll(function(){
            if($("#music").length < 1) return;
            if(!lastOffset_aside){
                lastOffset_aside=$("#music").offset().top;
                return;
            }
            var top=$("#music").offset().top-$(document).scrollTop();
            if(top<=51 && $("#music").offset().top>=lastOffset_aside){
                fixItem("#music",true);
            }
            else{
                fixItem("#music",false);
                lastOffset_aside=$("#music").offset().top;
            } 
        })
    }
    function registerTOC(){        
        lastOffset=0;
        $(document).scroll(function(){
            if($("#TOC").length < 1) return;
            if(!lastOffset){
                lastOffset=$("#TOC").offset().top;
                return;
            }
            var top=$("#TOC").offset().top-$(document).scrollTop();
            if(top<=51 && $("#TOC").offset().top>=lastOffset){
                fixItem("#TOC",true);
            }
            else{
                fixItem("#TOC",false);
                lastOffset=$("#TOC").offset().top;
            } 
        })
    }
    </script>
</head>