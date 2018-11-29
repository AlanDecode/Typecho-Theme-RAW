<?php
/**
 * footer.php
 * 
 * 尾部
 * 
 * @author 熊猫小A
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<script>
    var serviceWorkerUri = '/SWCacheRule.js';

    if ('serviceWorker' in navigator) {  
        navigator.serviceWorker.register(serviceWorkerUri).then(function() {
          if (navigator.serviceWorker.controller) {
            console.log('Assets cached by the controlling service worker.');
          } else {
            console.log('Please reload this page to allow the service worker to handle network operations.');
          }
        }).catch(function(error) {
          console.log('ERROR: ' + error);
        });
    } else {
        console.log('Service workers are not supported in the current browser.');
    }
</script>
<?php $this->footer(); ?>
<script src="<?php $this->options->themeUrl('/assets/owo/owo_custom.js'); ?>"></script>
<?php if($this->allow('comment')&&($this->is('post')||$this->is('page')) ): ?>
<script>
var owo = new OwO({
    logo: 'OωO表情',
    container: document.getElementsByClassName('OwO')[0],
    target: document.getElementsByClassName('input-area')[0],
    api: '<?php $this->options->themeUrl('/assets/owo/OwO_2.json'); ?>',
    position: 'down',
    width: '400px',
    maxHeight: '250px'
});
</script>
<?php endif; ?>  
<script src="<?php $this->options->themeUrl('/assets/hljs/highlight.pack.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/fancybox/jquery.fancybox.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/main.20.js'); ?>"></script>
<!--script src="<?php $this->options->themeUrl('/assets/smothscroll/smothscroll.js'); ?>"></script-->
<?php if($this->options->pjax=='1'): ?>
<script src="<?php $this->options->themeUrl('/assets/pjax/jquery.pjax.js'); ?>"></script>
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/pjax/np.css');?>">
<script src="<?php $this->options->themeUrl('/assets/pjax/np.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/RAW.08.js'); ?>"></script>
<script>
$(document).on('pjax:complete', function() {
  <?php echo $this->options->pjaxreload; ?>
})
</script>
<?php endif; ?>
<?php echo $this->options->customfooter; ?>
<script src='<?php $this->options->themeUrl('/assets/mathjax/2.7.4/MathJax.js'); ?>' async></script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
</script>
<?php if(Utils::isPluginAvailable('Like')):?>
<script>
var cookies = $.macaroon('_syan_like') || "";
$.each($(".post-like"),function(i,item){
    var id = $(item).attr('data-pid');
    if (-1 !== cookies.indexOf("," + id + ","))  $(item).addClass("done");
})
</script>
<?php endif;?>
<?php if(!Utils::isMobile()): ?>
<div id="panda" style="opacity:0;display:flex;align-items:center;justify-content:center;position:fixed;bottom:-15px;z-index:-1">
<svg style="width: 300px;visibility: visible;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="300 250 200 115" xml:space="preserve">
  <filter id="shadowBlur" x="0%" y="0%" width="275%" height="150%">
    <feGaussianBlur in="SourceGraphic" stdDeviation="2"></feGaussianBlur>
  </filter>    
  <g id="shadow" opacity="0.4" filter="url(#shadowBlur)">
    <ellipse fill="#54AEA7" cx="394.676" cy="343.597" rx="65" ry="8"></ellipse>
  </g>
  <g id="body" data-svg-origin="395 346.14178466796875" transform="matrix(1,0,0,1.19929,0,-68.98429993307559)" style="transform-origin: 0px 0px 0px;">
    <path id="frontPawR" fill="#303030" d="M369,338.5c0,3.59-6.716,6.5-15,6.5c-11,0-16-3.41-16-7s1-6,16-6C362.284,332,369,334.91,369,338.5z"></path>
    <path fill="#FFFFFF" d="M417.562,346l13.759-0.251c7.796-1.072,14.679-6.179,14.679-14.11v0c0-13.608-11.473-24.64-25.625-24.64H394v16.344C394,335.857,394,346,417.562,346z"></path>
    <path fill="#EBEBEB" d="M410.441,332.708c0,0,10.042,7.749,17.507,0.97c7.465-6.779,15.351-13.06,15.351-13.06l0.549,1.078
                            c1.604,3.148,2.363,6.659,2.202,10.189L446,333c0,0-3.22,7.407-9.409,11.173c-2.231,1.357-6.845,1.88-9.024,1.921
                            c-12.467,0.236-17.187-0.479-17.187-0.479l-3.517-7.829L410.441,332.708z"></path>
    <path fill="#303030" d="M445.981,332.269c0,0-0.629,1.396-1.693,2.21c-2.136,1.633-4.56,1.549-4.56,1.549l4.319,1.844
                            c0.776,0.646,1.953,0.095,1.953-0.915L445.981,332.269z"></path>
    <path id="backPaw" fill="#303030" d="M452,343c0,3-5.149,3-11.5,3c-5.268,0-8.23,0-9.823-0.512c-1.28-0.411-1.677-1.152-1.677-2.488c0-4,7-7,11.5-7C446.851,336,452,340.239,452,343z"></path>
  </g>
  <g id="head" data-svg-origin="385.7687530517578 345.5" transform="matrix(1,0,0,1.04484,0,-15.492688989257715)" style="transform-origin: 0px 0px 0px;">
    <path fill="#303030" d="M343,316c0,7.732,5.791,14,8,14s0-6.268,0-14s-0.791-14-3-14S343,308.268,343,316z"></path>
    <path fill="#FFFFFF" d="M383.9,279.5h-4.3c-18.28,0-33.1,14.819-33.1,33.1v4.958c0,1.512,0.124,2.995,0.355,4.442h-0.14
                            c-3.882,0-4.939,2.615-4.819,6.698c0.217,7.382,1.104,16.802,32.615,16.802h9.589c18.17,0,32.9-14.73,32.9-32.9v0
                            C417,294.319,402.181,279.5,383.9,279.5z"></path>
    <path fill="#EBEBEB" d="M381.186,279.5h2.896c18.281,0,33.1,14.819,33.1,33.1v0c0,11.356-5.754,21.369-14.505,27.281
                            C402.677,339.881,411.009,298.46,381.186,279.5z"></path>
    <g id="snout">
      <path fill="#231D1D" d="M348.974,328.117c-0.546,0.459-1.402,0.459-1.948,0l-1.603-1.348l0,0
                              c-0.928-0.781-0.305-2.167,0.974-2.167H348h1.603c1.279,0,1.902,1.386,0.974,2.167l0,0L348.974,328.117z"></path>
      <ellipse fill="#231D1D" cx="348.003" cy="325.855" rx="3.018" ry="1.717"></ellipse>
    </g>
    <path id="mouth" fill="none" stroke="#231D1D" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M348,327v2.036c0,0,0,3.016,2.587,3.016c1.807,0,2.333-1.988,2.333-1.988" data-svg-origin="350.4600067138672 327" transform="matrix(1,0,0,1,0,0)" style="stroke-dashoffset: 1e-05; stroke-dasharray: none; transform-origin: 0px 0px 0px;"></path>
    <g id="ear" data-svg-origin="402.8709259033203 323.1259765625" transform="matrix(0.98712,0.15996,-0.15996,0.98712,56.32639731579388,-59.87163277877468)" style="transform-origin: 0px 0px 0px;">
      <path fill="#231D1D" d="M416.259,314.576L416.259,314.576c6.679-6.187,7.078-16.616,0.891-23.295l-3.126-3.374
                              c-6.173-6.664-16.579-7.062-23.242-0.889l0,0c-3.892,3.605-4.124,9.683-0.519,13.575l12.475,13.467
                              C406.328,317.936,412.382,318.167,416.259,314.576z"></path>
      <ellipse transform="matrix(0.7071 -0.7071 0.7071 0.7071 -95.1679 373.1731)" fill="#3E3E3E" cx="402.876" cy="301.464" rx="11.926" ry="18.708"></ellipse>
      <path fill="#3E3E3E" d="M416.43,314.417L416.43,314.417c4.294-3.977,4.55-10.682,0.573-14.976l-11.127-12.012
                              c-3.963-4.278-10.645-4.534-14.923-0.571l-0.916,0.849c-3.48,3.224-3.688,8.659-0.464,12.14l13.006,14.04
                              C406.257,317.859,412.459,318.096,416.43,314.417z"></path>
    </g>
    <g>
      <path fill="#EBEBEB" d="M355.5,317.014c0.084,2.508,0.581,15.98,16.458,18.427c3.678,0.567,7.472,0.262,10.927-1.118
                              c0.766-0.306,1.53-0.667,2.234-1.091c5.302-3.195,4.881-13.996,4.881-13.996c0-12.265-7.66-22.207-23.902-22.207
                              C356.756,297.027,355.5,307,355.5,317.014z"></path>
      <path fill="#302F2E" d="M355.5,315.5c0,9.665,3,16,16,16c12,0,14.5-4.335,14.5-14s-6.5-18-20.25-17.5
                              C356.781,300.326,355.5,305.835,355.5,315.5z"></path>
    </g>
    <g id="EyeGroup">
      <ellipse id="eyeBot" fill="#FFFFFF" cx="365.752" cy="320.027" rx="5.164" ry="5.053"></ellipse>
      <circle id="eyeTop" fill="#302F2E" cx="365.752" cy="320.027" r="5.5" data-svg-origin="360.25201416015625 314.5270080566406" transform="matrix(1,0,0,1,0,2)"></circle>
    </g>
  </g>
  <path id="frontPawL" fill="#303030" d="M417,340.5c0,4.142-5,5.5-12.5,5.5c-6.904,0-12.5,0-12.5-5.5c0-4.142,5.596-7.5,12.5-7.5S417,336.358,417,340.5z"></path>
  <g id="sleep">
    <polyline fill="none" stroke="#303030" stroke-width="0.725" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="370.913,265.143 374.848,265.143 370.662,269.56 375.408,269.56" style="opacity: 0;"></polyline>
    <polyline fill="none" stroke="#303030" stroke-width="0.725" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="377.959,261.272 381.894,261.272 377.708,265.688 382.454,265.688" style="opacity: 0;"></polyline>
    <polyline fill="none" stroke="#303030" stroke-width="0.725" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="385.469,256.856 389.404,256.856 385.218,261.272 389.964,261.272" style="opacity: 0;"></polyline>
  </g>
</svg>
</div>
<script src="<?php $this->options->themeUrl('/assets/panda/TweenMax.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/panda/DrawSVGPlugin.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/panda/panda.js'); ?>"></script>
<?php endif; ?>
</body>
</html>
