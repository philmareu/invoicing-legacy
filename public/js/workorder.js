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

$(function(){

    // Add task Modal
	$('a#add-task').on('click', function(e){
	    console.log('madeit');
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
	$('#modal').on("click", 'button#update-task', function( e ) {
	    
	    e.preventDefault();
		
		button = $( this );
		
		button.html('Updating <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    
        var modal = $.UIkit.modal("#modal");
        
        taskId = $('input#task-id').val();
	    
	    uri = SITE_URL + "/tasks/" + taskId;
	    data = $("form#edit-task").serialize();
        
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

                $('table.tasks tr#row-' + taskId).replaceWith( html );

    			modal._hide();
    		}

    	});
		
	});

    // Delete task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.delete-task', function(e){
        
        e.preventDefault();

        taskId = $( this ).attr('id');
        
        if (confirm("Are you sure?"))
		{
		    $.ajax({
                type: "DELETE",
                url: SITE_URL + "/tasks/" + taskId
            })
            .done( function( data ) {

                var status = $.parseJSON(data).status;

                if(status == 'success')
                {
                    $('tr#row-' + taskId).remove();
                }			
            })
		}

    });

    // Toggle task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.toggle-task', function( e ){

        e.preventDefault();

        var $taskId = $( this ).attr('id');

        $.ajax({
            type: "GET",
            url: SITE_URL + "/tasks/toggle/" + $taskId
        })
        .done( function( response ) {

            if(response == 'completed')
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-check-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.completed tbody'));
                
                // alert($('table.tasks.completed tbody').html());
                
                // 
                
            }
            else
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.uncompleted tbody'));
            }

        })

    });
	
	// Add task Modal	
	$('.uncompleted-tasks').on('click', 'a.add-to-workorder', function(e){
		
		e.preventDefault();
	    
	    taskId = $(this).attr('id');

        uri = "/tasks/add-to-workorder/" + taskId;
        
        getModal(uri);
		
	});
    
    // Move task
	// $('.uncompleted-tasks').on('click', 'a.move-task', function(e){
	//
	//     e.preventDefault();
	//
	// 	var $this = $( this );
	// 	var ids = $this.attr('id');
	// 	var row = $this.parents("tr");
	//
	// 	$.ajax({
	// 		type: "GET",
	// 		url: SITE_URL + "/workorders/move_task/" + ids
	// 	})
	// 	.done(function( data ) {
	//
	// 		var status = $.parseJSON(data).status;
	//
	// 		if(status == 'success')
	// 		{
	// 			row.remove();
	// 		}
	// 		else
	// 		{
	//
	// 		}
	//
	// 	})
	//
	// });
	
	// Add task to work order
	$('#modal').on("click", 'button#add-to-workorder', function( e ) {
	    
	    e.preventDefault();
		
		button = $( this );
		
		button.html('Adding to Work Order <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    
        var modal = $.UIkit.modal("#modal");
	    
	    uri = "/tasks/add-to-workorder";
	    data = $("form#add-task-to-workorder").serialize();
        
        $.ajax({
    		type: "POST",
    		url: SITE_URL + uri,
    		data: data
    	})
    	.done( function( data ) {

            var results = $.parseJSON(data);

            if(results.status == 'success')
    		{                
    		    $('tr#row-' + results.taskId).remove();

    			modal._hide();
    		}

    	});
		
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
//# sourceMappingURL=workorder.js.map
