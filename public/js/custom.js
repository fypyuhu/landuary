$(document).ready(function () {
	$(".jqx-rc-all").focus(function(){
		$(this).select();
	});
	
	if($('.jqx-action-button').length > 0) {
		$('.jqx-action-button').each(function( index ) {
			$(this).prop('style').removeProperty('left');
		});
	}
	
	/*if($('.jqx-combobox-arrow-normal').length > 0) {
		$('.jqx-combobox-arrow-normal').each(function( index ) {
			$(this).prop('style').removeProperty('left');
		});
	}*/
});