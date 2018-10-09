<?php
/** 
* footer.php
* 
* 主题页脚
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer">
    <div class="footer-left">©<a href="https://imalan.cn"><?php echo Helper::options()->title; ?></a><?php echo $this->options->footerleft; ?></div>
    <div class="footer-right"><?php echo $this->options->footerright; ?>Powered by <a href="http://typecho.org">Typecho</a> • Theme <a href="https://blog.imalan.cn/archives/163/">RAW by 熊猫小A</a></div>
</footer><!-- end #footer -->
<?php $this->footer(); ?>

<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
        tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
</script>
<?php if($this->options->debugmode):?>
<script src="<?php $this->options->themeUrl('/assets/hljs/highlight.pack.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/mathjax/2.7.4/MathJax.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>" async></script>
<script src="<?php $this->options->themeUrl('/assets/raphael/2.2.7/raphael.min.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/flowchart/1.10.0/flowchart.min.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/owo/owo.min.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/zoomjs/zoom.min.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/pjax/pjax.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/js/RAW.js'); echo '?v='.(string)(rand(0,1000000)/1000000); ?>"></script>
<?php else:?>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/hljs/highlight.pack.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/raphael/2.2.7/raphael.min.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/mathjax/2.7.4/MathJax.js','','js'); ?>" async></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/flowchart/1.10.0/flowchart.min.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/owo/owo.min.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/zoomjs/zoom.min.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/pjax/pjax.js','','js'); ?>"></script>
<script src="<?php echo RAW::staticPath($this->options->CDNPath,'/js/RAW.js','7F713E43','js'); ?>"></script>
<?php endif;?>
<?php echo $this->options->footerinfo; ?>
<script>
$(document).on('pjax:end', function() {
    RAW.reloadRAW();
    RAW.initFlowChart();
    RAW.reloadMathJAX();
    RAW.reloadHLJS();
    <?php echo $this->options->pjaxreload; ?>
})
</script>