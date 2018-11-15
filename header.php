<?php
/**
 * header.php
 * 
 * 导航栏
 * 
 * @author 熊猫小A
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<body class="flex flex-direction-column">
<header id="header">
    <nav class="flex justify-content-justify align-items-center">
        <div class="flex align-items-center">
            <a id="brand" href="/" target="_self"><?php echo $this->options->sitelogo? $this->options->sitelogo:$this->options->title; ?></a>
            <div class="nav-links flex justify-content-center align-items-center">
                <?php 
                    if($this->options->headernav&&$this->options->headernav!=''){
                        $navs=explode(PHP_EOL,$this->options->headernav);
                        foreach ($navs as $value) {
                            $value=str_replace("\r",'', $value);
                            $temp=explode(',',$value);
                            echo '<a onclick="$(`.nav-link`).removeClass(`current`);$(this).addClass(`current`);" class="nav-link flex justify-content-center align-items-center" href="'.$temp[2].'"><i class="fa fa-fw  fa-'.$temp[0].'"></i>'.$temp[1].'</a>';
                        }
                    }
                ?>
                <?php if($this->options->aside_nav): ?>
                <a data-fancybox data-src="#pages" href="javascript:;" class="show-xs nav-link flex justify-content-center align-items-center"><i class="fa fa-fw fa-th-large"></i>Pages</a>
                <?php endif; ?>
                <?php if($this->fields->showTOC=='1' && ($this->is('post') || $this->is('page'))):?>
                <a data-fancybox data-src="#TOC" href="javascript:;" class="show-md nav-link flex justify-content-center align-items-center"><i class="fa fa-fw fa-th-list"></i>TOC</a>
                <?php endif; ?>
            </div>
        </div>
        <div style="display: flex;flex-direction: row;align-items: center;justify-content: center;">
            <a href="javascript:void(0)" target="_self" class="nav-link" onclick="switchNightMode()"><i class="fa fa-lightbulb-o"></i></a>
            <a data-fancybox data-src="#search" href="javascript:;" class="nav-link"><i class="fa fa-search"></i></a>
            <a style="display: flex;" data-fancybox data-src="#hidden-login-form" href="javascript:;"><img style="width:35px;height:35px" class="avatar author-avatar" src="<?php 
            if($this->user->mail) echo Typecho_Common::gravatarUrl($this->user->mail, 100, '', '', true);
            elseif ($this->options->defaultavatar) echo $this->options->defaultavatar;
            else echo Typecho_Common::gravatarUrl(Utils::getAdminMail(), 100, '', '', true);
            ?>" /></a>
        </div>
    </nav>
</header>
<?php if($this->options->site_bg && $this->options->site_bg!=''):?>
<div class="bg" style="background-image:url(<?php echo $this->options->site_bg; ?>)"></div>
<?php else:?>
<div class="bg" style="background:#EBE9E4"></div>
<?php endif;?>
<div class="bg bg-mask"></div>

<div id="hidden-login-form" class="login-form" style="display:none">
    <?php if($this->user->hasLogin()): ?>
    <p style="margin-top:1.3em">您已经登录，<a href="<?php $this->options->logoutUrl(); ?>">登出</a></p>
    <?php else:?>
    <form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
        <p>是要登录吗？</p>
        <p>
            <input type="text" name="name" autocomplete="username" placeholder="请输入用户名" required/>
        </p>
        <p>
            <input type="password" name="password" autocomplete="current-password" placeholder="请输入密码" required/>
        </p>
        <button type="submit">登录</button>
        <input type="hidden" name="referer" value="<?php 
            if($this->is('index')) $this->options->siteUrl();
            else $this->permalink();
        ?>">
    </form>
    <?php endif; ?>
</div>

<div id="search" style="display:none">
    <p style="color:var(--text-color)">输入要搜索的内容</p>
    <input onkeydown="enterSearch();" type="text" name="search-content" id="search" class="text" required />
    <div style="margin:1em auto" id="search-buttons">
        <button style="color:var(--text-color)" id="btn-search" onclick="startSearch();">搜索</button>
    </div>
    <p style="margin: 0.2em auto;line-height:1.5;color:rgba(0,0,0,0.4);max-width:90%;text-align:center;color:var(--text-color)">点击「搜索」或者使用 Enter 键开始搜索</p>
</div>

<?php if($this->options->reward_img&&$this->options->reward_img!='') :?>
<div id="reward" style="display:none">
<div style="font-size:1.5rem;text-align:center;overflow:hidden;color:var(--text-color);margin-bottom:0.2em">给博主喂食</div>
<img style="max-width:100%" src="<?php echo $this->options->reward_img; ?>" />
</div>
</div>
<?php endif;?>