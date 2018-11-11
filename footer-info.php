<div id="ctrler" class="flex flex-direction-column align-items-end">
    <?php if($this->is('post') || $this->is('page')):?>
        <?php if(Utils::isPluginAvailable('Like')):?>
        <div>
            <a href="javascript:;" class="post-like" data-pid="<?php echo $this->cid;?>"><i class="fa fa-heart"></i><span class="like-num hidden"><?php Like_Plugin::theLike($link = false,$this);?></span></span></a>
        </div>
        <?php endif; ?>
        <div><a href="javascript:void(0)" target="_self" onclick="$.scrollTo(`#comments`,300)"><i class="fa fa-commenting-o"></i></a></div>
    <?php endif;?>
    <div><a href="javascript:void(0)" target="_self" onclick="$.scrollTo(`#header`,300)"><i class="fa fa-arrow-up"></i></a></div>
</div>

<div id="footer-info" style="font-size:0.9em;color:var(--text-color);background:none;text-align:center;line-height:1.5;margin-bottom:50px">
    <a href="<?php echo $this->options->siteUrl; ?>" target="_self">© <?php echo $this->options->title; ?></a><br>
    <a href="https://blog.imalan.cn/archives/163/" target="_blank">Theme RAW</a> made with <span class="heart"><i class="fa fa-heart"></i></span> By <a href="https://www.imalan.cn">熊猫小A</a><br>
    <a href="http://typecho.org/" targte="_blank">Powered By Typecho</a><br>
    <?php echo $this->options->footerinfo; ?>
</div>