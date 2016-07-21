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

    // Toggle time
    $('.toggle-time').on("click", function( ) {

        var workorderId = $(this).attr('id');

        $this = $(this);

        $this.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
            type: "PUT",
            url: SITE_URL + "/times/toggle",
            data: {_token: csrf, work_order_id: workorderId},
            success: function (response) {
                console.log(response.status);

                if(response.status == 'stopped') {
                    $this.html('<i class="uk-icon-play"></i>').prop('disabled', false);
                    $('i.uk-icon-stop').attr('class', 'uk-icon-play');
                    $('.timer').text('').attr('data-invoicing-work-order-id', '');
                    $('.toggle-time').attr('class', 'uk-button toggle-time uk-text-success');
                } else {
                    $this.html('<i class="uk-icon-stop"></i><span class="timer"> 0:00</span>').prop('disabled', false);
                    $('.toggle-time').attr('class', 'uk-button toggle-time uk-text-danger');
                    $('i.uk-icon-play').attr('class', 'uk-icon-stop');
                }
            }
        });

    });
	
});

$(function(){

    // Add task Modal
	$('a#add-task').on('click', function(e){
        id = $( this ).attr('data-invoicing-work-order-id');
        uri = "/tasks/create/" + id;

        getModal(uri);

	});
    
    // Save task
	$('#modal').on("click", 'button#save-task', function( event ) {
	    
	    event.preventDefault();
		button = $( this );
		button.html('Saving <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    
        var modal = $.UIkit.modal("#modal");
	    
	    uri = "/tasks";
	    data = $("form#add-task").serialize();
        
        $.ajax({
    		type: "POST",
    		url: SITE_URL + uri,
    		data: data
    	})
    	.done( function( response ) {

            if(response.status == 'saved')
    		{
				if ($('.uncompleted-tasks tr.task').length == 0) {
    		        table = '<div class="uk-overflow-container"><table class="uk-table uk-table-striped uk-table-condensed tasks uncompleted"><caption class="uk-margin-bottom">These are tasks assigned to this work order.</caption><tbody>' + results.html + '</tbody></table></div>';
    		        
    		        $('p.no-tasks').remove();
    		        $('.uncompleted-tasks').html( table );
                }
                
                else {
                    $('table.tasks tbody').append( response.html );
                }

    			modal._hide();
    		}

    	});
		
	});

    // Edit task Modal
	$('.uncompleted-tasks, .completed-tasks').on('click', 'a.edit-task', function(){
	    
        taskId = $( this ).attr('id');
        uri = "/tasks/" + taskId + "/edit";
        
        getModal(uri);
		
	});
	
	// Update task
	$('#modal').on("click", 'button#update-task', function( event ) {
	    
	    event.preventDefault();
        var button = $( this );
        var modal = $.UIkit.modal("#modal");
        var form = button.parents('form');
        var action = form.attr('action');

		button.html('Updating <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
    		type: "PUT",
    		url: action,
    		data: form.serialize()
    	})
    	.done( function( response ) {

            if(response.status == 'saved')
    		{
                $('table.tasks tr#row-' + response.task.id).replaceWith( response.html );

    			modal._hide();
    		}

    	});
		
	});

    // Delete task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.delete-task', function(event){
        
        event.preventDefault();

        taskId = $( this ).attr('id');
        
        if (confirm("Are you sure?"))
		{
		    $.ajax({
                type: "DELETE",
                url: SITE_URL + "/tasks/" + taskId,
                data: {_token: csrf}
            })
            .done( function( response ) {

                if(response.status == 'success')
                {
                    $('tr#row-' + taskId).remove();
                }			
            })
		}

    });

    // Toggle task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.toggle-task', function( event ){

        event.preventDefault();

        var $taskId = $( this ).attr('id');

        $.ajax({
            type: "PUT",
            url: SITE_URL + "/tasks/toggle/" + $taskId,
            data: {_token: csrf}
        })
        .done( function( response ) {

            if(response == 'completed')
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-check-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.completed tbody'));
            }
            else
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.uncompleted tbody'));
            }

        })

    });

});
$(function(){
    
    
    // Add Time Modal
	$('a#add-time').on('click', function(){
	    
        workorderId = $( this ).attr('class');
        uri = "/times/create/" + workorderId;
        
        getModal(uri);
		
	});
    
    // Save time
	$('#modal').on("click", 'button#save-time', function( event ) {
	    
	    event.preventDefault();
	    
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
    		    if ($('tr.time').length == 0) {
    		        table = '<div class="uk-overflow-container"><table class="uk-table uk-table-striped uk-table-condensed times uk-text-nowrap"><thead><tr><th>Start</th><th>Stop</th><th>Total</th><th>&nbsp;</th></tr></thead><tbody>' + response.html + '</tbody></table></div>';
    		        
    		        $('.no-times').remove();
    		        $('.timesheet').after( table );
                }
                
                else {
                    $('table.times tbody').append( response.html );
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

		var button = $( this );
        var form = button.parents('form');
        var action = form.attr('action');

		button.html('Updating <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        var modal = $.UIkit.modal("#modal");

        $.ajax({
            type: "PUT",
            url: action,
            data: form.serialize()
        })
        .done( function( response ) {

            if(response.status == 'saved')
            {
                $('table.times tr#row-' + response.time.id).replaceWith( response.html );

                modal._hide();
            }

        });

	});
	
	// Delete time
    $('.timesheet').on('click', 'a.delete-time', function(event){
		
		event.preventDefault();

        time_id = $( this ).attr('id');
		
        if (confirm("Are you sure?"))
		{
	        $.ajax({
	            type: "DELETE",
	            url: SITE_URL + "/times/" + time_id,
                data: {_token: csrf}
	        })
	        .done( function( response ) {

                if(response.status == 'success') {
	                var total_time = response.totalTime;
	                var workorder_id = response.workOrder.id;
                    
	                $('span.total-time-' + workorder_id).html( total_time );
	                $('tr#row-' + time_id).remove();
	            }			
	        })
		}

    });
    
});
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
//# sourceMappingURL=workorder.js.map
