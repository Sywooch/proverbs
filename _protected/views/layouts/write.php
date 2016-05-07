<?php 
use yii\helpers\Html;
?>
<?= Html::textarea('', null, ['id' => 'send', 'type' => 'textarea', 'class' => 'form-control pva-form-control', 'maxlength' => 255, 'rows' => 3]) ?>

<?php
$fetchInt = json_encode(Yii::$app->params['fetchInterval']);
$push = json_encode(Yii::$app->request->baseUrl . '/site/write?data=');
$write = <<< JS
$(document).ready(function(){
	var sb = $('#sb-btn1');
	var send = $('#send');
	var board = $('#board-list');

	document.getElementById('send').addEventListener('keydown', function(e){
	    if(!e.shiftKey && e.keyCode === 13 && $('#send').is(':focus')){
			write();
	    }
	}, false);

	send.click(function(){
		if($('body').hasClass('sidebar-narrow')){
			sb.click();
		}
	});

	function fetch(){
		$.pjax.reload({container:'#board-list'});
	}

	function clr(){
		setTimeout(function(){
			send.val('');
			fetch();
		}, 2);
	}

	function write(){
		$.ajax({
            type: 'POST',
            url: $push + JSON.stringify({
                    msg: send.val(),
                }),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: clr(),
        });
	}
});
JS;
$this->registerJs($write);
?>