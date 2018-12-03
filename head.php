<?php
/** 
* head.php
* 
* 主题头部信息
* 
* @author      熊猫小A
* @version     0.1
* 
*/ 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!DOCTYPE HTML>
<html class="<?php
if($this->options->colormode=='1') echo 'night n-f';
elseif ($this->options->colormode=='2') echo 'day d-f';
else{
    echo($_COOKIE['night'] == '1' ? 'night auto' : 'auto');
}; 
?>"> <!--start html-->
<head> <!--start head-->
<meta charset="<?php $this->options->charset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="HandheldFriendly" content="true">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php 
$banner=$this->fields->banner ? $this->fields->banner : '' ;
Utils::exportHeader($this,$banner);
?>

<?php echo $this->options->headinfo; ?>

<?php $this->header('commentReply=&description=&'); ?>

<!--CSS-->
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/fonts/font-awesome/4.7.0/css/font-awesome.min.css'); ?>" />
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/owo/owo.min.css'); ?>" />
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/hljs/styles/atom-one-light.css');?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/fancybox/jquery.fancybox.min.css');?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/main.40.css');?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/scheme-dark13.css');?>">
<?php if($this->options->columnorder=='1'):?>
<style>
aside{
    order:-1;
}
#nav-left{
    order:1;
}
</style>
<?php endif;?>
<?php if(!Utils::haveAside($this,$this->user->hasLogin())):?>
<style>
html {
    --main-width: 1012px;
}
.center{
    <?php if($this->options->columnorder=='1'):?>
    margin-left:0;
    <?php else: ?>
    margin-right:0;
    <?php endif;?>
}
</style>
<?php endif;?>
<!--JS-->
<script src="<?php $this->options->themeUrl('/assets/jquery/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/scrollTo/jquery.scrollTo.min.js'); ?>"></script>
<?php if(Utils::isPluginAvailable('Like')):?>
<script>var likePath="<?php Helper::options()->index('/action/like?up'); ?>";</script>
<?php endif; ?>
<script>
function startSearch(usePjax=false) {
    var c = $("#search input").val();
    if(!c||c==""){
        $("#search-box input").attr("placeholder","你还没有输入任何信息");
        return;
    }
    var t="/search/"+c;
    if(usePjax){
        $.pjax({url: t, 
            container: '#main',
            fragment: '#main',
            timeout: 8000, })
    }else{
        window.open(t,"_self");
    }
}

function enterSearch(){
    var event = window.event || arguments.callee.caller.arguments[0];  
    if (event.keyCode == 13)  {  
        startSearch(<?php if($this->options->pjax=='1') echo 'true'; ?>);
    }
}
</script>
<?php echo $this->options->customhead; ?>
</head> <!--end head-->