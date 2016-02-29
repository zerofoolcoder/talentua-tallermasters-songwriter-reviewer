(function( $ ) {
	'use strict';
	$(document).ready(function(){
    $(".do-ajax").click(function() {
      $("div#divLoading").addClass('show');
			var status = $(this).attr("id");
			var sub_id = $(this).attr("data-id");
			var data = {
				action: 'tal_tm_swr_review_candidate',
				sub_id: sub_id,
				status: status
			}

			$.post(tal_tm_swr_review_candidate.ajaxurl, data, function (response) {
				//var message = $(response).find('supplemental sub_id').text() + ' ' + $(response).find('supplemental status').text() + ' ' + $(response).find('supplemental message').text();
				//alert(message);
				//location.reload();
				location = location.protocol +"//"+ location.hostname + location.pathname;
			});
		});
	});
})( jQuery );
