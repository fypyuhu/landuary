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
   
});

