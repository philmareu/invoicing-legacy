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
//# sourceMappingURL=invoice.js.map
