$(function() {
	var bc = $('#bm > .item');
	var send = $('#send');

	if($('body').hasClass('sidebar-narrow')){
		send.attr('placeholder','');
	}else {
		send.attr('placeholder','Write something...');
	}

	$('.page-content').wrapInner('<div class="ui container"></div>');

	//BTN1
	$(document).on('click', '#sb-btn1', function (e) {
	    e.preventDefault();
    	//$('body').toggleClass('sidebar-narrow');

    	if($('body').hasClass('sidebar-narrow')){
			$('body').removeClass('sidebar-narrow');
			send.attr('placeholder','Write something...');
    	}else {
    		$('body').addClass('sidebar-narrow');
			send.attr('placeholder','');
    	}

	});

});