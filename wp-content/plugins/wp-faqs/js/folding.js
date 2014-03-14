jQuery(function(){
	
	jQuery('dl.folding-faq-list dd').hide();
	
	jQuery('dl.folding-faq-list dt').css('cursor', 'pointer').click(function(){
		jQuery(this).next('dd').slideToggle();
	});
	
	jQuery('ol.faq-index a').click(function(){
		var target = jQuery(this).attr('href');
		target.replace("#", "");
		jQuery('dl.folding-faq-list dt#' + target).next('dd').show();
	});
	
});