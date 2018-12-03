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

function themeInit($comment){
    Helper::options()->commentsAntiSpam = false;
    Helper::options()->commentsMaxNestingLevels = 999;
}

$GLOBALS['RAW_VER']=0.91;

Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Utils', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Utils', 'addButton');
Typecho_Plugin::factory('Widget_Feedback')->comment = array('Utils', 'filterComments');

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
    echo '<div id="raw-check-update" style="padding:0.1rem 1rem;background:#eeeeee;border-radius:5px;"></div>';
    echo '<script>var RAW_VER='.$GLOBALS['RAW_VER'].'</script>';
    echo '<script src="/usr/themes/RAW/assets/check_update.js"></script>';

    // 基本设置
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
    $site_bg=new Typecho_Widget_Helper_Form_Element_Text('site_bg', NULL, NULL, _t('站点背景图'), _t('填写图像链接。'));
    $form->addInput($site_bg);

    // 外观设置
    $colormode=new Typecho_Widget_Helper_Form_Element_Select('colormode',array('0'=>'自动切换','1'=>'夜间模式','2'=>'日间模式'),'0','博客颜色模式','设置主题默认模式。不论如何设置，都可以通过右上角按钮切换。');
    $form->addInput($colormode);
    $columnorder=new Typecho_Widget_Helper_Form_Element_Select('columnorder',array('0'=>'正序','1'=>'逆序'),'0','设置三栏的显示顺序','设置导航栏，文章栏，热门统计栏的显示顺序。');
    $form->addInput($columnorder);
    $showaside=new Typecho_Widget_Helper_Form_Element_Select('showaside',array('0'=>'显示','1'=>'不显示','2'=>'登录显示'),'0','是否显示右侧边栏','设置是否显示右侧边栏。（仅隐藏最近评论与热门日志模块，文章目录仍然会显示）');
    $form->addInput($showaside);

    // 常用功能设置
    $defaultavatar=new Typecho_Widget_Helper_Form_Element_Text('defaultavatar', NULL, NULL, _t('博主头像'), _t('设置后博客右上角会引用本头像，否则引用当前用户头像。侧边栏则使用文章作者头像，当其不可用时引用本头像。'));
    $form->addInput($defaultavatar);
    $reward_img=new Typecho_Widget_Helper_Form_Element_Text('reward_img', NULL, NULL, _t('打赏二维码图片地址'), _t('填写图片链接，若不需要打赏则留空。只支持一张图，若需要多种支付方式请自行合成二维码图片。'));
    $form->addInput($reward_img);

    // 高级功能设置
    $indexloadmore=new Typecho_Widget_Helper_Form_Element_Select('indexloadmore',array('0'=>'加载更多','1'=>'分页'),'0','首页分页样式','设置首页的分页样式，加载更多或者分页。');
    $form->addInput($indexloadmore);
    $pjax=new Typecho_Widget_Helper_Form_Element_Select('pjax',array('0'=>'不启用','1'=>'启用'),'0','启用 PJAX (BETA)','是否启用 PJAX。如果你发现站点有点不对劲，又不知道这个选项是啥意思，请关闭此项。');
    $form->addInput($pjax);
    $loadinganime=new Typecho_Widget_Helper_Form_Element_Select('loadinganime',array('0'=>'圆点','1'=>'小电视'),'0','PJAX 加载动画','选择 PJAX 加载动画，仅当启用 PJAX 时有效。');
    $form->addInput($loadinganime);
    $pjaxreload=new Typecho_Widget_Helper_Form_Element_Textarea('pjaxreload', NULL, NULL, _t('PJAX 重载函数'), _t('输入要重载的 JS，如果你发现站点有点不对劲，又不知道这个选项是啥意思，请关闭 PJAX 并留空此项。'));
    $form->addInput($pjaxreload);
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