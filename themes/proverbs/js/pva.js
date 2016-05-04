$(function() {
	var st = $('#st');
	var bc = $('#bm > .item > .top.aligned.content');

	if($(document).width() < 991){
		if(st.hasClass('page-content')){
			enableOverlay();
		}else {
			disableOverlay();
		}
	}

	function enableOverlay(){
		st.removeClass('page-content').addClass('ui container');
	}

	function disableOverlay(){
		st.removeClass('ui container').addClass('page-content');
	}

	$(window).resize(function(){
		if($(document).width() < 991){
			if(st.hasClass('page-content')){
				enableOverlay();
			}
		}else {
			disableOverlay();
		}
	});

	$('.page-content').wrapInner('<div class="ui container"></div>');

	//BTN1
	$(document).on('click', '.sidebar-toggle-menu', function (e) {
	    e.preventDefault();
    	$('body').toggleClass('sidebar-narrow');
    	bc.toggleClass('hidden');

	    if ($('body').hasClass('sidebar-narrow')) {
		    $('.sidebar-content').hide().delay().queue(function(){
		    	$(this).show().clearQueue();
		    	bc.removeClass('hidden');
		    });
	    } else {
		    $('.sidebar-content').hide().delay().queue(function(){
		        $(this).show().clearQueue();
		        bc.removeClass('hidden');
		    });
	    }
	});

});