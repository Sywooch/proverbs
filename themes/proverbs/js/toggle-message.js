$(document).ready(function(){
	var btn_remove = $('#btn-msg-toggle');
	var msg = $('#toggle-board-menu');
	var board = $('#messages');
	var main_content = $('#main-content');
	var msg_collapsed = true;

	function hideMsg(){
		board.hide();
		//main_content.removeClass('col-lg-8 col-md-8').addClass('col-lg-12 col-md-12');
	}
	function showMsg(){
		board.show();
		//main_content.removeClass('col-lg-12 col-md-12').addClass('col-lg-8 col-md-8');
	}

	btn_remove.click(function(){
		msg_collapsed = true;
		hideMsg();
		msg.show();
	});

	msg.click(function(){
		if(msg_collapsed){
			msg_collapsed = false;
			msg.hide();
			showMsg();
			$("#message-content-panel").scrollTop($("#message-content-panel")[0].scrollHeight);
		}else {
			msg_collapsed = true;
			hideMsg();
		}
	});
});