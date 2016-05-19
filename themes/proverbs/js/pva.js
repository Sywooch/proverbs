$(function() {
	var bc = $('#bm > .item');
	var send = $('#send');
	var sb_icon = $('#trigger-sidebar > i');

	//IMPACT
	if($('body').hasClass('sidebar-narrow')){
		sb_icon.removeClass('left').addClass('right');
		send.attr('placeholder','');
	}else {
		send.attr('placeholder','Write something...');
		sb_icon.removeClass('right').addClass('left');
	}

	$('.page-content').wrapInner('<div class="ui container"></div>');

	//BTN1
	$(document).on('click', '#sb-btn1', function (e) {
	    e.preventDefault();

    	if($('body').hasClass('sidebar-narrow')){
    		sb_icon.removeClass('right').addClass('left');
			$('body').removeClass('sidebar-narrow');
			send.attr('placeholder','Write something...');
    	}else {
    		sb_icon.removeClass('left').addClass('right');
    		$('body').addClass('sidebar-narrow');
			send.attr('placeholder','');
    	}
	});

});