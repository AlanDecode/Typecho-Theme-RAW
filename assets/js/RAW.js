// RAW.js
// Author: 熊猫小A
// Link: https://imalan.cn

console.log(`%c Theme RAW 0.1 %c https://blog.imalan.cn/archives/163/ `, `color: #fadfa3; background: #23b7e5; padding:5px 0;`, `background: #1c2b36; padding:5px 0;`);

var MD5=function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]|(G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k="",F="",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F="0"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,"n");var d="";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};

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
    toggleSearch();
    $.pjax({url: t, container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
}

function entersearch(){
    var event = window.event || arguments.callee.caller.arguments[0];  
    if (event.keyCode == 13)  {  
        startSearch();  
    }
}

function AjaxComment(){
    var cmtAuthorName;
    var cmtAuthorMail;
    var cmtAuthorLink;
    var cmtParentAuthor="";
    var cmtAuthorImg="";
    var cmtContent;
    var cmtByAuthor="";
    if($("#logged-in").length<1){
        if(!$("#author").val() || !$("#mail").val() || !$("#textarea").val()){
            alert("还没填好就想提交？");
            return;
        }
        cmtAuthorName=$("#author").val() + `<span style="color:red">   `+commentModText+`</span>`;
        cmtAuthorMail=$("#mail").val();
        cmtAuthorLink=$("#url").val()
    }else{
        cmtAuthorLink=$("#logged-in").attr("data-url");
        cmtAuthorMail=$("#logged-in").attr("data-email");
        cmtAuthorName=$("#logged-in").attr("data-name")+ `<span style="color:red">   评论成功！</span>`;
        cmtByAuthor=" comment-by-author";
    }

    var parent = -1;
    var arr=$("#comment-form").serializeArray();
    $.each(arr,function(i,item){
        if(item.name=="parent") parent=item.value;
        if(item.name=="text") cmtContent=item.value;
    });

    cmtAuthorImg='https://secure.gravatar.com/avatar/' + MD5(cmtAuthorMail) + '?s=100';
    $("#comment-submit-button").html(`<i class="fa fa-spin fa-circle-o-notch"></i> 提交中`)
    $.ajax({
        type: "POST",
        url: $("#comment-form").attr("action"),
        data: $("#comment-form").serialize(),
        success: function (data) {
            var Obj = $("<code></code>").append($(data));
            if($(Obj).find("title").text()!="Error"){
                // 构造并附加评论
                var html="";
                if(parent==-1){
                    parent="#comments > .comment-list";
                    html=`<li class="comment-body comment-parent`+cmtByAuthor+`"><div class="comment-author"><span><img class="avatar" src="`+cmtAuthorImg+`"></span><cite class="fn"><a href="`+cmtAuthorLink+`" target="_blank">`+cmtAuthorName+`</a></cite></div><div class="comment-meta"><a href=""><time>刚刚</time></a></div><div class="comment-content"><p>`+cmtContent+`</p></div></li>`;
                    $(parent).prepend(html);
                }else{
                    parent="#comment-"+parent;
                    cmtParentAuthor=$(parent+">.comment-author").text();
                    html=`<div class="comment-children"><ol class="comment-list"><li class="comment-body comment-child`+cmtByAuthor+`"><div class="comment-author"><span><img class="avatar" src="`+cmtAuthorImg+`"></span><cite class="fn"><a href="`+cmtAuthorLink+`" target="_blank">`+cmtAuthorName+`</a></cite></div><div class="comment-meta"><a href=""><time>刚刚</time></a></div><div class="comment-content"><p><span class="comment-reply-author">@`+cmtParentAuthor+`</span>`+cmtContent+`</p></div></li></ol></div>`;
                    $(parent).append(html);
                }
                // 重置
                TypechoComment.cancelReply();
                $("#textarea").val("");
            }
            else{
                alert($(Obj).find("div.container").text());
            }
            $("#comment-submit-button").html("提交评论");
        },
        error: function () {
            $("#comment-submit-button").html("提交评论");
            alert("评论失败！");
        }
    })
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

        $(document).pjax(`a[data-pjax="1"]:not(a[no-pjax="1"])`,{container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
    },

    parseImgGrid : function(){
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
    },

    registerAjaxComment : function(){
        var mysubmit=document.getElementById('comment-submit-button');
        if($(mysubmit).length<1) return;
        mysubmit.onclick=function(event){
            event.preventDefault();
            AjaxComment();
        }
    }

}

$(document).ready(function(){
    RAW.initRAW();
    hljs.initHighlightingOnLoad();
    registerTOC();
    registerAside();
    RAW.registerAjaxComment();
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
    if($(window).width()>1024) return;
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
    $("#loading").fadeOut(150);
    $("#pjax-container").fadeTo(500,1);
    if($(window.location.hash).length>0){
        setTimeout("$(document).scrollTop($(window.location.hash).offset().top-40)",400);
    }
    RAW.registerAjaxComment();
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