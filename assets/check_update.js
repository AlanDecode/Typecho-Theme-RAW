if(document.getElementById("raw-check-update")){
    var container=document.getElementById("raw-check-update");
    var ajax = new XMLHttpRequest();
    ajax.open('get','https://api.github.com/repos/AlanDecode/Typecho-Theme-RAW/releases/latest');
    ajax.send();
    container.innerHTML=`<h3>正在检测主题是否有更新……</h3>`;
    ajax.onreadystatechange = function () {
        if (ajax.readyState==4 &&ajax.status==200) {
            var obj=JSON.parse(ajax.responseText);
            var newest=parseFloat(obj.tag_name);
            if(newest>RAW_VER){
                container.innerHTML=`<h3>哇！主题有新的发布版~</h3>
                <p>您现在的版本：`+RAW_VER+`</p>
                <p>GitHub 最新发布版：`+obj.name+`，下载地址：<a href="`+obj.zipball_url+`">点击下载</a></p>`;
            }else{
                container.innerHTML=`<h3>真棒！您现在使用的是最新版主题：`+obj.name+`。</h3>`;
            }
        }
    }
}