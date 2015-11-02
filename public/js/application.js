$(document).ready(function () {
    $( "body" ).on( "click", "a[data-mode='ajax']", function(e) {
	  var url = $(this).attr('href');
	  $.fancybox({
			width: 'auto',
			height: 'auto',
			autoSize: false,
			href: url,
			type: 'ajax'
		});
	  e.preventDefault();
	});
	
	$( "body" ).on( "click", ".radiobutton", function(e) {
		var corr_div_id = $(this).data('corr-div-id');
		var set_class = $(this).data('set-class');
		$(set_class).slideUp('slow');
		if(!$(this).is(':checked')) {
			$(corr_div_id).slideUp('slow');
		} else {
			$(corr_div_id).slideDown('slow');
		}
	});
	
	$( "body" ).on( "click", ".create-clone-button", function(e) {
		e.preventDefault();
		var corr_div_id = $(this).data('corr-div-id');
		var clone = $(corr_div_id).find('.records_list').clone();
		clone.appendTo($(this).parents('.row').prev('.layout_table'));
		$(this).parents('.row').prev('.layout_table').animate({ scrollTop: $(this).parents('.row').prev('.layout_table')[0].scrollHeight}, 1000);
	});
   
});

