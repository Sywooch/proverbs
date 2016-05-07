$(function() {
	var bc = $('#bm > .item > .top.aligned.content, #bm > .item > .bottom.aligned.content');

	if($('body').hasClass('sidebar-narrow')){
		bc.addClass('hidden');
	}else {
		bc.removeClass('hidden');
	}

	$('.page-content').wrapInner('<div class="ui container"></div>');

	//BTN1
	$(document).on('click', '#sb-btn1', function (e) {
	    e.preventDefault();
    	//$('body').toggleClass('sidebar-narrow');

    	if($('body').hasClass('sidebar-narrow')){
    		$('body').removeClass('sidebar-narrow');
    		bc.removeClass('hidden');
    	}else {
    		$('body').addClass('sidebar-narrow');
    		bc.addClass('hidden');
    	}
	});

});