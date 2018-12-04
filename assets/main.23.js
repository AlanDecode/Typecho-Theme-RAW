// RAW
// Author: 熊猫小A
// Link: https://www.imalan.cn

console.log(` %c Theme RAW 0.92 %c https://blog.imalan.cn/archives/163/ `, `color: #fadfa3; background: #23b7e5; padding:5px;`, `background: #1c2b36; padding:5px;`);

$(document).scroll(function(){
    if($(window).width()>767) return;
	var before = $(document).scrollTop();
    $(document).scroll(function() {
        if($(document).scrollTop()+$(window).height()>=$("#footer-info").offset().top){
            $("#ctrler").css("transform","translateX(0)");
            $(".nav-links").css("transform","translateY(0)");
            return;
        }
        var after = $(document).scrollTop();
        if (before<after && after>40 ) {
            $(".nav-links").css("transform","translateY(100%)");
            $("#ctrler").css("transform","translateX(100%)");
            before = after;
        };
        if (before>after || after<=40) {
            $(".nav-links").css("transform","translateY(0)");
            $("#ctrler").css("transform","translateX(0)");
            before = after;
        };
    });
});

nextUrl="";
function loadMorePosts(){
    if(nextUrl==null) return;
    var target;
    if(nextUrl=="") target=$(".next").attr("href");
    else target=nextUrl;
    if(target!="" && typeof(target)!="undefined"){
        $("#index-loadmore-btn").html(`<div class="idot"></div><div class="idot"></div><div class="idot"></div>`);
        $.ajax({
            url:target,
            async:true,
            success:function(data){
                nextUrl=$(data).find(".next").attr("href");
                $("#post-list").append($(data).find("#post-list").html());
                if(typeof(nextUrl)=="undefined"){
                    $("#index-loadmore-btn").html("没有了");
                    nextUrl=null;
                }else{
                    $("#index-loadmore-btn").html("加载更多");
                }
                if(typeof(RAW)=="object"){
                    RAW.init();
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
                    // 已点赞按钮高亮
                    var cookies = $.macaroon('_syan_like') || "";
                    $.each($(".post-like"),function(i,item){
                        var id = $(item).attr('data-pid');
                        if (-1 !== cookies.indexOf("," + id + ","))  $(item).addClass("done");
                    })
                    // 重载代码高亮
                    $("pre code").each(function(i, block) {hljs.highlightBlock(block);});   
                    // 重载 MathJax
                    if (typeof MathJax !== 'undefined'){
                        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                    } 
                }
            },
            error:function(){
                alert('加载失败！');
            }
        });
    }else{
        $("#index-loadmore-btn").html("没有了");
    }
}

function parseURL(){
    var domain=document.domain;
    $(`a:not(a[href^="#"]):not('.post-like')`).each(function(i,item){
        if((!$(item).attr("target") || (!$(item).attr("target")=="" && !$(item).attr("target")=="_self" ))){
            if(item.host!=domain){
                $(item).attr("target","_blank");
            }
        }
    })
}

function fixItem(item,fix,offset){
    if(fix){
        $(item).css("top",String(offset)+"px");
        $(item).css("left",$(item).offset().left);
        $(item).addClass("fixed");
    }else{
        $(item).removeClass("fixed");
        $(item).css("top","unset");
        $(item).css("left","unset");
    }
}

function registerFixedTOC(){     
    toc_offset=0;
    $(document).scroll(function(){
        if($("#TOC").length < 1) return;
        $("#TOC").css("max-width",$("#TOC").parent().width()+"px");
        if(!toc_offset){
            toc_offset=$("#TOC").offset().top;
            return;
        }
        var top=$("#TOC").offset().top-$(document).scrollTop();
        if(top<=61 && $("#TOC").offset().top>=toc_offset){
            fixItem("#TOC",true,60);
        }
        else{
            fixItem("#TOC",false,60);
            toc_offset=$("#TOC").offset().top;
        } 
    })
}

function parsedPhotos(){
    var nPhotos=$("article .photos img").length;
    var parsedPhotos=0;
    $.each($("article .photos"),function(i,item){
        var MinHeight=10000000000000;
        $.each($(item).find("img"),function(ii,iitem){
            var theImage = new Image(); 
            theImage.onload=function(){
                $(iitem).parent().attr("data-height",String(theImage.height));
                $(iitem).parent().attr("data-width",String(theImage.width));
                MinHeight=MinHeight<theImage.height?MinHeight:theImage.height;
                $(item).attr("data-min-h",String(MinHeight));
                parsedPhotos++;
                if(parsedPhotos>=nPhotos){
                    $.each($("article .photos a"),function(i,item){
                        $(item).css("flex",String(parseFloat($(item).parent().attr("data-min-h"))/parseFloat($(item).attr("data-height"))));
                    })
                }
            }
            theImage.src = $(iitem).attr( "src"); 
        })
    })
}

$(".post-like").click(function(){
    $(this).addClass("done");
})

$(document).ready(function(){
    checkNightMode();
    parsedPhotos();
    parseURL();
    $.each($(".nav-link"),function(i,item){
        if($(item).attr("href")==window.location.pathname) $(item).addClass("current");
    })
    registerFixedTOC();
    hljs.initHighlightingOnLoad();
})

// function toggleShrink(item){
//     if($(item).parent().parent().prev().hasClass("shrink")){
//         $(item).html(`<i class="fa fa-chevron-circle-up"></i> 收起`);
//         $(item).parent().parent().prev().removeClass("shrink");
//     }else{
//         $(item).html(`<i class="fa fa-chevron-circle-down"></i> 展开`);
//         $(item).parent().parent().prev().addClass("shrink");
//     }
// }

function switchNightMode(){
    var night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
    if(night == '0'){
        $("html").addClass("night");
        document.cookie = "night=1;path=/";
        console.log('夜间模式开启');
    }else{
        $("html").removeClass("night");
        document.cookie = "night=0;path=/";
        console.log('夜间模式关闭');
    }
}

function checkNightMode(){
    if($("html").hasClass("n-f")){
        $("html").removeClass("day");
        $("html").addClass("night");
        return;
    }
    if($("html").hasClass("d-f")){
        $("html").removeClass("night");
        $("html").addClass("day");
        return;
    }
    if(document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") === ''){
        if(new Date().getHours() >= 23 || new Date().getHours() < 7){
            $("html").addClass("night");
            document.cookie = "night=1;path=/";
            console.log('夜间模式开启');
        }else{
            $("html").removeClass("night");
            document.cookie = "night=0;path=/";
            console.log('夜间模式关闭');
        }
    }else{
        var night = document.cookie.replace(/(?:(?:^|.*;\s*)night\s*\=\s*([^;]*).*$)|^.*$/, "$1") || '0';
        if(night == '0'){
            $("html").removeClass("night");
        }else if(night == '1'){
            $("html").addClass("night");
        }
    }
}

function filterItems(item,type){
    $(".post-item.item-nav .index-filter >div").removeClass("current");
    $(item).addClass("current");
    document.documentElement.style.setProperty('--shuoshuo-display', 'none');
    document.documentElement.style.setProperty('--post-item-display', 'none');  
    switch (type) {
        case 1:
            document.documentElement.style.setProperty('--post-item-display', 'block');
            break;
        case 2:
            document.documentElement.style.setProperty('--shuoshuo-display', 'block');
            break;
        case 0:
            document.documentElement.style.setProperty('--post-item-display', 'block');
            document.documentElement.style.setProperty('--shuoshuo-display', 'block');
            break;
   }
}
