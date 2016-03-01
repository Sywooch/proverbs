$(document).ready(function(){
	var msg = $('#btn-msg-toggle');
	var board = $('#messages');
	var main_content = $('#main-content');
	var msg_collapsed = false;

	function hideMsg(){
		board.hide();
		main_content.removeClass('col-lg-8 col-md-8').addClass('col-lg-12 col-md-12');
	}
	function showMsg(){
		board.show();
		main_content.removeClass('col-lg-12 col-md-12').addClass('col-lg-8 col-md-8');
	}

	msg.click(function(){
		if(msg_collapsed){
			msg_collapsed = false;
			showMsg();
			console.log(msg_collapsed);
		}else {
			msg_collapsed = true;
			hideMsg();
			console.log(msg_collapsed);
		}
	});
});