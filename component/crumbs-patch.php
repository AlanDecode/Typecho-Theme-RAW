<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>


<div id="crumbs-patch" class="block-item">
    <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo;</li>
    <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
        文章列表 &raquo; 第&nbsp;<?php echo $this->_currentPage; ?>&nbsp;页
    <?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
        文章 &raquo; <?php $this->title() ?>
    <?php else: ?><!-- 页面为其他页时 -->
    <?php $this->archiveTitle(array(
        'category'  =>  _t('分类 "%s" 下的文章'),
        'search'    =>  _t('包含关键字 "%s" 的文章'),
        'tag'       =>  _t('标签 "%s" 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ''); ?>
    <?php endif; ?>
</div>
