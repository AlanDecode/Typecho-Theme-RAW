<?php
/** 
* functions.php
* 
* 初始化主题，添加主题设置面板，添加文章自定义字段设置面板
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once("lib/Utils.php");
require_once("lib/RAW.php");
require_once("lib/Content.php");
require_once("lib/Comments.php");

function themeInit($archive){
    Helper::options()->commentsAntiSpam = false; 
}

function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Textarea('banner', NULL, NULL, '文章主图', '输入图片URL，该图片会用于主页文章列表的显示');
    $layout->addItem($thumb);
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', NULL, NULL, '文章摘要', '输入文章摘要');
    $layout->addItem($excerpt);
    $showTOC=new Typecho_Widget_Helper_Form_Element_Select('showTOC',array('0'=>'不显示目录','1'=>'显示目录'),'0','文章目录','是否显示文章目录');
    $layout->addItem($showTOC);
    $type=new Typecho_Widget_Helper_Form_Element_Select('type',array('0'=>'一般文章','1'=>'短文章'),'0','文章类型','选择文章类型。若为短文章，将在主页直接输出所有内容。首页与文章页的展现形式会对应改变');
    $layout->addItem($type);
    $bannerposition=new Typecho_Widget_Helper_Form_Element_Select('bannerposition',array('0'=>'自动','1'=>'与标题叠加','2'=>'不显示'),'0','首页文章样式','当不是短文章且设置了主图时，你可以在这里选择在首页文章列表中如何展示主图。');
    $layout->addItem($bannerposition);
    echo '<style>#custom-field textarea{width:100%}</style>';
}

function themeConfig($form) {
    //基本设置
    $notice = new Typecho_Widget_Helper_Form_Element_Textarea('notice', NULL, NULL, _t('网站公告'), _t('网站公告'));
    $form->addInput($notice);
    $indextitle = new Typecho_Widget_Helper_Form_Element_Text('indextitle', NULL, NULL, _t('站点大图内文字'), _t('填写站点大图内文字'));
    $form->addInput($indextitle);
    $sitenav = new Typecho_Widget_Helper_Form_Element_Textarea('sitenav', NULL, NULL, _t('导航链接'), _t('填写导航链接，一行一个，格式：图标,名称,链接,打开位置。'));
    $form->addInput($sitenav); 
    $sociallinks=new Typecho_Widget_Helper_Form_Element_Textarea('sociallinks', NULL, NULL, '侧边栏社交链接', '一行一个，格式：图标,链接,打开位置，例如 twitter,https://twitter.com,_blank');
    $form->addInput($sociallinks);
    $sidermusic=new Typecho_Widget_Helper_Form_Element_Text('sidermusic', NULL, NULL, '侧边栏歌单', '格式：平台,id,是否自动播放。其中 id 是歌单 id，一般可以从歌单链接中获取；平台是歌单的来源，例如网易云是 netease；是否自动播放填写 true 或者 false，默认不自动播放。<br><b>注意：自动播放并非在所有浏览器中都可用。</b>');
    $form->addInput($sidermusic);
    $authorlink=new Typecho_Widget_Helper_Form_Element_Text('authorlink', NULL, NULL , '侧边栏作者头像链接', '填写点击头像时打开的页面，不填默认 /about.html<br><br><br>');
    $form->addInput($authorlink);

    //外观设置
    $randombanner = new Typecho_Widget_Helper_Form_Element_Textarea('randombanner', NULL, NULL, _t('头部大图'), _t('填写头部大图地址，一行一个，首页大图与未设置主图的文章将从这里随机选取图片作为头部图片'));
    $form->addInput($randombanner);
    $footerright=new Typecho_Widget_Helper_Form_Element_Text('footerright', NULL, NULL, '页面底部右侧文字', '会输出在 Powered By Typecho 左侧，不建议太长，在小屏幕上会被隐去。可以填入备案号、CDN 赞助商等。');
    $form->addInput($footerright);
    $footerleft=new Typecho_Widget_Helper_Form_Element_Text('footerleft', NULL, NULL, '页面底部左侧文字', '会输出在站点名右侧，不建议太长，在小屏幕上会被隐去。可以填入备案号、CDN 赞助商等。');
    $form->addInput($footerleft);
    $bg=new Typecho_Widget_Helper_Form_Element_Text('bg', NULL, NULL, '站点背景图', '填写链接，背景图将会被加上白色遮罩');
    $form->addInput($bg);
    $colorscheme=new Typecho_Widget_Helper_Form_Element_Text('colorscheme', NULL, NULL, '主题色调', '填写十六进制颜色，例如 #fafafa');
    $form->addInput($colorscheme);
    $authorbg=new Typecho_Widget_Helper_Form_Element_Text('authorbg', NULL, NULL , '侧边栏作者背景图', '填写链接<br><br><br>');
    $form->addInput($authorbg);

    //高级设置
    $headinfo = new Typecho_Widget_Helper_Form_Element_Textarea('headinfo', NULL, NULL, _t('自定义头部，将输出在 head 标签结束前'), _t('这里可以引入 CSS、JS 等'));
    $form->addInput($headinfo); 
    $footerinfo = new Typecho_Widget_Helper_Form_Element_Textarea('footerinfo', NULL, NULL, _t('自定义尾部，将输出在 footer 后'), _t('这里可以引入 CSS、JS 等'));
    $form->addInput($footerinfo);
    $pjaxreload = new Typecho_Widget_Helper_Form_Element_Textarea('pjaxreload', NULL, NULL, _t('PJAX 重载函数'), _t('输入要重载的 PJAX，不需要 script 标签'));
    $form->addInput($pjaxreload); 
    $CDNPath= new Typecho_Widget_Helper_Form_Element_Text('CDNPath', NULL, NULL, _t('镜像 CDN 域名'), _t('例如 https://static.imalan.cn'));
    $form->addInput($CDNPath);
    $debugmode= new Typecho_Widget_Helper_Form_Element_Text('debugmode', NULL, NULL, _t('维护模式'), _t('不为空时启用。启用后会跳过 CDN 从源站加载未压缩的静态文件，仅在调试时使用<br><br><br>'));
    $form->addInput($debugmode);
}
