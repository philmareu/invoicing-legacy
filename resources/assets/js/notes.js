$(function(){
    
    // Add Note Modal
	$('a#add-note').on('click', function(e){
	    
        resourceString = $( this ).attr('class');
        uri = "/notes/create/" + resourceString;
        
        getModal(uri);
		
	});
    
    // Save note
	$('#modal').on("click", 'button#save-note', function( e ) {
	    
	    e.preventDefault();
		
		button = $( this );
		
		button.html('Saving <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    
	    var modal = $.UIkit.modal("#modal");
	    
	    uri = "/notes";
	    data = $("form#add-note").serialize();
        
        $.ajax({
    		type: "POST",
    		url: SITE_URL + uri,
    		data: data
    	})
    	.done( function( data ) {

            var results = $.parseJSON(data);

            if(results.status == 'saved')
    		{
                if ($('div.note').length == 0) {
    		        $('.no-notes').remove();
    		        $('div.notes').html( results.html );
                }
                
                else {
                    $('div.notes').append( results.html );
                }

    			modal._hide();
    		}

    	});
		
	});
	
});