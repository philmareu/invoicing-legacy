$(function(){
    
    
    // Add Time Modal
	$('a#add-time').on('click', function(){
	    
        workorderId = $( this ).attr('class');
        uri = "/times/create/" + workorderId;
        
        getModal(uri);
		
	});
    
    // Save time
	$('#modal').on("click", 'button#save-time', function( e ) {
	    
	    e.preventDefault();
	    
		button = $( this );
		
		button.html('Saving <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
		
	    var modal = $.UIkit.modal("#modal");
	    
	    uri = "/times";
	    data = $("form#add-time").serialize();
        
        $.ajax({
    		type: "POST",
    		url: SITE_URL + uri,
    		data: data
    	})
    	.done( function( data ) {

            var results = $.parseJSON(data);

            if(results.status == 'saved')
    		{
    		    if ($('tr.time').length == 0) {
    		        table = '<div class="uk-overflow-container"><table class="uk-table uk-table-striped uk-table-condensed times uk-text-nowrap"><thead><tr><th>Start</th><th>Stop</th><th>Total</th><th>&nbsp;</th></tr></thead><tbody>' + results.html + '</tbody></table></div>';
    		        
    		        
    		        $('.no-times').remove();
    		        $('.timesheet').after( table );
                }
                
                else {
                    $('table.times tbody').append( results.html );
                }

    			modal._hide();
    		}

    	});
		
	});
	
    // Edit task Modal
	$('.timesheet').on('click', 'a.edit-time', function(){
	    
        timeId = $( this ).attr('id');
        uri = "/times/" + timeId + "/edit";

        getModal(uri);
		
	});  

	
	// Update time
	$('#modal').on("click", 'button#update-time', function( e ) {

	    e.preventDefault();

		button = $( this );

		button.html('Updating <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

	        var modal = $.UIkit.modal("#modal");

	        timeId = $('input#time-id').val();

	    uri = SITE_URL + "/times/" + timeId;
	    data = $("form#edit-time").serialize();

	        $.ajax({
	    		type: "PATCH",
	    		url: uri,
	    		data: data
	    	})
	    	.done( function( data ) {

	            var results = $.parseJSON(data);

	            if(results.status == 'saved')
	    		{
	    		    var html = $.parseJSON(data).html;

	                $('table.times tr#row-' + timeId).replaceWith( html );

	    			modal._hide();
	    		}

	    	});

	});
	
	// Delete time
    $('.timesheet').on('click', 'a.delete-time', function(e){
		
		e.preventDefault();

        time_id = $( this ).attr('id');
		
        if (confirm("Are you sure?"))
		{
	        $.ajax({
	            type: "DELETE",
	            url: SITE_URL + "/times/" + time_id
	        })
	        .done( function( data ) {

	            var status = $.parseJSON(data).status;

	            if(status == 'success')
	            {
	                var total_time = $.parseJSON(data).total_time;
	                var workorder_id = $.parseJSON(data).workorder_id;
                    
	                $('span.total-time-' + workorder_id).html( total_time );
	                $('tr#row-' + time_id).remove();
	            }			
	        })
		}

    });
    
});