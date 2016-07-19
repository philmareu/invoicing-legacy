$(function(){
    
    // Mark workorders complete
	$('a.workorder-completed').on('click', function( e ) {
	    
	    e.preventDefault();
	    
        if (confirm("Are you sure you want to complete this work order?"))
        {
			var $this = $( this );
            var workorderId = $this.attr('id');
			
			$this.html('Marking complete <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
            
            $.ajax({
                type: "GET",
                url: SITE_URL + "/workorders/mark_completed/" + workorderId
            })
            .done(function( data ) {
            
                var status = $.parseJSON(data).status;
                var html = $.parseJSON(data).html;
            
                if(status == 'success')
                {
                    $('a.workorder-completed').remove();
                    $('a.toggle-time').remove();
                    $('div.status').html( html );
                    $('div.status').attr('class', 'uk-alert uk-alert-danger');
                }
				
				else
				{
					alert('An error occurred. Please make sure you have completed all tasks.');
					$this.html('<i class="uk-icon-check"></i> Mark Completed');
				}
            
            })
        }

	});
	
});
