$(document).ready(function () {
	$(".jqx-rc-all").focus(function(){
		$(this).select();
	});
	
	$('.jqx-action-button').each(function( index ) {
		$(this).prop('style').removeProperty('left');
	});
});