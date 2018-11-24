// RAW.js
// Author: 熊猫小A
// Link: https://www.imalan.cn

RAW={
    // 初始化单页应用
    init : function(){
        NProgress.configure({ showSpinner: false });
        RAW.parseURL();
    },

    // 触发 PJAX 前的操作
    beforePjax:function(){
        NProgress.start();
        $("#main").fadeTo(200,0.2);
    },

    // PJAX 结束操作
    afterPjax:function(){
        NProgress.done();
        $("#main").fadeTo(200,1);
        RAW.parseURL();
        // 重载 OWO
        if($(".OwO").length>0){ 
            var owo = new OwO({
                logo: 'OωO表情',
                container: document.getElementsByClassName('OwO')[0],
                target: document.getElementsByClassName('input-area')[0],
                api: '/usr/themes/RAW/assets/owo/OwO_2.json',
                position: 'down',
                width: '400px',
                maxHeight: '250px'
            });
        }
    },

    // 解析要启用 PJAX 的链接
    parseURL:function(){
        var domain=document.domain;
        $.each($('a:not(a[target="_blank"], a[no-pjax])'),function(i,item){
            if(item.host==domain){
                $(item).addClass("pjax");
            }
        })

        $(document).pjax('a.pjax', {
            container: '#main',
            fragment: '#main',
            timeout: 8000,
        });
    }
}

$(document).ready(function(){
    RAW.init();
})

$(document).on('pjax:send',function(){
    RAW.beforePjax();
})

$(document).on('pjax:complete',function(){
    RAW.afterPjax();
})