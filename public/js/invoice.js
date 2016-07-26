$(function(){
    
    // Add Note Modal
	$('a#add-note').on('click', function(e){

        var resourceId = $('meta[name="resource-id"]').attr('content');
        var resourceModel = $('meta[name="resource-model"]').attr('content');
        resourceString = $( this ).attr('class');
        uri = "/notes/create?resource_id=" + resourceId + "&resource_model=" + resourceModel;
        
        getModal(uri);
		
	});
    
    // Save note
	$('#modal').on("click", 'button#save-note', function( e ) {
	    
	    e.preventDefault();
		
		var button = $( this );
        var form = button.parents('form');
        var action = form.attr('action');
		
		button.html('Saving <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    var modal = $.UIkit.modal("#modal");
        
        $.ajax({
    		type: "POST",
    		url: action,
    		data: form.serialize()
    	})
    	.done( function( response ) {

            if(response.status == 'saved')
    		{
                if ($('div.note').length == 0) {
    		        $('.no-notes').remove();
    		        $('#notes').html( response.html );
                }
                
                else {
                    $('#notes').append( response.html );
                }

    			modal._hide();
    		}

    	});
		
	});
	
});
$(function() {

    // Mark workorders complete
    function deleteInvoiceListener() {
        $('a#delete-invoice').one('click', function( event ) {

            event.preventDefault();
            var button = $( this );
            var invoiceId = button.attr('data-invoicing-invoice-id');
            button.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

            if (confirm("Are you sure you want to delete this invoice?"))
            {
                $.ajax({
                    type: "POST",
                    url: SITE_URL + "/invoices/" + invoiceId,
                    data: {_token: csrf, _method: 'DELETE'}
                })
                    .done(function( response ) {
                        if(response.status == 'deleted') {
                            console.log('deleted');
                        } else {
                            console.log('unauthorized');
                        }
                    });

                deleteInvoiceListener();
            }

        });
    }

    deleteInvoiceListener();

});
//# sourceMappingURL=invoice.js.map
