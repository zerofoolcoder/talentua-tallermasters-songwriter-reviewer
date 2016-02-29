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
	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

})( jQuery );
