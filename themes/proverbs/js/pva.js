$('#dropdown-caret').click(function(){
	$('#dropdown-care > i').toggleClass('open');
});

$(function() {
	$('.page-content').wrapInner('<div class="page-content-inner"></div>');


	//OFF CANVAS
	$(document).on('click', '.offcanvas', function () {
		$('body').toggleClass('offcanvas-active');
	});

	//NAVIGATION
	$('.navigation').find('li.active').parents('li').addClass('active');
	$('.navigation').find('li').not('.active').has('ul').children('ul').addClass('hidden-ul');
	$('.navigation').find('li').has('ul').children('a').parent('li').addClass('has-ul');

	$(document).on('click', '.sidebar-toggle', function (e) {
	    e.preventDefault();
	    	$('body').toggleClass('sidebar-narrow');

		    if ($('body').hasClass('sidebar-narrow')) {
		        $('.navigation').children('li').children('ul').css('display', '');

			    $('.sidebar-content').hide().delay().queue(function(){
			        $(this).show().addClass('animated fadeIn').clearQueue();
			    });
			    sidebar = false;
		    } else {
		        $('.navigation').children('li').children('ul').css('display', 'none');
		        $('.navigation').children('li.active').children('ul').css('display', 'block');
			    $('.sidebar-content').hide().delay().queue(function(){
			        $(this).show().addClass('animated fadeIn').clearQueue();
			    });
		    }
	});


	$('.navigation').find('li').has('ul').children('a').on('click', function (e) {
	    e.preventDefault();

	    if ($('body').hasClass('sidebar-narrow')) {
			$(this).parent('li > ul li').not('.disabled').toggleClass('active').children('ul').slideToggle(250);
			$(this).parent('li > ul li').not('.disabled').siblings().removeClass('active').children('ul').slideUp(250);
	    }

	    else {
			$(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(250);
			$(this).parent('li').not('.disabled').siblings().removeClass('active').children('ul').slideUp(250);
	    }
	});

	//PANEL OPTIONS

	//COLLAPSING
	$('[data-panel=collapse]').click(function(e){
	e.preventDefault();
	var $target = $(this).parent().parent().next('div');
	if($target.is(':visible')) 
	{
	$(this).children('i').removeClass('icon-arrow-up9');
	$(this).children('i').addClass('icon-arrow-down9');
	}
	else 
	{
	$(this).children('i').removeClass('icon-arrow-down9');
	$(this).children('i').addClass('icon-arrow-up9');
	}            
	$target.slideToggle(200);
	});

	//CLOSING
	$('[data-panel=close]').click(function(e){
		e.preventDefault();
		var $panelContent = $(this).parent().parent().parent();
		$panelContent.slideUp(200).remove(200);
	});

	//DISABLE MAIN NAV LINKS
	$('.navigation .disabled a, .navbar-nav > .disabled > a').click(function (e){
		e.preventDefault();
	});
	
	$('.panel-trigger').click(function(e){
		e.preventDefault();
		$(this).toggleClass('active');
	});
});