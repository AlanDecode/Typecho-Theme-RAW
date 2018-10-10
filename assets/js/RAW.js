// RAW.js
// Author: 熊猫小A
// Link: https://imalan.cn

console.log(`%c Theme RAW 0.1 %c https://blog.imalan.cn/archives/163/ `, `color: #fadfa3; background: #23b7e5; padding:5px 0;`, `background: #1c2b36; padding:5px 0;`);

function toggleMblNav(){
    if($("#aside").hasClass("show-aside")){
        $("#aside").removeClass("show-aside");
        $(".noscroll").fadeOut(200);
    }
    else{
        $("#aside").addClass("show-aside");
        $(".noscroll").fadeIn(200);
    }
}
function toggleSearch(){
    if($("#search-box").hasClass("hide")){
        $("#search-box").removeClass("hide");
        $("#search-box input").focus();
    }
    else{
        $("#search-box").addClass("hide");
    }
}
function startSearch() {
    var c = $("#search-box input").val();
    if(!c||c==""){
        $("#search-box input").attr("placeholder","你还没有输入任何信息");
        return;
    }
    var t="/search/"+c;
    $.pjax({url: t, container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
    toggleSearch();
}

function entersearch(){
    var event = window.event || arguments.callee.caller.arguments[0];  
    if (event.keyCode == 13)  {  
        startSearch();  
    }
}

var curBooks=0;
var curMovies=0;
RAW = {
    initRAW : function(){ // init all
        curBooks = 0;
        curMovies = 0;
        RAW.parseImgGrid(); 
        RAW.parseURL();
        RAW.loadBooks();
        RAW.loadMovies();
        RAW.initFlowChart();
    },

    reloadRAW : function(){ // reload scripts after pjax
        curBooks = 0;
        curMovies = 0;
        RAW.parseImgGrid(); 
        RAW.parseURL();
        RAW.loadBooks();
        RAW.loadMovies();
        RAW.reloadLike();
    },

    reloadHLJS : function(){
        $("pre code").each(function(a,c){hljs.highlightBlock(c)})
    },

    initFlowChart : function(){
        $(".lang-flow").each(function(i,item){
            var id="flow-chart-"+String(i);
            $(item).parent().addClass("nohighlight").hide().after(`<div style="overflow:auto" id="`+id+`"></div>`);
            var diagram = flowchart.parse($(item).text());
            diagram.drawSVG(id);
        })
    },

    parseURL : function(){
        var domain=document.domain;
        $(`a:not(a[href^="#"]):not('.post-like')`).each(function(i,item){
            if((!$(item).attr("target") || !$(item).attr("target")=="")){
                if(item.host!=domain){
                    $(item).attr("target","_blank");
                }
            }
            if(item.host==domain && $(item).attr("target")!="_blank"){
                $(item).attr("data-pjax","1");
            }
        })

        $(document).pjax('a[data-pjax="1"]',{container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
    },

    parseImgGrid : function(){
        $("article p").each(function(){
            if($(this).children("img").length>0){
                $(this).addClass("p-"+String($(this).children("img").length));
            }
        })
        $("article img").each(function(i,item){
            if($(item).attr("data-action")!="none"){
                $(item).attr("data-action","zoom");
            }
        })
    },

    loadBooks : function(){
        if(window.location.pathname!="/book" &&window.location.pathname!="/book.html" && window.location.pathname!="/book/") return;
        $('.loadmore').html("加载中...");
        $.getJSON("https://api.imalan.cn/Douban/getBooks.php?from="+String(curBooks),function(result){
            $('.loadmore').html("加载更多");
            if(result.length<10){
                $("#loadMoreBooks").html("没有啦");
            }
            $.each(result,function(i,ite){
                var item=result[i];
                var html=`<div title="点击显示详情" id="board-book-item-`+String(curBooks)+`" class="board-item">
                            <div class="board-thumb" style="background-image:url(`+item.img+`)"></div>
                            <div class="board-title">`+item.title+`</div>
                            <div class="board-info" title="点击关闭详情">
                                <p class="board-info-basic">
                                书名：`+item.title+`<br>
                                评分：`+item.rating+`<br>
                                作者：`+item.author+`<br>
                                链接：<a target="_blank" href="`+item.link+`">豆瓣阅读</a><br>
                                简介：<br>
                                </p>
                                <p class="board-info-summary">
                                    `+item.summary+`
                                </p>
                            </div>
                        </div>`;
                $(".book-list").append(html);            
                curBooks++;
            });
        });    
    },
    
    loadMovies : function(){
        if(window.location.pathname!="/movie" && window.location.pathname!="/movie.html" && window.location.pathname!="/movie") return;
        $(".loadmore").html("加载中...");
        $.getJSON("https://api.imalan.cn/Douban/getMovies.php?from="+String(curMovies),function(result){
            $('.loadmore').html("加载更多");
            if(result.length<10){
                $("#loadMoreMovies").html("没有啦");
            }
            $.each(result,function(i,ite){
                var item=result[i];
                var html=`<div id="board-movie-item-`+String(curMovies)+`" class="board-item">
                            <div class="board-thumb" style="background-image:url(`+item.img+`)"></div>
                            <div class="board-title"><a href="`+item.url+`" target="_blank">`+item.name+`</a></div>
                        </div>`;
                $(".movie-list").append(html);            
                curMovies++;
            });
        });    
    },

    reloadMathJAX : function(){
        if (typeof MathJax !== 'undefined') // support MathJax
                MathJax.Hub.Queue(["Typeset",MathJax.Hub])
    },

    reloadLike : function(){
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
                $('.like-num').text(parseInt(zan) + 1);
                },'json');
            });
    }
}

$(document).ready(function(){
    RAW.initRAW();
    hljs.initHighlightingOnLoad();
    registerTOC($("#TOC"));
})
$(document).click(function(e){
    var target=e.target;
    $(".board-item").removeClass("board-info-show");
    $(".board-item").each(function(){
        if($(target).parent()[0]==$(this)[0] || $(target)==$(this)[0]){
            $(this).addClass("board-info-show");
        }
    })
})
$(document).scroll(function(){
	var before = $(document).scrollTop();
    $(document).scroll(function() {
        var after = $(document).scrollTop();
        if (before<after && after>40 ) {
            $("#header-nav").css("transform","translateY(-100%)");
            before = after;
        };
        if (before>after || after<=40) {
            $("#header-nav").css("transform","translateY(0)");
            before = after;
        };
    });
});
$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, {container: '#comments',fragment: '#comments',timeout: 8000});
})
$(document).on('pjax:start', function(event) {
    $(".noscroll").hide();
    $("#loading").show();
    $("#pjax-container").fadeTo(1,0.1);
    $("#aside").removeClass("show-aside");
    $(document).scrollTop(0);
})
$(document).on('pjax:end', function() {
    var arr=window.location.pathname.split("/");
    if(arr[arr.length-1]=="comment"){
        arr=arr.slice(0,arr.length-1);
        var fixurl=arr.join("/")+"/#comments";
        $.pjax({url: fixurl, container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
    }else{
        $("#loading").fadeOut(150);
        $("#pjax-container").fadeTo(500,1);
        if($(window.location.hash).length>0){
            setTimeout("$(document).scrollTop($(window.location.hash).offset().top-40)",400);
        }
    }
})
$(".noscroll").click(function(){
    $("#aside").removeClass("show-aside");
    $(".noscroll").fadeOut(200);
})
$("body").keydown(function(event){　　
    if(event.keyCode == 27){
        toggleSearch();
    }
});