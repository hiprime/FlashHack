(function($){
	$(function(){
	    $('textarea').attr('placeholder', 'message');
		$('#gwidget-text-4-1').attr('placeholder', 'name');
		$('#gwidget-text-4-2').attr('placeholder', 'e-mail address');
		
		$('[placeholder]').ahPlaceholder({
			placeholderColor : 'silver',
			placeholderAttr : 'placeholder',
			likeApple : false
			});
		
		$('div[class*="textwidget"]').each(function(){
			$(this).replaceWith($(this).html());
		});
		
		var wH = $(window).height();
		$('.main').css('min-height',wH-300 + 'px');
		$('#main').css('min-height',wH-300 + 'px');
	});
	
	$(window).resize(function(){
		var wH = $(window).height();
		$('.main').css('min-height',wH-300 + 'px');
		$('#main').css('min-height',wH-300 + 'px');
	})
})(jQuery);
