$(document).ready(function () {
	$(".jqx-rc-all").focus(function(){
		$(this).select();
	});
	
	alert($('.jqx-action-button').length);
	
		$('.jqx-action-button').each(function( index ) {
			$(this).prop('style').removeProperty('left');
		});
});