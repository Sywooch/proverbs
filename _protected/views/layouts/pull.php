<?php 
use yii\helpers\Html;
use app\models\Board;
use app\models\DataCenter;
?>
<?php
$pull_url = json_encode(Yii::$app->request->baseUrl . '/site/pull');

$more_announcement_url = json_encode(Yii::$app->request->baseUrl . '/site/more-announcement');
$more_board_url = json_encode(Yii::$app->request->baseUrl . '/site/more-board');


$push_announcement_url = json_encode(Yii::$app->request->baseUrl . '/site/write-announcement?data=');
$push_board_url = json_encode(Yii::$app->request->baseUrl . '/site/write-board?data=');


$boardInt = json_encode(Yii::$app->params['boardInterval']);

$pull = <<< JS
(function($){
	$(window).load(function(){
		var sidebar_btn = $('#sb-btn1');
		var items = $('#bm > .item');
		var send = $('#send');
		var ann_badge = $('.notify.announcement');
		var ann_icon = $('#new-announcement');
        var send2 = $('#anc-send');
		var board = $('#board-list');
        var tf = $('#ann-form');
		var view_more_announcement = $('#view-more-announcement');
		var view_more_board = $('#view-more-board');

		ann_icon.click(function(){
			if(!$(ann_badge).hasClass('hidden')){
				$(ann_badge).addClass('hidden');
			}
		});

		send.click(function(){
			if($('body').hasClass('sidebar-narrow')){
				sidebar_btn.click();
			}
		});

		document.getElementById('send').addEventListener('keydown', function(e){
		    if(!e.shiftKey && e.keyCode === 13 && $('#send').is(':focus')){
				writeBoard();
				setTimeout(function(){
					send.val('');
				},2);
		    }
		}, false);


        send2.click(function(){
            writeAnnouncement();
            setTimeout(function(){
                tf.val('');
            }, 2);
        });

		
		function writeAnnouncement(){
            $.ajax({
                type: 'POST',
                url: $push_announcement_url + JSON.stringify({
                        msg: tf.val(),
                    }),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
	            success: function(data){
					$.pjax.reload({container:'#anc-list-modal'});
					console.log(data);
	            },
            });
        }

		function writeBoard(){
			$.ajax({
	            type: 'POST',
	            url: $push_board_url + JSON.stringify({
	                    msg: send.val(),
	                }),
	            contentType: 'application/json; charset=utf-8',
	            dataType: 'json',
	            success: function(data){
	            	console.log('sending...');
					$.pjax.reload({container:'#board-list'});
					console.log(data);
	            },
	        });
		}

		view_more_announcement.click(function(){
			$(this).addClass('loading');
			$.ajax({
                type: 'POST',
                url: $more_announcement_url,
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(data){  
                    console.log(data);
                    $('#a_new_size').html(data.announcementSize);
                    if(data.pjax){
                    	$.pjax.reload({container:'#anc-list-modal'});
                		setTimeout(function(){
							view_more_announcement.removeClass('loading');
                		}, 1000);
                    }else {
            			view_more_announcement.removeClass('loading').addClass('disabled');
                    }
                },
        	});
		});

		view_more_board.click(function(){
			$(this).addClass('loading');
			$.ajax({
                type: 'POST',
                url: $more_board_url,
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(data){  
                    console.log(data);
                    $('#b_new_size').html(data.size);
                    if(data.pjax){
                    	$.pjax.reload({container:'#board-list'});
                		setTimeout(function(){
							view_more_board.removeClass('loading');
                		}, 1000);
                    }else {
            			view_more_board.removeClass('loading').addClass('disabled');
                    }
                },
        	});
		});

		function pull(){
			$.ajax({
                type: 'POST',
                url: $pull_url,
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                success: function(data){  
                	//console.log(data);
                    if(data.pjaxBoard){
                    	$.pjax.reload({container:'#board-list'});
                    }
                    if(data.pjaxAnnouncement){
                    	$.pjax.reload({container:'#anc-list-modal'});
                    	if(!$('body').hasClass('modal-open')){
							ann_badge.removeClass('hidden');
                    	}
                    }
                },
        	});
		}

		setInterval(function(){
			pull();
		}, 4900);
	});
})(jQuery);
JS;
$this->registerJs($pull);
?>