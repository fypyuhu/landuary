$(document).ready(function () {
    $( "body" ).on( "click", "a[data-mode='ajax']", function(e) {
	  var url = $(this).attr('href');
	  $.fancybox({
			width: 'auto',
			height: 'auto',
			autoSize: false,
			href: url,
			type: 'ajax',
			afterClose : function() {
		  		parent.location.reload(true);
		  	}
		});
	  e.preventDefault();
	});
	
	$( "body" ).on( "click", "a[data-mode='ajax2']", function(e) {
	  var url = $(this).attr('href');
	  $.fancybox({
			width: 'auto',
			height: 'auto',
			autoSize: false,
			href: url,
			type: 'ajax',
			wrapCSS: 'start-machine',
			afterClose : function() {
		  		parent.location.reload(true);
		  	}
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
	
	$( "body" ).on( "click", ".create-clone-button-taxes", function(e) {
		e.preventDefault();
		var corr_div_id = $(this).data('corr-div-id');
		var clone = $(corr_div_id).find('.records_list').clone();
		var count = ($(this).parents('fieldset').find('.records_list').length)+1;
		clone.find('input.component_name').attr('id','component_name_'+count).parent().next().attr('for', 'component_name_'+count);
		clone.find('input.component_agency_name').attr('id','component_agency_name_'+count).parent().next().attr('for', 'component_agency_name_'+count);
		clone.find('input.component_tax_rate').attr('id','component_tax_rate_'+count).parent().next().attr('for', 'component_tax_rate_'+count);
		clone.appendTo($(this).parents('.row').prev('.layout_table'));
		$(this).parents('.row').prev('.layout_table').animate({ scrollTop: $(this).parents('.row').prev('.layout_table')[0].scrollHeight}, 1000);
	});
	
	$( "body" ).on( "click", ".ctabs li", function(e) {
		$(this).parents('.ctabs').find('li').removeClass('current');
		$(this).addClass('current');
		var corr_div_id = $(this).data('corr-div-id');
		toggle($(this).parent().parent().next('.tab-content-group').find('.tab-content'), corr_div_id);
	});
	
	$( "body" ).on( "click", ".ctabsleft a", function(e) {
		$('.ctabsleft').find('a').removeClass('isCurrent');
		$(this).addClass('isCurrent');
		var corr_div_id = $(this).data('corr-div-id');
		toggle('.tab-content', corr_div_id);
	});
});

function toggle(hide, show) {
	hide.css('display', 'none');
	$(show).fadeIn('slow');
}