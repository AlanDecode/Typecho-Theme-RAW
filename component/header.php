<?php
/** 
* header.php
* 
* 站点大图、顶部导航栏、搜索框、站点背景
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php 
    $banner=RAW::getRandomBanner($this->options->randombanner);
?>

<header id="header" <?php if(!$banner || $banner=='') echo 'style="height:40px"';?>>
    <div id="header-nav" class="header-nav-light <?php if($this->is('index')) echo 'index-nav'?>">
        <div class="header-nav-inner">
        <div class="header-nav-left">
        <a href="<?php echo Helper::options()->siteUrl; ?>"><i class="fa fa-fw fa-home"></i><span> 首页</span></a> 
        <?php 
            if($this->options->sitenav&&$this->options->sitenav!=''){
                $navs=explode(PHP_EOL,$this->options->sitenav);
                foreach ($navs as $value) {
                    $value=str_replace("\r",'', $value);
                    $temp=explode(',',$value);
                    echo '<a class="header-nav-name" href="'.$temp[2].'" target="'.$temp[3].'"><i class="fa fa-fw  fa-'.$temp[0].'"></i><span> '.$temp[1].'</span></a>';
                }
            }
        ?>
        <a href="/links.html" target="_self"><i class="fa fa-fw fa-link"></i><span> 友链</span></a>
        <a href="/about.html" target="_self"><i class="fa fa-fw fa-info-circle"></i><span> 关于</span></a>
        </div>
        <div class="header-nav-right">
            <a href="javascript:void(0);" onclick="toggleSearch()" ><i class="fa fa-fw fa-search"></i><span class="header-nav-name"> 搜索</span></a>
            <a href="javascript:void(0);" onclick="toggleMblNav()" id="tgl-mbl-nav"><i class="fa fa-fw fa-bars"></i><span> 更多</span></a>
        </div>
    </div>
    </div>   
    <?php if($banner && $banner!=''): ?>
    <div class="banner" style="background-color:#202020">
    <img style="display:none;" class="banner" src="<?php echo $banner; ?>" onload="$(this).fadeIn(600);" />    
    <div class="banner mask" style="background:rgba(0,0,0,0.4)"></div>
    <?php endif; ?>
    </div>
    <div class="site-title blog-title"><?php echo $this->options->indextitle; ?></div>
</header>
<div id="search-box" class="hide">
    <h1 style="margin-top:30vh">输入要搜索的内容</h1>
    <input onkeydown="entersearch();" type="text" name="search-content" id="search" class="text" required />
    <div style="margin:1em auto" id="search-buttons">
        <button id="btn-cancel-search" onclick="toggleSearch();">取消</button>
        <button id="btn-search" onclick="startSearch();">搜索</button>
    </div>
    <p style="margin: 0.2em auto;line-height:1.5;color:rgba(0,0,0,0.4);max-width:90%;text-align:center">您可以随时使用 Esc 键打开或者关闭这个面板</p>
    <p style="margin: 0.2em auto;line-height:1.5;color:rgba(0,0,0,0.4);max-width:90%;text-align:center">点击「搜索」或者使用 Enter 键开始搜索</p>
</div>
<?php if($this->options->bg && $this->options->bg!=''): ?>
<div class="site-bg" style="background-image:url(<?php echo $this->options->bg; ?>)"></div>
<div class="site-bg-mask"></div>
<?php endif ?>
<div class="noscroll"></div>
