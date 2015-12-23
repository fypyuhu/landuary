$(document).ready(function () {
	$(".jqx-rc-all").focus(function(){
		$(this).select();
	});
	
	$('.jqx-action-button').prop('style').removeProperty('left');
});