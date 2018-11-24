// RAW.js
// Author: 熊猫小A
// Link: https://www.imalan.cn

RAW={
    // 初始化单页应用
    init : function(){

    },

    beforePjax:function(){

    },

    afterPjax:function(){
        // 重载 OWO
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
}

$(document).ready(function(){
    RAW.init();
})

$(document).on('pjax:complete',function(){
    RAW.afterPjax();
})