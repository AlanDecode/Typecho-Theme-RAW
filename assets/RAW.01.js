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
        $("button[data-fancybox-close]").click()
        $("#main").fadeTo(200,0.2);
    },

    // PJAX 结束操作
    afterPjax:function(){
        NProgress.done();
        $("#main").fadeTo(200,1);
        checkNightMode();
        parsedPhotos();
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
        // 重新绑定文章点赞事件
        $(".post-like").click(function(){
            $(this).addClass("done");
        })
        $(".post-like").on("click", function(){
            var th = $(this);
            var id = th.attr('data-pid');
            var cookies = $.macaroon('_syan_like') || "";
            if (!id || !/^\d{1,10}$/.test(id)) return;
            if (-1 !== cookies.indexOf("," + id + ",")) return alert("您已经赞过了！");
            cookies ? cookies.length >= 160 ? (cookies = cookies.substring(0, cookies.length - 1), cookies = cookies.substr
    (1).split(","), cookies.splice(0, 1), cookies.push(id), cookies = cookies.join(","), $.macaroon("_syan_like", "," + cookies + 
    ",")) : $.macaroon("_syan_like", cookies + id + ",") : $.macaroon("_syan_like", "," + id + ",");
            $.post(likePath,{
            cid:id
            },function(data){
            th.addClass('actived');
            var zan = th.find('.like-num').text();
            th.find('.like-num').text(parseInt(zan) + 1);
            },'json');
        });
        // 重载代码高亮
        $("pre code").each(function(i, block) {hljs.highlightBlock(block);});   
        // 重载 MathJax
        if (typeof MathJax !== 'undefined'){
            MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
        } 
        // 重载百度统计
        if (typeof _hmt !== 'undefined'){
            _hmt.push(['_trackPageview', location.pathname + location.search]);
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