$(function() {
    if($('#wmd-button-row').length>0)$('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1" id="wmd-spacer5"></li><li class="wmd-button" id="wmd-photoset-button" style="" title="插入图集">图集</li>');
	$(document).on('click', '#wmd-photoset-button', function() {
        $('body').append(
            '<div id="RAWPhotoSetPanel">'+
				'<div class="wmd-prompt-background" style="position: absolute; top: 0px; z-index: 1000; opacity: 0.5; height: 875px; left: 0px; width: 100%;"></div>'+
                '<div class="wmd-prompt-dialog">'+
                    '<div>'+
                        '<p><b>插入图集</b></p>'+
                        '<p>请在下方的输入框内输入要插入图集每行照片数（2 或者 3）</p>'+
                        '<p><input type="text"></input></p>'+
                    '</div>'+
                    '<form>'+
    					'<button type="button" class="btn btn-s primary" id="photos-ok">确定</button>'+
                        '<button type="button" class="btn btn-s" id="photos-cancel">取消</button>'+
                    '</form>'+
				'</div>'+
			'</div>');
        $('.wmd-prompt-dialog input').val('2').select();
	});
    $(document).on('click','#photos-cancel',function() {
        $('#RAWPhotoSetPanel').remove();
        $('textarea').focus();
    });
    $(document).on('click','#photos-ok',function() {
        myField = document.getElementById('text');
        var data=$('.wmd-prompt-dialog input').val();
        $('#RAWPhotoSetPanel').remove();
        if (document.selection) {
			myField.focus();
			sel = document.selection.createRange();
            sel.text = `
[photos col="`+data+`" des=""]`+sel.text+`

[/photos]
`;
			myField.focus();
		}
        else if (myField.selectionStart || myField.selectionStart == '0') {
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
            + `
[photos col="`+data+`" des=""]

[/photos]
`
			+ myField.value.substring(endPos, myField.value.length);
            myField.focus();
            myField.selectionStart=startPos;
            myField.selectionEnd=startPos;
		}
        else{
            myField.value +=`
[photos col="`+data+`" des=""]

[/photos]
`;
			myField.focus();
		}
    });
});
