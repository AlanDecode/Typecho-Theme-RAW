
<?php
/** 
* Utils.php
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

global $toc;
global $curid;
global $nboard;
function parseTOC_callback($matchs){
    $GLOBALS['curid']=$GLOBALS['curid']+1;
    $GLOBALS['toc'].='<li><a href="#TOC-'.(string)$GLOBALS['curid'].'" onclick="$.scrollTo(`#TOC-'.(string)$GLOBALS['curid'].'`,300);$(`button[data-fancybox-close]`).click()" class="toc-item toc-level-'.$matchs[1].'">'.$matchs[2].'</a></li>';
    return '<h'.$matchs[1].' id="TOC-'.(string)$GLOBALS['curid'].'">'.$matchs[2].'</h'.$matchs[1].'>';
}
function parseBoard_callback($matchs){
    $GLOBALS['nboard']++;
    return '<a target="_blank" href="'.$matchs[2].'" style="animation-delay:'.strval($GLOBALS['nboard']*0.15).'s" class="board-item link-item"><div class="board-thumb" style="background-image:url('.$matchs[3].')"></div><div class="board-title">'.$matchs[1].'</div></a>';
}

class Utils {   
    /**
     * 获取第一管理员名称
     */
    public static function getAdminScreenName(){
        $db = Typecho_Db::get();
        $name = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1))['screenName'];
        return $name;
    }

    /**
     * 获取第一管理员邮箱
     */
    public static function getAdminMail(){
        $db = Typecho_Db::get();
        $mail = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1))['mail'];
        return $mail;
    }

    /**
     * 布局
     */
    public static function haveAside($archive,$login){
        if(Helper::options()->showaside=='1') return false;
        if(Helper::options()->showaside=='2'&&!$login) return false;
        return true;
    }

    public static function tocPosition($archive,$login){
        if((!$archive->is('post')&&!$archive->is('page'))||$archive->fields->showTOC!='1') return false;
        if(self::haveAside($archive,$login)) return 'aside';
        else return 'nav-left';
    }

    public static function asidePosition($archive){
        /**
         * 0：right
         * 1: left
         */
        if(Helper::options()->columnorder=='1') return 1;
        else return 0;
    }

    /**
     * 文章上一篇
     */
    public static function thePrev($archive){
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created < ?', $archive->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $archive->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1));

        if ($content) {
            $content = $archive->filter($content);
            echo '<div class="post-pager-item post-pager-prev" data-title="'.$content['title'].'"><a href="'.$content['permalink'].'"><i class="fa fa-hand-o-left"></i> 上一篇</a></div>';
        } else {
            echo '<div class="post-pager-item post-pager-prev" data-title="真的没有啦！"><span>没有啦~</span></div>';
        }

    }

    /**
     * 文章下一篇
     */
    public static function theNext($archive){
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')->where('table.contents.created > ? AND table.contents.created < ?',
            $archive->created, Helper::options()->gmtTime)
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.type = ?', $archive->type)
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', Typecho_Db::SORT_ASC)
            ->limit(1));

        if ($content) {
            $content = $archive->filter($content);
            echo '<div class="post-pager-item post-pager-next" data-title="'.$content['title'].'"><a href="'.$content['permalink'].'">下一篇 <i class="fa fa-hand-o-right"></i></a></div>';
        } else {
            echo '<div class="post-pager-item post-pager-next" data-title="真的没有啦！"><span>没有啦~</span></div>';
        }
    }
    
    /**
     * 编辑界面添加Button
     */
    public static function addButton(){
        echo '<script src="/usr/themes/RAW/assets/owo/owo_custom.js"></script>';
        echo '<script type="text/javascript" src="/usr/themes/RAW/assets/editor01.js"></script>';
        echo '<link rel="stylesheet" href="/usr/themes/RAW/assets/owo/owo.min.css" />';
        echo '<style>#custom-field textarea{width:100%}
        .OwO span{background:none!important;width:unset!important;height:unset!important}
        .OwO .OwO-logo{
            z-index: unset!important;
        }
        .comment-mail-me{
            display:inline;
            text-align:right;
            margin-right: 1.3em;
            z-index: 2;
        }  
        .OwO .OwO-body .OwO-items{
            -webkit-overflow-scrolling: touch;
            overflow-x: hidden;
        }
        .OwO .OwO-body .OwO-items-image .OwO-item{
            max-width:-moz-calc(20% - 10px);
            max-width:-webkit-calc(20% - 10px);
            max-width:calc(20% - 10px)
        }
        @media screen and (max-width:767px){	
            .comment-info-input{flex-direction:column;}
            .comment-info-input input{max-width:100%;margin-top:5px}
            #comments .comment-author .avatar{
                width: 2.5rem;
                height: 2.5rem;
            }
        }
        @media screen and (max-width:760px){
            .OwO .OwO-body .OwO-items-image .OwO-item{
                max-width:-moz-calc(25% - 10px);
                max-width:-webkit-calc(25% - 10px);
                max-width:calc(25% - 10px)
            }
        }</style>';
    }

    /**
     * 输出算术验证码
     */
    public static function antiSpam(){
        $num1=rand(1,49);
        $num2=rand(1,49);
        echo '<input type="text" name="dalabengba" value="" placeholder="'.$num1.' + '.$num2. ' = ?" />';
        echo '<input type="hidden" name="benborba" value="'.$num1.'" />';
        echo '<input type="hidden" name="baborben" value="'.$num2.'" />';
    }

    /**
     * 算术验证码检查
     */
    public static function filterComments($comment, $post){
        if($_POST['dalabengba']!=$_POST['benborba']+$_POST['baborben']){
            throw new Typecho_Widget_Exception(_t('好像验证码算错了哦…… <a href="javascript:history.back(-1)">再来一次</a>吧！','评论失败'));
        }
        return $comment;
    }

    /**
     * 随机文章
     */
    function getRandomPosts($limit = 10){    
        $db = Typecho_Db::get();
        $result = $db->fetchAll($db->select()->from('table.contents')
            ->where('status = ?','publish')
            ->where('type = ?', 'post')
            ->where('created <= unix_timestamp(now())', 'post')
            ->limit($limit)
            ->order('RAND()')
        );
        if($result){
            $i=1;
            foreach($result as $val){
                if($i<=3){
                    $var = ' class="red"';
                }else{
                    $var = '';
                }
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
                $post_title = htmlspecialchars($val['title']);
                $permalink = $val['permalink'];
                echo '<span><a href="'.$permalink.'" title="'.$post_title.'" target="_blank">'.$post_title.'</a></span>';
                $i++;
            }
        }
    }

    /**
     * 导出评论 meta
     */
    static public function exportCommentMeta($comment){
        echo '<i class="fa fa-user-o"></i>&nbsp<b>';
        $comment->author();
        echo  '</b> • <i class="fa fa-clock-o"></i>&nbsp'.self::formatDate($comment->created,'NATURAL');
        echo ' • '.self::getBrowser($comment->agent).' | '.self::getOS($comment->agent);
    }

    /**
    * 浏览器及操作系统判断
    *
    * @param string $agent 系统数据库中访者数据
    */

    /** 获取浏览器信息 */
    static public function getBrowser($agent)
    {
        if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
            $outputer = '<i class="fa fa-internet-explorer"></i>';
        } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
            $outputer = '<i class="fa fa-firefox"></i>';
        } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
            $outputer = '<i class="fa fa-chrome"></i>';
        } else if (preg_match('/QQBrowser\/([^\s]+)/i', $agent, $regs)) {
            $regg = explode("/",$regs[1]);
            $outputer = '<i class="fa fa-qq"></i>';
        } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
            $outputer = '<i class="fa fa-safari"></i>';
        } else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
            $outputer = '<i class="fa fa-opera"></i>';
        } else {
            $outputer = '<i class="fa fa-question"></i>';
        }

        return $outputer;
    }

    /** 获取操作系统信息 */
    static public function getOS($agent)
    {
        $os = false;

        if (preg_match('/win/i', $agent)) {
            $os = '<i class="fa fa-windows"></i>';
        } else if (preg_match('/android/i', $agent)) {
            $os = '<i class="fa fa-android"></i>';
        } else if (preg_match('/linux/i', $agent)) {
            $os = '<i class="fa fa-linux"></i>';
        } else if (preg_match('/mac/i', $agent)) {
            $os = '<i class="fa fa-apple"></i>';
        } else if (preg_match('/iphone/i', $agent)) {
            $os = '<i class="fa fa-apple"></i>';
        } else if (preg_match('/ipad/i', $agent)) {
            $os = '<i class="fa fa-apple"></i>';
        } else {
            $os = '<i class="fa fa-laptop"></i>';
        }

        return $os;
    }

    /**
     * 解析器
     * 
     * 用以解析图片集、高亮、ruby
     * 
     * @param string    $content
     */
    static public function parseAll($content,$parseBoard=false){
        $new  = self::parsePhotoSet(self::parseBiaoQing(self::parseFancyBox(self::parseRuby($content))));
        if($parseBoard){
            return self::parseBoard($new);
        }
        else{
            return $new;
        }
    }

    /**
     * 解析照片集
     *
     */
    static public function parsePhotoSet($content){
        $reg='/\[photos.*?des="(.*?)"\](.*?)\[\/photos\]/s';
        $rp='<div class="photos" data-des="${1}">${2}</div>';
        $new=preg_replace($reg,$rp,$content);
        return $new;
    }

    /**
     * 解析表情
     * 
     * 文章与评论可用
     */
    static public function parseBiaoQing($content){
        $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
            array('Utils', 'parsePaopaoBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
            array('Utils', 'parseAruBiaoqingCallback'), $content);

        return $content;
    }

    /**
     * 泡泡表情回调函数
     */
    private static function parsePaopaoBiaoqingCallback($match){
        return '<img class="biaoqing" src="/usr/themes/RAW/assets/owo/biaoqing/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

    /**
     * 阿鲁表情回调函数
     */
    private static function parseAruBiaoqingCallback($match){
        return '<img class="biaoqing" src="/usr/themes/RAW/assets/owo/biaoqing/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }
    
    
    /**
     * 解析目录
     * 
     * @return array
     * 
     */
    static public function parseTOC($content){
        global $toc;
        $GLOBALS['curid']=0;
        $GLOBALS['toc']='<ul id="toc-ul">';
        $new=preg_replace_callback('/<h([2-6]).*?>(.*?)<\/h.*?>/s', 'parseTOC_callback', $content);
        $GLOBALS['toc'].='</ul>';
        return array('content'=>$new,'toc'=>$toc);
    }

    /**
     * 解析 fancybox
     * 
     * @return string
     */
    static public function parseFancyBox($content){
        $reg='/<img(.*?)src="(.*?)"(.*?)>/s';
        $rp='<a data-fancybox="gallery" href="${2}"><img${1}src="${2}"${3}></a>';
        $new=preg_replace($reg,$rp,$content);
        return $new;
    }

    /**
     * 解析友情链接
     * 
     * @return string
     */
    static public function parseBoard($string){
        global $nboard;
        $GLOBALS['nboard']=0;
        $reg='/\[(.*?)\]\((.*?)\)\+\((.*?)\)/s';
        $new=preg_replace_callback($reg, 'parseBoard_callback', $string);

       // $rp='<a target="_blank" href="${2}" class="board-item link-item"><div class="board-thumb" style="background-image:url(${3})"></div><div class="board-title">${1}</div></a>';
       // $new=preg_replace($reg,$rp,$string);
        return $new;
    }



    /**
     * 解析 ruby
     * 
     * @return string
     * 
     */
    static public function parseRuby($string){
        $reg='/\{\{(.*?):(.*?)\}\}/s';
        $rp='<ruby>${1}<rp>(</rp><rt>${2}</rt><rp>)</rp></ruby>';
        $new=preg_replace($reg,$rp,$string);
        return $new;
    }

    
    /**
     * 随机banner
     * 
     * @return string
     */
    static public function randomBanner($list){
        if(!$list || $list == ''){
            return 'https://cdn.imalan.cn/img/site/IMG_1676.JPG';
        }
        $banners=explode(PHP_EOL,$list);
        $url=$banners[array_rand($banners)];
        $url=str_replace('\r','', $url);
        return $url;
    }

    /**
     * 导出标题
     * 
     * @return void
     */
    static public function title(Widget_Archive $archive){
        $archive->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - ');
        Helper::options()->title();
    }

    public static function formatDate($time, $format) {
        if (strtoupper($format) == 'NATURAL') {
            return self::naturalDate($time);
        }
        return date($format, $time);
    }
    /**
     * 自然日期
     * 
     * @return void
     */
    public static function naturalDate($from) {
        $now = time();
        $between = time() - $from;
        if ($between > 31536000) {
            return date('Y-m-d', $from);
        } else if ($between > 0 && $between < 172800                                // 如果是昨天
            && (date('z', $from) + 1 == date('z', $now)                             // 在同一年的情况
                || date('z', $from) + 1 == date('L') + 365 + date('z', $now))) {    // 跨年的情况
            return sprintf('昨天 %s', date('H:i', $from));
        } else if ($between == 0) {
            return '刚刚';
        }
        $f = array(
            '31536000' => '%d 年前',
            '2592000' => '%d 个月前',
            '604800' => '%d 星期前',
            '86400' => '%d 天前',
            '3600' => '%d 小时前',
            '60' => '%d 分钟前',
            '1' => '%d 秒前',
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($between / (int)$k)) {
                if ($c == 1) {
                    return sprintf($v, $c);
                }
                return sprintf($v, $c);
            }
        }
        return "";
    }

    /**
     * 导出文章 meta
     * 
     * @return string
     */
    static public function exportPostMeta(Widget_Archive $archive,$type){
        echo '<i class="fa fa-calendar"></i>&nbsp;'.self::formatDate($archive->created,'NATURAL');
        if(!$type=='1'){
            echo ' • <i class="fa fa-th-large"></i>&nbsp;';
            $archive->category(' ');
        }
        if(self::isPluginAvailable('TePostViews')&&!$type=='1'){
            echo ' • <i class="fa fa-eye"></i>&nbsp;';
            $archive->viewsNum();
        }
        echo ' • <a href="'.$archive->permalink.'#comments"><i class="fa fa-commenting-o"></i>&nbsp';
        $archive->commentsNum();
        echo '</a>';
    }

    /**
     * 导出 header
     * 
     * @return void
     */
    static public function exportHeader(Widget_Archive $archive,$img) {
		echo '<title>';
		self::title($archive);
		echo '</title>';
        $html = '';
        $site=Helper::options()->title;
        $description='';
        $createTime = date('c', $archive->created);
        $modifyTime = date('c', $archive->modified);
        $link=$archive->permalink;
        $type='';
        $author=$archive->author->screenName;
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
<meta name="author" content="{$author}" />
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
<meta name="twitter:image" content="{$img}" />\n
EOF;
        echo $html;
    }

	/**
     * 移动设备识别
     *
     * @return boolean
     */
    public static function isMobile(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc","iuc", 'ucbrowser', // uc浏览器
            "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
            "iemobile", "windows ce", // windows phone
            "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry",
            "blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo",
            "lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony",
            "symbian","tablet","tianyu","wap","xda","xde","zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }

    /**
     * 手机识别
     * 
     * @return boolean
     */
    public static function isPhone(){
        $ua=strtolower($_SERVER["HTTP_USER_AGENT"]);
        $devices=array("Android", 'iPhone', 'iPod', 'Phone');
        foreach ($devices as $device) {
            if(strpos($ua, strtolower($device))){
                return true;
            }
        }
        return false;
    }

    /**
     * 判断插件是否存在并启用
     * 
     * @return boolean
     */
    public static function isPluginAvailable($name) {
        if (class_exists($name.'_Plugin')){
            $plugins = Typecho_Plugin::export();
            $plugins = $plugins['activated'];
            return is_array($plugins) && array_key_exists($name, $plugins);
        }
    }
}