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
	
	var mousemove_counter = 0;
	$( "body" ).on( "mousemove", document, function(e) {
		if(mousemove_counter <= 0){
			layout_table_auto_height(mousemove_counter);
			mousemove_counter = 1;
		}
	});
});

function layout_table_auto_height(mousemove_counter){
	$( ".layout_table .records_list" ).each(function( index ) {
		var height = $( this ).height();
		if(height > 0)
			$(this).css('height', (height+1) + 'px');
	});
	
	$( ".layout_table .heading" ).each(function( index ) {
		var height2 = $( this ).height();
		if(height2 > 0)
			$(this).css('height', (height2+1) + 'px');
	});
}