<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="aside" <?php echo 'class="sider sider-l" data-siderbase="#main-content"'; ?>>
    <div id="aside-close-btn"><a href="javascript:void(0);" onclick="toggleMblNav()"><i class="fa fa-close"></i> 关闭</a></div>
    <div class="aside-inner block-item" style="width:100%;overflow-y:auto">
        <div id="author-info">
            <div class="author-bg"></div>
            <a href="/about.html"><div class="author-avatar" style="background-image:url(<?php echo Typecho_Common::gravatarUrl($this->author->mail, 200, '', '', true); ?>)"></div></a>
            <div class="author-name"><?php echo $this->author(); ?></div>
            <div class="author-links">
                <ul>
                <?php    
                $links=explode(PHP_EOL,$this->options->sociallinks);
                    foreach ($links as $value) {
                        $value=str_replace("\r",'', $value);
                        $temp=explode(',',$value);
                        echo '<li style="float:left"><span><a href="'.$temp[1].'" target="'.$temp[2].'"><i class="fa fa-fw fa-'.$temp[0].'"></i></a></span></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
        <div id="mbl-ctrler">
            <?php 
                $navs=explode(PHP_EOL,$this->options->sitenav);
                foreach ($navs as $value) {
                    $value=str_replace("\r",'', $value);
                    $temp=explode(',',$value);
                    echo '<a href="'.$temp[2].'" target="'.$temp[3].'"><i class="fa fa-fw  fa-'.$temp[0].'"></i> '.$temp[1].'</a>';
                }
            ?>
            <a href="#header" style="margin-top:20px"><i class="fa fa-angle-up"></i> 回到顶部</a>
            <a href="#footer" style="margin-bottom:20px"><i class="fa fa-angle-down"></i> 跳至底部</a>
        </div>
    </div>
    <div id="uptime" class="block-item sider-item"></div>
    <?php if(class_exists('Meting_Plugin')): ?>
    <div id="music" class="block-item">
        <div class="aplayer no-destroy" data-listmaxheight="250px" data-id="39875562" data-server="netease" data-type="playlist"></div>
    </div>
    <?php endif; ?>
</div>
<div id="loading">Loading...<br>ヾ(≧∇≦*)ゝ</div>
<script>
setInterval(function(){
	var start_timestamp = 1498708800000;
	var times = new Date().getTime() - new Date(start_timestamp).getTime();
    times = Math.floor(times/1000); // convert total milliseconds into total seconds
    var days = Math.floor( times/(60*60*24) ); //separate days
    times %= 60*60*24; //subtract entire days
    var hours = Math.floor( times/(60*60) ); //separate hours
    times %= 60*60; //subtract entire hours
    var minutes = Math.floor( times/60 ); //separate minutes
    times %= 60; //subtract entire minutes
    var seconds = Math.floor( times/1 ); // remainder is seconds
    $("#uptime").html(days + " 天 " + hours + " 小时 " + minutes + " 分 " + seconds + " 秒 ");
}, 1000);
</script>