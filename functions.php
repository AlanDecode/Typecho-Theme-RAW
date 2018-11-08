<?php
/** 
* functions.php
* 
* 初始化主题，添加主题设置面板，添加文章自定义字段设置面板
* 
* @author      熊猫小A
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once("lib/Utils.php");
require_once("lib/Comments.php");

function themeInit($archive){
    Helper::options()->commentsMaxNestingLevels = 999;
}

$GLOBALS['RAW_VER']=0.6;

Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Utils', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Utils', 'addButton');

function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Textarea('banner', NULL, NULL, '文章主图', '输入图片URL，该图片会用于主页文章列表的显示');
    $layout->addItem($thumb);
    $indextype=new Typecho_Widget_Helper_Form_Element_Select('indextype',array('0'=>'普通','1'=>'大图版式'),'0','首页版式','设置文章在首页的显示样式，大图版式的头图会显示得大一些，适合你觉得比较有特色的文章。');
    $layout->addItem($indextype);
    $showTOC=new Typecho_Widget_Helper_Form_Element_Select('showTOC',array('0'=>'不显示目录','1'=>'显示目录'),'0','文章目录','是否显示文章目录');
    $layout->addItem($showTOC);
    $type=new Typecho_Widget_Helper_Form_Element_Select('type',array('0'=>'一般文章','1'=>'说说'),'0','文章类型');
    $layout->addItem($type);
}

function themeConfig($form) {
    //基本设置
    echo '<div id="raw-check-update" style="padding:0.1rem 1rem;background:#eeeeee;border-radius:5px;"></div>';
    echo '<script>var RAW_VER='.$GLOBALS['RAW_VER'].'</script>';
    echo '<script src="/usr/themes/RAW/assets/check_update.js"></script>';
    $sitelogo=new Typecho_Widget_Helper_Form_Element_Text('sitelogo', NULL, NULL, _t('左上角站点文字'), _t('左上角站点标题，不填写默认为系统站点标题。'));
    $form->addInput($sitelogo);
    $left_link=new Typecho_Widget_Helper_Form_Element_Text('left_link', NULL, NULL, _t('侧边栏头像打开链接'), _t('输入点击侧边栏头像要打开的位置，默认为站点首页。'));
    $form->addInput($left_link);
    $headernav=new Typecho_Widget_Helper_Form_Element_Textarea('headernav', NULL, NULL, _t('顶部导航链接'), _t('顶部导航链接，一行一个，格式：图标,名称,链接，例如：home,首页,/ 。图标名称参考 font-awesome。小屏幕会被隐藏。'));
    $form->addInput($headernav);
    $aside_nav=new Typecho_Widget_Helper_Form_Element_Textarea('aside_nav', NULL, NULL, _t('侧边栏导航链接'), _t('请直接以 a 标签书写，小屏幕中点击底栏按钮可以显示。一行一个。'));
    $form->addInput($aside_nav);
    $aside_link=new Typecho_Widget_Helper_Form_Element_Textarea('aside_link', NULL, NULL, _t('全站友链'), _t('全站侧边栏友情链接，请直接以 a 标签书写。一行一个。'));
    $form->addInput($aside_link);
    $colormode=new Typecho_Widget_Helper_Form_Element_Select('colormode',array('0'=>'自动切换','1'=>'夜间模式','2'=>'日间模式'),'0','博客颜色模式','设置主题默认模式。不论如何设置，都可以通过右上角按钮切换。');
    $form->addInput($colormode);
    $site_bg=new Typecho_Widget_Helper_Form_Element_Text('site_bg', NULL, NULL, _t('站点背景图'), _t('填写图像链接。'));
    $form->addInput($site_bg);
    $reward_img=new Typecho_Widget_Helper_Form_Element_Text('reward_img', NULL, NULL, _t('打赏二维码图片地址'), _t('填写图片链接，若不需要打赏则留空。只支持一张图，若需要多种支付方式请自行合成二维码图片。'));
    $form->addInput($reward_img);
    $footerinfo=new Typecho_Widget_Helper_Form_Element_Textarea('footerinfo', NULL, NULL, _t('页面底部输出内容'), _t('你可以输入需要在页面底部输出的内容，包括备案号等。请使用标准的 HTML 语法书写。'));
    $form->addInput($footerinfo);
    $headinfo=new Typecho_Widget_Helper_Form_Element_Textarea('headinfo', NULL, NULL, _t('head 标签内输出信息'), _t('这里的内容会输出在 head 标签靠前的位置，不建议在这里加入 CSS，你可以输入一些 meta 标签等。'));
    $form->addInput($headinfo);
	$customhead = new Typecho_Widget_Helper_Form_Element_Textarea('customhead', NULL, NULL, _t('head 标签结束前输出信息'), _t('将输出在 head 标签结束前，你可以输入统计代码或者 CSS 等，也可以使用 link 标签引入别的 CSS、JS。'));
    $form->addInput($customhead);
    $customfooter = new Typecho_Widget_Helper_Form_Element_Textarea('customfooter', NULL, NULL, _t('body 标签结束前输出信息'), _t('将输出在 body 标签结束前，你可以输入 JS 或者 CSS 等。'));
    $form->addInput($customfooter);
}
?>