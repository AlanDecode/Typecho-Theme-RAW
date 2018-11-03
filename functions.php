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

function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Textarea('banner', NULL, NULL, '文章主图', '输入图片URL，该图片会用于主页文章列表的显示');
    $layout->addItem($thumb);
    $showTOC=new Typecho_Widget_Helper_Form_Element_Select('showTOC',array('0'=>'不显示目录','1'=>'显示目录'),'0','文章目录','是否显示文章目录');
    $layout->addItem($showTOC);
    $type=new Typecho_Widget_Helper_Form_Element_Select('type',array('0'=>'一般文章','1'=>'说说'),'0','文章类型');
    $layout->addItem($type);
    echo '<style>#custom-field textarea{width:100%}</style>';
}

function themeConfig($form) {
    //基本设置
    $sitelogo=new Typecho_Widget_Helper_Form_Element_Textarea('sitelogo', NULL, NULL, _t('左上角站点文字'), _t('左上角站点标题，不填写默认为系统站点标题。'));
    $form->addInput($sitelogo);
    $footerinfo=new Typecho_Widget_Helper_Form_Element_Textarea('footerinfo', NULL, NULL, _t('页面底部输出内容'), _t('你可以输入需要在页面底部输出的内容，包括备案号等。请使用标准的 HTML 语法书写。'));
    $form->addInput($footerinfo);
    $headinfo=new Typecho_Widget_Helper_Form_Element_Textarea('headinfo', NULL, NULL, _t('head 标签内输出信息'), _t('这里的内容会输出在 head 标签靠前的位置，不建议在这里加入 CSS，你可以输入一些 meta 标签等。'));
    $form->addInput($headinfo);
    $headernav=new Typecho_Widget_Helper_Form_Element_Textarea('headernav', NULL, NULL, _t('顶部导航链接'), _t('顶部导航链接，一行一个，格式：图标,名称,链接，例如：home,首页,/ 。图标名称参考 font-awesome。小屏幕会被隐藏。'));
    $form->addInput($headernav);
    $left_link=new Typecho_Widget_Helper_Form_Element_Textarea('left_link', NULL, NULL, _t('侧边栏头像打开链接'), _t('输入点击侧边栏头像要打开的位置，默认为站点首页。'));
    $form->addInput($left_link);
    $aside_nav=new Typecho_Widget_Helper_Form_Element_Textarea('aside_nav', NULL, NULL, _t('侧边栏导航链接'), _t('请直接以 a 标签书写，小屏幕中点击底栏按钮可以显示。一行一个。'));
    $form->addInput($aside_nav);
    $aside_link=new Typecho_Widget_Helper_Form_Element_Textarea('aside_link', NULL, NULL, _t('全站友链'), _t('全站侧边栏友情链接，请直接以 a 标签书写。一行一个。'));
    $form->addInput($aside_link);
    $site_bg=new Typecho_Widget_Helper_Form_Element_Textarea('site_bg', NULL, NULL, _t('站点背景图'), _t('填写图像链接。'));
    $form->addInput($site_bg);
	$customhead = new Typecho_Widget_Helper_Form_Element_Textarea('customhead', NULL, NULL, _t('head 标签结束前输出信息'), _t('将输出在 head 标签结束前，你可以输入统计代码或者 CSS 等，也可以使用 link 标签引入别的 CSS、JS。'));
    $form->addInput($customhead);
    $customfooter = new Typecho_Widget_Helper_Form_Element_Textarea('customfooter', NULL, NULL, _t('body 标签结束前输出信息'), _t('将输出在 body 标签结束前，你可以输入 JS 或者 CSS 等。'));
    $form->addInput($customfooter);
}
?>